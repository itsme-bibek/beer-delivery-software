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
                                <h6 class="text-lg font-semibold text-gray-800">LLBO License Verifications</h6>
                                <p class="text-sm text-slate-500 mt-1">Manage user LLBO license verifications</p>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('admin.llbo-verifications.expiring') }}" 
                                   class="bg-gradient-to-tl from-yellow-500 to-orange-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Expiring Soon
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <div class="p-6 pb-0">
                        <form method="GET" class="flex flex-wrap gap-4 items-end">
                            <div class="flex-1 min-w-[200px]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search by name, email, or license number"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            
                            <div class="min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                </select>
                            </div>
                            
                            <div class="min-w-[150px]">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Filter</label>
                                <select name="expiring_soon" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All</option>
                                    <option value="1" {{ request('expiring_soon') ? 'selected' : '' }}>Expiring Soon</option>
                                </select>
                            </div>
                            
                            <div class="flex gap-2">
                                <button type="submit" 
                                        class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                    <i class="fas fa-search mr-2"></i>Filter
                                </button>
                                <a href="{{ route('admin.llbo-verifications.index') }}" 
                                   class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                    <i class="fas fa-times mr-2"></i>Clear
                                </a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="flex-auto p-6 px-0 pb-2">
                        <div class="overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        </th>
                                        <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                            User
                                        </th>
                                        <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                            License Details
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                            Expiry Date
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($verifications as $verification)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <input type="checkbox" name="verification_ids[]" value="{{ $verification->id }}" class="verification-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 rounded-full bg-gradient-to-tl from-blue-500 to-cyan-400 flex items-center justify-center text-white text-sm font-bold mr-3">
                                                        {{ substr($verification->user->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="text-sm font-semibold text-gray-800">{{ $verification->user->name }}</h6>
                                                        <p class="text-xs text-slate-400">{{ $verification->user->email }}</p>
                                                        <p class="text-xs text-slate-400">{{ $verification->user->phone }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <div>
                                                    <h6 class="text-sm font-semibold text-gray-800">{{ $verification->license_number }}</h6>
                                                    <p class="text-xs text-slate-400">{{ $verification->license_type }}</p>
                                                    <p class="text-xs text-slate-400">Issued: {{ $verification->issue_date->format('M d, Y') }}</p>
                                                </div>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                @switch($verification->status)
                                                    @case('pending')
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            <i class="fas fa-clock mr-1"></i>Pending
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
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                <span class="text-sm font-semibold {{ $verification->is_expired ? 'text-red-600' : ($verification->is_expiring_soon ? 'text-yellow-600' : 'text-gray-800') }}">
                                                    {{ $verification->expiry_date->format('M d, Y') }}
                                                </span>
                                                @if($verification->is_expiring_soon && !$verification->is_expired)
                                                    <p class="text-xs text-yellow-600">{{ $verification->days_until_expiry }} days left</p>
                                                @endif
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="{{ route('admin.llbo-verifications.show', $verification) }}" 
                                                       class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($verification->status === 'pending')
                                                        <button onclick="verifyLicense({{ $verification->id }}, 'verified')" 
                                                                class="bg-gradient-to-tl from-green-500 to-emerald-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button onclick="verifyLicense({{ $verification->id }}, 'rejected')" 
                                                                class="bg-gradient-to-tl from-red-500 to-pink-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    @endif
                                                    @if($verification->status === 'verified' && !$verification->is_expired)
                                                        <button onclick="sendReminder({{ $verification->id }})" 
                                                                class="bg-gradient-to-tl from-yellow-500 to-orange-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all">
                                                            <i class="fas fa-bell"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="p-8 text-center text-gray-500">
                                                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-id-card text-3xl text-gray-400"></i>
                                                </div>
                                                <h6 class="text-lg font-semibold text-gray-800 mb-2">No LLBO Verifications Found</h6>
                                                <p class="text-sm text-gray-600">No license verifications match your current filters.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Bulk Actions -->
                        @if($verifications->count() > 0)
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <select id="bulk-action" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Bulk Actions</option>
                                        <option value="verify">Verify Selected</option>
                                        <option value="reject">Reject Selected</option>
                                        <option value="send_reminder">Send Reminder</option>
                                    </select>
                                    <button onclick="performBulkAction()" 
                                            class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                        Apply
                                    </button>
                                </div>
                                
                                <div class="text-sm text-gray-600">
                                    Showing {{ $verifications->firstItem() }} to {{ $verifications->lastItem() }} of {{ $verifications->total() }} results
                                </div>
                            </div>
                        @endif
                        
                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $verifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Verification Modal -->
<div id="verification-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-soft-xl max-w-md w-full">
            <div class="p-6">
                <h6 class="text-lg font-semibold text-gray-800 mb-4">Verify License</h6>
                <form id="verification-form" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="verification-status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="verified">Verify</option>
                            <option value="rejected">Reject</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                        <textarea name="verification_notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Add verification notes..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeVerificationModal()" 
                                class="bg-gray-500 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Select All Checkbox
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.verification-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Individual Checkbox
document.querySelectorAll('.verification-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const allCheckboxes = document.querySelectorAll('.verification-checkbox');
        const checkedCheckboxes = document.querySelectorAll('.verification-checkbox:checked');
        document.getElementById('select-all').checked = allCheckboxes.length === checkedCheckboxes.length;
    });
});

function verifyLicense(verificationId, status) {
    const form = document.getElementById('verification-form');
    form.action = `/admin/llbo-verifications/${verificationId}/verify`;
    document.getElementById('verification-status').value = status;
    document.getElementById('verification-modal').classList.remove('hidden');
}

function closeVerificationModal() {
    document.getElementById('verification-modal').classList.add('hidden');
}

function sendReminder(verificationId) {
    if (confirm('Send reminder to this user?')) {
        fetch(`/admin/llbo-verifications/${verificationId}/reminder`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

function performBulkAction() {
    const action = document.getElementById('bulk-action').value;
    const checkedBoxes = document.querySelectorAll('.verification-checkbox:checked');
    
    if (!action) {
        alert('Please select an action');
        return;
    }
    
    if (checkedBoxes.length === 0) {
        alert('Please select at least one verification');
        return;
    }
    
    if (confirm(`Are you sure you want to ${action} ${checkedBoxes.length} verification(s)?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/llbo-verifications/bulk-action';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfToken);
        
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = action;
        form.appendChild(actionInput);
        
        checkedBoxes.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'verification_ids[]';
            input.value = checkbox.value;
            form.appendChild(input);
        });
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
