@extends('layout.app')

@section('main')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <nav
            class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="opacity-50 text-slate-700" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li
                            class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">
                            Users Management
                        </li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">All Users</h6>
                </nav>
            </div>
        </nav>

        <div class="w-full px-6 py-6 mx-auto">
            <!-- Filters and Actions -->
            <div class="flex flex-wrap items-center justify-between mb-6 -mx-3">
                <div class="w-full px-3 mb-6 md:mb-0 md:w-1/2 lg:w-1/4">
                    <div class="relative">
                        <span class="absolute ml-2">
                            <i class="fas fa-search text-slate-400"></i>
                        </span>
                        <input type="text" id="search-users"
                            class="block w-full pl-8 pr-2 py-2 text-sm border border-gray-200 rounded-lg focus:shadow-soft-primary-outline focus:border-fuchsia-300"
                            placeholder="Search users...">
                    </div>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0 md:w-1/2 lg:w-1/4">
                    <div class="relative">
                        <select id="role-filter"
                            class="block w-full px-3 py-2 text-sm font-normal text-gray-700 transition-all bg-white border border-gray-200 rounded-lg outline-none focus:shadow-soft-primary-outline focus:border-fuchsia-300">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0 md:w-1/2 lg:w-1/4">
                    <div class="relative">
                        <select id="status-filter"
                            class="block w-full px-3 py-2 text-sm font-normal text-gray-700 transition-all bg-white border border-gray-200 rounded-lg outline-none focus:shadow-soft-primary-outline focus:border-fuchsia-300">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="w-full px-3 md:w-auto">
                    <button id="bulk-delete-btn" class="px-4 py-2 text-sm font-normal text-white transition-all bg-red-500 border border-red-500 rounded-lg hover:bg-red-600 hidden">
                        <i class="fas fa-trash mr-2"></i>Delete Selected
                    </button>
                </div>
            </div>

            <!-- Users Table -->
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 flex-none">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6 px-0 pb-2">
                            <div class="overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                User
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Role
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Orders
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Total Spent
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Status
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Joined
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <input type="checkbox" class="user-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $user->id }}">
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tl from-blue-500 to-cyan-400 flex items-center justify-center text-white text-sm font-bold mr-3">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <span class="text-sm font-semibold text-gray-800">{{ $user->name }}</span>
                                                            <p class="text-xs text-blue-600 font-medium">{{ $user->email }}</p>
                                                            <p class="text-xs text-slate-400">ID: {{ $user->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <select onchange="updateUserRole({{ $user->id }}, this.value)" 
                                                        class="text-sm border border-gray-200 rounded-lg px-2 py-1 focus:outline-none focus:border-blue-500 {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <span class="text-sm font-semibold text-gray-800">{{ $user->orders_count }}</span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <span class="text-sm font-semibold text-green-600">${{ number_format($user->orders_sum_total_price ?? 0, 2) }}</span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    @if($user->last_login_at)
                                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Active</span>
                                                    @else
                                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <span class="text-sm">{{ $user->created_at->format('M d, Y') }}</span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <div class="flex items-center justify-center space-x-2">
                                                        <a href="{{ route('admin.users.show', $user) }}"
                                                            class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 px-3 py-1.5 rounded-lg hover:bg-blue-50 border border-blue-100"
                                                            title="View User Details">
                                                            <i class="fas fa-eye"></i>
                                                            <span class="text-xs">View</span>
                                                        </a>
                                                        @if($user->id !== auth()->id())
                                                        <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')"
                                                            class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 px-3 py-1.5 rounded-lg hover:bg-red-50 border border-red-100"
                                                            title="Delete User">
                                                            <i class="fas fa-trash"></i>
                                                            <span class="text-xs">Delete</span>
                                                        </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="p-8 text-center text-slate-400">
                                                    <div class="flex flex-col items-center">
                                                        <i class="fas fa-users text-4xl mb-4 text-slate-300"></i>
                                                        <p class="text-lg font-semibold mb-2">No users found</p>
                                                        <p class="text-sm">No users match your current filters.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="flex justify-center mt-6">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </main>

    <script>
        // Search functionality
        document.getElementById('search-users').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });

        // Role filter
        document.getElementById('role-filter').addEventListener('change', function() {
            const role = this.value;
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const roleSelect = row.querySelector('select');
                if (roleSelect) {
                    const userRole = roleSelect.value;
                    if (role === '' || userRole === role) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });

        // Status filter
        document.getElementById('status-filter').addEventListener('change', function() {
            const status = this.value;
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(6) span');
                if (statusCell) {
                    const userStatus = statusCell.textContent.toLowerCase().trim();
                    if (status === '' || userStatus === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });

        // Select all functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkDeleteButton();
        });

        // Individual checkbox functionality
        document.querySelectorAll('.user-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkDeleteButton);
        });

        function updateBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            
            if (checkedBoxes.length > 0) {
                bulkDeleteBtn.classList.remove('hidden');
            } else {
                bulkDeleteBtn.classList.add('hidden');
            }
        }

        // Bulk delete functionality
        document.getElementById('bulk-delete-btn').addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const userIds = Array.from(checkedBoxes).map(cb => cb.value);
            
            if (userIds.length === 0) return;
            
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete ${userIds.length} user(s). This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/admin/users/bulk-delete', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ user_ids: userIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Deleted!', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    });
                }
            });
        });

        // Update user role
        function updateUserRole(userId, newRole) {
            fetch(`/admin/users/${userId}/role`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ role: newRole })
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
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Something went wrong.', 'error');
            });
        }

        // Delete user
        function deleteUser(userId, userName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete user "${userName}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Deleted!', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    });
                }
            });
        }
    </script>
@endsection
