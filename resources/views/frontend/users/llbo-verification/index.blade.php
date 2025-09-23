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
                                <h6 class="text-lg font-semibold text-gray-800">LLBO License Verification</h6>
                                <p class="text-sm text-slate-500 mt-1">Manage your LLBO license verification status</p>
                            </div>
                            @if(!$verification || $verification->status !== 'verified' || $verification->is_expired)
                                <a href="{{ route('user.llbo-verification.create') }}" 
                                   class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                    <i class="fas fa-plus mr-2"></i>Submit License
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex-auto p-6">
                        @if($verification)
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- License Information -->
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <h6 class="text-lg font-semibold text-gray-800 mb-4">License Information</h6>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label class="text-sm font-medium text-gray-600">License Number</label>
                                            <p class="text-sm text-gray-800 font-semibold">{{ $verification->license_number }}</p>
                                        </div>
                                        
                                        <div>
                                            <label class="text-sm font-medium text-gray-600">License Type</label>
                                            <p class="text-sm text-gray-800 font-semibold">{{ $verification->license_type }}</p>
                                        </div>
                                        
                                        <div>
                                            <label class="text-sm font-medium text-gray-600">Issue Date</label>
                                            <p class="text-sm text-gray-800 font-semibold">{{ $verification->issue_date->format('M d, Y') }}</p>
                                        </div>
                                        
                                        <div>
                                            <label class="text-sm font-medium text-gray-600">Expiry Date</label>
                                            <p class="text-sm font-semibold {{ $verification->is_expired ? 'text-red-600' : ($verification->is_expiring_soon ? 'text-yellow-600' : 'text-gray-800') }}">
                                                {{ $verification->expiry_date->format('M d, Y') }}
                                                @if($verification->is_expired)
                                                    <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded ml-2">Expired</span>
                                                @elseif($verification->is_expiring_soon)
                                                    <span class="text-xs bg-yellow-100 text-yellow-600 px-2 py-1 rounded ml-2">Expires in {{ $verification->days_until_expiry }} days</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Status Information -->
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <h6 class="text-lg font-semibold text-gray-800 mb-4">Verification Status</h6>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label class="text-sm font-medium text-gray-600">Status</label>
                                            <div class="mt-1">
                                                @switch($verification->status)
                                                    @case('pending')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            <i class="fas fa-clock mr-1"></i>Pending Review
                                                        </span>
                                                        @break
                                                    @case('verified')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-check-circle mr-1"></i>Verified
                                                        </span>
                                                        @break
                                                    @case('rejected')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            <i class="fas fa-times-circle mr-1"></i>Rejected
                                                        </span>
                                                        @break
                                                    @case('expired')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            <i class="fas fa-exclamation-triangle mr-1"></i>Expired
                                                        </span>
                                                        @break
                                                @endswitch
                                            </div>
                                        </div>
                                        
                                        @if($verification->verified_at)
                                            <div>
                                                <label class="text-sm font-medium text-gray-600">Verified Date</label>
                                                <p class="text-sm text-gray-800 font-semibold">{{ $verification->verified_at->format('M d, Y H:i') }}</p>
                                            </div>
                                        @endif
                                        
                                        @if($verification->verifier)
                                            <div>
                                                <label class="text-sm font-medium text-gray-600">Verified By</label>
                                                <p class="text-sm text-gray-800 font-semibold">{{ $verification->verifier->name }}</p>
                                            </div>
                                        @endif
                                        
                                        @if($verification->verification_notes)
                                            <div>
                                                <label class="text-sm font-medium text-gray-600">Notes</label>
                                                <p class="text-sm text-gray-800">{{ $verification->verification_notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="mt-6 flex flex-wrap gap-3">
                                @if($verification->document_path)
                                    <a href="{{ route('user.llbo-verification.download') }}" 
                                       class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                        <i class="fas fa-download mr-2"></i>Download Document
                                    </a>
                                @endif
                                
                                @if($verification->status !== 'verified' || $verification->is_expired)
                                    <a href="{{ route('user.llbo-verification.create') }}" 
                                       class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                        <i class="fas fa-edit mr-2"></i>Update License
                                    </a>
                                @endif
                            </div>
                        @else
                            <!-- No License Submitted -->
                            <div class="text-center py-12">
                                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-id-card text-3xl text-gray-400"></i>
                                </div>
                                <h6 class="text-lg font-semibold text-gray-800 mb-2">No LLBO License Submitted</h6>
                                <p class="text-sm text-gray-600 mb-6">You need to submit your LLBO license for verification to place orders.</p>
                                <a href="{{ route('user.llbo-verification.create') }}" 
                                   class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-6 py-3 rounded-lg text-white font-semibold hover:shadow-lg transition-all">
                                    <i class="fas fa-plus mr-2"></i>Submit License
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
