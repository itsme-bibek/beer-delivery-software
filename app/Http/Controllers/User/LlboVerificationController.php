<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LlboVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LlboVerificationController extends Controller
{
    public function index()
    {
        $verification = auth()->user()->llboVerification;
        return view('frontend.users.llbo-verification.index', compact('verification'));
    }

    public function create()
    {
        $verification = auth()->user()->llboVerification;
        
        if ($verification && $verification->status === 'verified' && !$verification->is_expired) {
            return redirect()->route('user.llbo-verification.index')
                            ->with('info', 'You already have a verified LLBO license.');
        }

        return view('frontend.users.llbo-verification.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_number' => 'required|string|max:255|unique:llbo_verifications,license_number',
            'license_type' => 'required|string|in:LLBO,Retail,Wholesale',
            'issue_date' => 'required|date|before:today',
            'expiry_date' => 'required|date|after:issue_date',
            'license_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120' // 5MB max
        ]);

        // Handle file upload
        $documentPath = null;
        if ($request->hasFile('license_document')) {
            $documentPath = $request->file('license_document')->store('llbo-documents', 'public');
        }

        // Check if user already has a verification record
        $existingVerification = auth()->user()->llboVerification;
        
        if ($existingVerification) {
            // Update existing verification
            $existingVerification->update([
                'license_number' => $request->license_number,
                'license_type' => $request->license_type,
                'issue_date' => $request->issue_date,
                'expiry_date' => $request->expiry_date,
                'status' => 'pending',
                'document_path' => $documentPath,
                'verified_by' => null,
                'verified_at' => null,
                'verification_notes' => null,
                'reminder_sent_at' => null,
            ]);
        } else {
            // Create new verification
            LlboVerification::create([
                'user_id' => auth()->id(),
                'license_number' => $request->license_number,
                'license_type' => $request->license_type,
                'issue_date' => $request->issue_date,
                'expiry_date' => $request->expiry_date,
                'status' => 'pending',
                'document_path' => $documentPath,
            ]);
        }

        return redirect()->route('user.llbo-verification.index')
                        ->with('success', 'LLBO license submitted for verification. You will be notified once it\'s reviewed.');
    }

    public function update(Request $request)
    {
        $verification = auth()->user()->llboVerification;
        
        if (!$verification) {
            return redirect()->route('user.llbo-verification.create');
        }

        $request->validate([
            'license_number' => 'required|string|max:255|unique:llbo_verifications,license_number,' . $verification->id,
            'license_type' => 'required|string|in:LLBO,Retail,Wholesale',
            'issue_date' => 'required|date|before:today',
            'expiry_date' => 'required|date|after:issue_date',
            'license_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $updateData = [
            'license_number' => $request->license_number,
            'license_type' => $request->license_type,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'status' => 'pending',
            'verified_by' => null,
            'verified_at' => null,
            'verification_notes' => null,
            'reminder_sent_at' => null,
        ];

        // Handle file upload if new document is provided
        if ($request->hasFile('license_document')) {
            // Delete old document
            if ($verification->document_path) {
                Storage::disk('public')->delete($verification->document_path);
            }
            
            $updateData['document_path'] = $request->file('license_document')->store('llbo-documents', 'public');
        }

        $verification->update($updateData);

        return redirect()->route('user.llbo-verification.index')
                        ->with('success', 'LLBO license updated and resubmitted for verification.');
    }

    public function downloadDocument()
    {
        $verification = auth()->user()->llboVerification;
        
        if (!$verification || !$verification->document_path) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        return Storage::disk('public')->download($verification->document_path);
    }
}