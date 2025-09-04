@extends('layout.app')

@section('main')
<main class="ease-soft-in-out relative h-full max-h-screen rounded-xl transition-all duration-200">
    <div class="w-full px-6 py-6 mx-auto">
        <!-- Header -->
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mx-auto mt-0 lg:w-12/12 lg:flex-none">
                <div class="flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0 font-bold text-slate-700">My Profile</h6>
                                <p class="mb-0 text-sm leading-normal">
                                    <a class="text-slate-500" href="{{ route('user-home') }}">Dashboard</a>
                                    <span class="text-slate-500"> / </span>
                                    <span class="text-slate-700">Profile</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="flex flex-wrap -mx-3 mt-6">
            <!-- Profile Information -->
            <div class="w-full max-w-full px-3 mt-6 lg:w-7/12 lg:flex-none">
                <div class="flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <h6 class="font-bold text-slate-700">Personal Information</h6>
                        <p class="leading-normal text-sm">Update your personal details and contact information.</p>
                    </div>
                    <div class="flex-auto p-4">
                        <form id="profile-form">
                            @csrf
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                    <label class="mb-2.5 text-sm font-medium text-slate-700">Full Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" required
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Enter your full name" />
                                </div>
                                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                    <label class="mb-2.5 text-sm font-medium text-slate-700">Email Address</label>
                                    <input type="email" name="email" value="{{ $user->email }}" required
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Enter your email address" />
                                </div>
                                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                    <label class="mb-2.5 text-sm font-medium text-slate-700">Phone Number</label>
                                    <input type="tel" name="phone" value="{{ $user->phone ?? '' }}"
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Enter your phone number" />
                                </div>
                                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                    <label class="mb-2.5 text-sm font-medium text-slate-700">Role</label>
                                    <input type="text" value="{{ ucfirst($user->role) }}" disabled
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-700"
                                        placeholder="User role" />
                                </div>
                                <div class="w-full max-w-full px-3 mb-6 md:flex-none">
                                    <label class="mb-2.5 text-sm font-medium text-slate-700">Address</label>
                                    <textarea name="address" rows="3"
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Enter your address">{{ $user->address ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-cyan-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 hover:shadow-soft-xs active:opacity-85 hover:-translate-y-px">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border mt-6">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <h6 class="font-bold text-slate-700">Change Password</h6>
                        <p class="leading-normal text-sm">Update your password to keep your account secure.</p>
                    </div>
                    <div class="flex-auto p-4">
                        <form id="password-form">
                            @csrf
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                    <label class="mb-2.5 text-sm font-medium text-slate-700">Current Password</label>
                                    <input type="password" name="current_password" required
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Enter current password" />
                                </div>
                                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                    <label class="mb-2.5 text-sm font-medium text-slate-700">New Password</label>
                                    <input type="password" name="password" required
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Enter new password" />
                                </div>
                                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none">
                                    <label class="mb-2.5 text-sm font-medium text-slate-700">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" required
                                        class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                        placeholder="Confirm new password" />
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-green-500 to-emerald-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 hover:shadow-soft-xs active:opacity-85 hover:-translate-y-px">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Statistics and Recent Orders -->
            <div class="w-full max-w-full px-3 mt-6 lg:w-5/12 lg:flex-none">
                <!-- Statistics Cards -->
                <div class="flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <h6 class="font-bold text-slate-700">Account Statistics</h6>
                        <p class="leading-normal text-sm">Your activity summary and statistics.</p>
                    </div>
                    <div class="flex-auto p-4">
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Total Orders -->
                            <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-blue-500 to-cyan-400 rounded-2xl bg-clip-border shadow-soft-xl">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-row -mx-3">
                                        <div class="w-2/3 max-w-full px-3">
                                            <div>
                                                <p class="mb-0 font-sans text-sm font-semibold leading-normal text-white opacity-60">Total Orders</p>
                                                <h5 class="mb-0 font-bold text-white">{{ number_format($totalOrders) }}</h5>
                                            </div>
                                        </div>
                                        <div class="w-4/12 max-w-full px-3 text-right">
                                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-600 to-cyan-400">
                                                <i class="fas fa-shopping-cart leading-none text-lg relative top-3.5 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Spent -->
                            <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-green-500 to-emerald-400 rounded-2xl bg-clip-border shadow-soft-xl">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-row -mx-3">
                                        <div class="w-2/3 max-w-full px-3">
                                            <div>
                                                <p class="mb-0 font-sans text-sm font-semibold leading-normal text-white opacity-60">Total Spent</p>
                                                <h5 class="mb-0 font-bold text-white">${{ number_format($totalSpent, 2) }}</h5>
                                            </div>
                                        </div>
                                        <div class="w-4/12 max-w-full px-3 text-right">
                                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-600 to-emerald-400">
                                                <i class="fas fa-dollar-sign leading-none text-lg relative top-3.5 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Messages -->
                            <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-purple-500 to-pink-400 rounded-2xl bg-clip-border shadow-soft-xl">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-row -mx-3">
                                        <div class="w-2/3 max-w-full px-3">
                                            <div>
                                                <p class="mb-0 font-sans text-sm font-semibold leading-normal text-white opacity-60">Messages Sent</p>
                                                <h5 class="mb-0 font-bold text-white">{{ number_format($totalMessages) }}</h5>
                                            </div>
                                        </div>
                                        <div class="w-4/12 max-w-full px-3 text-right">
                                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-600 to-pink-400">
                                                <i class="fas fa-envelope leading-none text-lg relative top-3.5 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border mt-6">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <h6 class="font-bold text-slate-700">Recent Orders</h6>
                        <p class="leading-normal text-sm">Your latest order activity.</p>
                    </div>
                    <div class="flex-auto p-4">
                        @if($recentOrders->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentOrders as $order)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-shopping-bag text-blue-600"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-700">Order #{{ $order->id }}</p>
                                                <p class="text-xs text-slate-500">{{ $order->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-slate-700">${{ number_format($order->total_price, 2) }}</p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                                @elseif($order->status === 'completed') bg-green-100 text-green-800
                                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('my-orders') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    View All Orders <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-shopping-cart text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">No orders yet</p>
                                <a href="{{ route('buybeer') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium mt-2 inline-block">
                                    Start Shopping <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Profile form submission
    document.getElementById('profile-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        submitBtn.textContent = 'Updating...';
        submitBtn.disabled = true;

        fetch('{{ route("user.profile.update") }}', {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: formData.get('name'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                address: formData.get('address'),
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message || 'Failed to update profile'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong while updating profile'
            });
        })
        .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    });

    // Password form submission
    document.getElementById('password-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        submitBtn.textContent = 'Updating...';
        submitBtn.disabled = true;

        fetch('{{ route("user.profile.password") }}', {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                current_password: formData.get('current_password'),
                password: formData.get('password'),
                password_confirmation: formData.get('password_confirmation'),
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });
                this.reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message || 'Failed to update password'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong while updating password'
            });
        })
        .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    });
</script>
@endsection
