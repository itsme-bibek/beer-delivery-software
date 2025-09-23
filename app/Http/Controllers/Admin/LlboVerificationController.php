<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LlboVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\LlboVerificationStatusMail;

class LlboVerificationController extends Controller
{
    public function index(Request $request)
    {
        $query = LlboVerification::with(['user', 'verifier']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by expiring soon
        if ($request->filled('expiring_soon')) {
            $query->expiringSoon();
        }

        // Search by user name or license number
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('license_number', 'like', "%{$search}%");
        }

        $verifications = $query->latest()->paginate(15);

        return view('frontend.admin.llbo-verifications.index', compact('verifications'));
    }

    public function show(LlboVerification $llboVerification)
    {
        $llboVerification->load(['user', 'verifier']);
        return view('frontend.admin.llbo-verifications.show', compact('llboVerification'));
    }

    public function verify(Request $request, LlboVerification $llboVerification)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'verification_notes' => 'nullable|string|max:1000'
        ]);

        if ($request->status === 'verified') {
            $llboVerification->markAsVerified(auth()->id(), $request->verification_notes);
            // Send email notification to user (accepted) with notes
            if ($llboVerification->user && $llboVerification->user->email) {
                try {
                    \Mail::to($llboVerification->user->email)
                        ->send(new LlboVerificationStatusMail($llboVerification->fresh(), 'verified'));
                } catch (\Throwable $e) { }
            }
        } else {
            $llboVerification->markAsRejected(auth()->id(), $request->verification_notes);
            // Send email notification to user (rejected) with notes
            if ($llboVerification->user && $llboVerification->user->email) {
                try {
                    \Mail::to($llboVerification->user->email)
                        ->send(new LlboVerificationStatusMail($llboVerification->fresh(), 'rejected'));
                } catch (\Throwable $e) { }
            }
        }

        return redirect()->route('admin.llbo-verifications.show', $llboVerification)
                        ->with('success', 'LLBO verification updated successfully.');
    }

    public function sendReminder(LlboVerification $llboVerification)
    {
        $llboVerification->sendReminder();
        
        return redirect()->back()
                        ->with('success', 'Reminder sent successfully.');
    }

    public function download(LlboVerification $llboVerification)
    {
        if (!$llboVerification->document_path || !Storage::disk('public')->exists($llboVerification->document_path)) {
            return redirect()->back()->with('error', 'Document file is missing.');
        }

        return Storage::disk('public')->download($llboVerification->document_path);
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:verify,reject,send_reminder',
            'verification_ids' => 'required|array',
            'verification_ids.*' => 'exists:llbo_verifications,id'
        ]);

        $verifications = LlboVerification::whereIn('id', $request->verification_ids);

        switch ($request->action) {
            case 'verify':
                $verifications->update([
                    'status' => 'verified',
                    'verified_by' => auth()->id(),
                    'verified_at' => now()
                ]);
                break;
            case 'reject':
                $verifications->update([
                    'status' => 'rejected',
                    'verified_by' => auth()->id(),
                    'verified_at' => now()
                ]);
                break;
            case 'send_reminder':
                $verifications->update(['reminder_sent_at' => now()]);
                break;
        }

        return redirect()->back()
                        ->with('success', 'Bulk action completed successfully.');
    }

    public function expiringSoon()
    {
        $expiringVerifications = LlboVerification::expiringSoon()
            ->with(['user'])
            ->get();

        return view('frontend.admin.llbo-verifications.expiring', compact('expiringVerifications'));
    }
}