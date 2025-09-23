@extends('layout.app')

@section('main')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex items-center justify-between">
                            <div>
                                <h6 class="text-lg font-semibold text-gray-800">LLBO Verification Detail</h6>
                                <p class="text-sm text-slate-500 mt-1">License info for {{ $llboVerification->user->name }}</p>
                            </div>
                            <a href="{{ route('admin.llbo-verifications.index') }}" class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="flex-auto p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h6 class="text-lg font-semibold text-gray-800 mb-4">User & License</h6>
                                <div class="space-y-3 text-sm">
                                    <div><span class="text-gray-600">User:</span> <span class="font-semibold text-gray-800">{{ $llboVerification->user->name }}</span></div>
                                    <div><span class="text-gray-600">Email:</span> <span class="font-semibold text-gray-800">{{ $llboVerification->user->email }}</span></div>
                                    <div><span class="text-gray-600">Phone:</span> <span class="font-semibold text-gray-800">{{ $llboVerification->user->phone ?? '—' }}</span></div>
                                    <div><span class="text-gray-600">License #:</span> <span class="font-semibold text-gray-800">{{ $llboVerification->license_number }}</span></div>
                                    <div><span class="text-gray-600">Type:</span> <span class="font-semibold text-gray-800">{{ $llboVerification->license_type }}</span></div>
                                    <div><span class="text-gray-600">Issued:</span> <span class="font-semibold text-gray-800">{{ $llboVerification->issue_date->format('M d, Y') }}</span></div>
                                    <div><span class="text-gray-600">Expires:</span> 
                                        <span class="font-semibold {{ $llboVerification->is_expired ? 'text-red-600' : ($llboVerification->is_expiring_soon ? 'text-yellow-600' : 'text-gray-800') }}">
                                            {{ $llboVerification->expiry_date->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h6 class="text-lg font-semibold text-gray-800 mb-4">Status & Actions</h6>
                                <div class="mb-4">
                                    @switch($llboVerification->status)
                                        @case('pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i> Pending</span>
                                            @break
                                        @case('verified')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i> Verified</span>
                                            @break
                                        @case('rejected')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800"><i class="fas fa-times-circle mr-1"></i> Rejected</span>
                                            @break
                                        @case('expired')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800"><i class="fas fa-exclamation-triangle mr-1"></i> Expired</span>
                                            @break
                                    @endswitch
                                </div>
                                <form action="{{ route('admin.llbo-verifications.verify', $llboVerification) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                            <option value="verified">Verify</option>
                                            <option value="rejected">Reject</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes (optional)</label>
                                        <textarea name="verification_notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Add notes..."></textarea>
                                    </div>
                                    <div class="flex gap-3">
                                        <button type="submit" class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">Submit</button>
                                        <a href="{{ route('admin.llbo-verifications.reminder', $llboVerification) }}" onclick="event.preventDefault(); document.getElementById('reminder-form').submit();" class="bg-gradient-to-tl from-yellow-500 to-orange-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all"><i class="fas fa-bell mr-1"></i> Send Reminder</a>
                                    </div>
                                </form>
                                <form id="reminder-form" action="{{ route('admin.llbo-verifications.reminder', $llboVerification) }}" method="POST" class="hidden">@csrf</form>
                                @if($llboVerification->document_path)
                                    <div class="mt-6">
                                        <a href="{{ route('admin.llbo-verifications.download', $llboVerification) }}" class="text-sm text-blue-600 hover:underline"><i class="fas fa-file-download mr-1"></i> Download Document</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


