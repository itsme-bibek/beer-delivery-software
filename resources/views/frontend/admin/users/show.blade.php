@extends('layout.app')

@section('main')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <!-- Header -->
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex items-center justify-between">
                            <div>
                                <h6 class="text-lg font-semibold text-gray-800">User Profile</h6>
                                <p class="text-sm text-slate-500 mt-1">Detailed user information and activity</p>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('admin.users.index') }}" 
                                   class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to Users
                                </a>
                                @if($user->llboVerification)
                                    <a href="{{ route('admin.llbo-verifications.show', $user->llboVerification) }}" 
                                       class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                        <i class="fas fa-id-card mr-2"></i>View License
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- User Information -->
                    <div class="lg:col-span-2">
                        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                                <h6 class="text-lg font-semibold text-gray-800">User Information</h6>
                            </div>
                            <div class="flex-auto p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
                                        <p class="text-sm text-gray-800 font-semibold">{{ $user->name }}</p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Email Address</label>
                                        <p class="text-sm text-gray-800 font-semibold">{{ $user->email }}</p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Phone Number</label>
                                        <p class="text-sm text-gray-800 font-semibold">{{ $user->phone ?? 'Not provided' }}</p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Role</label>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : 'fa-user' }} mr-1"></i>
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Member Since</label>
                                        <p class="text-sm text-gray-800 font-semibold">{{ $user->created_at->format('M d, Y') }}</p>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Last Login</label>
                                        <p class="text-sm text-gray-800 font-semibold">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                
                                @if($user->address)
                                    <div class="mt-6">
                                        <label class="block text-sm font-medium text-gray-600 mb-2">Address</label>
                                        <p class="text-sm text-gray-800">{{ $user->address }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Recent Orders -->
                        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                                <h6 class="text-lg font-semibold text-gray-800">Recent Orders</h6>
                            </div>
                            <div class="flex-auto p-6 px-0 pb-2">
                                <div class="overflow-x-auto">
                                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                        <thead class="align-bottom">
                                            <tr>
                                                <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                    Order Group
                                                </th>
                                                <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                    Items
                                                </th>
                                                <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                    Total
                                                </th>
                                                <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                    Status
                                                </th>
                                                <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                    Date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($user->orders->groupBy('group_code')->take(5) as $groupCode => $groupOrders)
                                                @php
                                                    $firstOrder = $groupOrders->first();
                                                    $totalAmount = $groupOrders->sum('total_price');
                                                    $totalItems = $groupOrders->sum('quantity');
                                                @endphp
                                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                                    <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                        <span class="text-sm font-semibold text-blue-600">{{ $groupCode }}</span>
                                                    </td>
                                                    <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                        <span class="text-sm font-semibold">{{ $totalItems }}</span>
                                                    </td>
                                                    <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                        <span class="text-sm font-semibold text-green-600">${{ number_format($totalAmount, 2) }}</span>
                                                    </td>
                                                    <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                            @if($firstOrder->status === 'completed') bg-green-100 text-green-800
                                                            @elseif($firstOrder->status === 'pending') bg-yellow-100 text-yellow-800
                                                            @elseif($firstOrder->status === 'processing') bg-blue-100 text-blue-800
                                                            @elseif($firstOrder->status === 'cancelled') bg-red-100 text-red-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                            {{ ucfirst($firstOrder->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                        <span class="text-sm text-gray-600">{{ $firstOrder->created_at->format('M d, Y') }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="p-8 text-center text-gray-500">
                                                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-shopping-cart text-2xl text-gray-400"></i>
                                                        </div>
                                                        <p class="text-sm">No orders found</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Statistics -->
                        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                                <h6 class="text-lg font-semibold text-gray-800">Statistics</h6>
                            </div>
                            <div class="flex-auto p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Total Orders</span>
                                        <span class="text-sm font-semibold text-gray-800">{{ $stats['total_orders'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Total Spent</span>
                                        <span class="text-sm font-semibold text-green-600">${{ number_format($stats['total_spent'], 2) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Avg Order Value</span>
                                        <span class="text-sm font-semibold text-gray-800">${{ number_format($stats['avg_order_value'], 2) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Messages</span>
                                        <span class="text-sm font-semibold text-gray-800">{{ $stats['messages_count'] }}</span>
                                    </div>
                                    @if($stats['last_order_date'])
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Last Order</span>
                                            <span class="text-sm font-semibold text-gray-800">{{ $stats['last_order_date']->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- LLBO License Status -->
                        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                                <h6 class="text-lg font-semibold text-gray-800">LLBO License</h6>
                            </div>
                            <div class="flex-auto p-6">
                                @if($user->llboVerification)
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Status</span>
                                            @switch($user->llboVerification->status)
                                                @case('pending')
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-clock mr-1"></i>Pending
                                                    </span>
                                                    @break
                                                @case('verified')
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1"></i>Verified
                                                    </span>
                                                    @break
                                                @case('rejected')
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-times-circle mr-1"></i>Rejected
                                                    </span>
                                                    @break
                                                @case('expired')
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>Expired
                                                    </span>
                                                    @break
                                            @endswitch
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">License Number</span>
                                            <span class="text-sm font-semibold text-gray-800">{{ $user->llboVerification->license_number }}</span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Type</span>
                                            <span class="text-sm font-semibold text-gray-800">{{ $user->llboVerification->license_type }}</span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">Expiry Date</span>
                                            <span class="text-sm font-semibold {{ $user->llboVerification->is_expired ? 'text-red-600' : ($user->llboVerification->is_expiring_soon ? 'text-yellow-600' : 'text-gray-800') }}">
                                                {{ $user->llboVerification->expiry_date->format('M d, Y') }}
                                            </span>
                                        </div>
                                        
                                        @if($user->llboVerification->is_expiring_soon && !$user->llboVerification->is_expired)
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-600">Days Left</span>
                                                <span class="text-sm font-semibold text-yellow-600">{{ $user->llboVerification->days_until_expiry }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($user->llboVerification->verified_at)
                                            <div class="flex items-center justify-between">
                                                <span class="text-sm text-gray-600">Verified Date</span>
                                                <span class="text-sm font-semibold text-gray-800">{{ $user->llboVerification->verified_at->format('M d, Y') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <div class="w-12 h-12 mx-auto mb-3 bg-gray-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-id-card text-xl text-gray-400"></i>
                                        </div>
                                        <p class="text-sm text-gray-600">No LLBO license submitted</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                                <h6 class="text-lg font-semibold text-gray-800">Actions</h6>
                            </div>
                            <div class="flex-auto p-6">
                                <div class="space-y-3">
                                    <button onclick="updateUserRole('{{ $user->id }}', '{{ $user->role === 'admin' ? 'user' : 'admin' }}')" 
                                            class="w-full bg-gradient-to-tl from-purple-500 to-pink-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                        <i class="fas fa-user-cog mr-2"></i>
                                        {{ $user->role === 'admin' ? 'Remove Admin' : 'Make Admin' }}
                                    </button>
                                    
                                    <button onclick="deleteUser('{{ $user->id }}')" 
                                            class="w-full bg-gradient-to-tl from-red-500 to-pink-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                        <i class="fas fa-trash mr-2"></i>Delete User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function updateUserRole(userId, newRole) {
    if (confirm(`Are you sure you want to change this user's role to ${newRole}?`)) {
        fetch(`/admin/users/${userId}/role`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ role: newRole })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        fetch(`/admin/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/admin/users';
            }
        });
    }
}
</script>
@endsection
