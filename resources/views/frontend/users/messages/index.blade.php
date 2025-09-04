@extends('layout.app')

@section('main')
    <main class="ease-soft-in-out relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <nav
            class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="opacity-50 text-slate-700" href="{{ route('user-home') }}">Dashboard</a>
                        </li>
                        <li
                            class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">
                            My Messages
                        </li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">My Messages to Admin</h6>
                </nav>
            </div>
        </nav>

        <div class="w-full px-6 py-6 mx-auto">
            <!-- Message Filters -->
            <div class="flex flex-wrap items-center justify-between mb-6 -mx-3">
                <div class="w-full px-3 mb-6 md:mb-0 md:w-1/2 lg:w-1/4">
                    <div class="relative">
                        <select id="status-filter"
                            class="block w-full px-3 py-2 text-sm font-normal text-gray-700 transition-all bg-white border border-gray-200 rounded-lg outline-none focus:shadow-soft-primary-outline focus:border-fuchsia-300">
                            <option value="">All Status</option>
                            <option value="unread">Unread</option>
                            <option value="read">Read</option>
                            <option value="replied">Replied</option>
                        </select>
                    </div>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0 md:w-1/2 lg:w-1/4">
                    <div class="relative">
                        <span class="absolute ml-2">
                            <i class="fas fa-search text-slate-400"></i>
                        </span>
                        <input type="text" id="search-messages"
                            class="block w-full pl-8 pr-2 py-2 text-sm border border-gray-200 rounded-lg focus:shadow-soft-primary-outline focus:border-fuchsia-300"
                            placeholder="Search messages...">
                    </div>
                </div>
                <div class="w-full px-3 md:w-auto">
                    <button id="reset-filters"
                        class="px-4 py-2 text-sm font-normal text-gray-700 transition-all bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                        Reset Filters
                    </button>
                </div>
                <div class="w-full px-3 md:w-auto">
                    <button id="bulk-delete-btn" class="px-4 py-2 text-sm font-normal text-white transition-all bg-red-500 border border-red-500 rounded-lg hover:bg-red-600 hidden">
                        <i class="fas fa-trash mr-2"></i>Delete Selected
                    </button>
                </div>
            </div>

            <!-- Messages Table -->
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
                                                Order Group
                                            </th>
                                                                                         <th
                                                 class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                 Subject
                                             </th>
                                             <th
                                                 class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                 Admin Reply
                                             </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Status
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Date
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($messages as $message)
                                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <input type="checkbox" class="message-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $message->id }}">
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <span class="text-sm font-semibold text-blue-600">{{ $message->order_group }}</span>
                                                </td>
                                                                                                 <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                     <span class="text-sm">{{ $message->subject }}</span>
                                                 </td>
                                                 <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                     @if($message->admin_reply)
                                                         <div class="flex items-center">
                                                             <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2">
                                                                 <i class="fas fa-reply text-xs mr-1"></i>
                                                                 Replied
                                                             </span>
                                                             <span class="text-sm text-gray-600 truncate max-w-xs" title="{{ $message->admin_reply }}">
                                                                 {{ Str::limit($message->admin_reply, 50) }}
                                                             </span>
                                                         </div>
                                                     @else
                                                         <span class="text-sm text-gray-400 italic">No reply yet</span>
                                                     @endif
                                                 </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    @php
                                                        $statusColors = [
                                                            'unread' => 'from-red-500 to-pink-500',
                                                            'read' => 'from-yellow-500 to-orange-500',
                                                            'replied' => 'from-green-500 to-emerald-500'
                                                        ];
                                                        $color = $statusColors[$message->status] ?? 'from-gray-500 to-slate-500';
                                                    @endphp
                                                    <span class="bg-gradient-to-tl {{ $color }} px-3 py-1.5 rounded-lg text-xs text-white font-semibold">
                                                        {{ ucfirst($message->status) }}
                                                    </span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <span class="text-sm">{{ $message->created_at->format('M d, Y H:i') }}</span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <div class="flex items-center justify-center space-x-2">
                                                        <button onclick="viewMessage({{ $message->id }})"
                                                            class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 px-3 py-1.5 rounded-lg hover:bg-blue-50 border border-blue-100"
                                                            title="View Message">
                                                            <i class="fas fa-eye"></i>
                                                            <span class="text-xs">View</span>
                                                        </button>
                                                        <button onclick="deleteMessage({{ $message->id }}, '{{ $message->subject }}')"
                                                            class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 px-3 py-1.5 rounded-lg hover:bg-red-50 border border-red-100"
                                                            title="Delete Message">
                                                            <i class="fas fa-trash"></i>
                                                            <span class="text-xs">Delete</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                                                                                                                     <tr>
                                                <td colspan="7" class="p-8 text-center text-slate-400">
                                                    <div class="flex flex-col items-center">
                                                        <i class="fas fa-comments text-4xl mb-4 text-slate-300"></i>
                                                        <p class="text-lg font-semibold mb-2">No messages yet</p>
                                                        <p class="text-sm">You haven't sent any messages to admin yet.</p>
                                                        <a href="{{ route('my-orders') }}"
                                                            class="mt-4 bg-gradient-to-tl from-blue-600 to-cyan-400 px-6 py-3 rounded-lg text-white font-semibold hover:shadow-lg transition-all duration-200">
                                                            Go to My Orders
                                                        </a>
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
            @if($messages->hasPages())
            <div class="flex justify-center mt-6">
                {{ $messages->links() }}
            </div>
            @endif
        </div>
    </main>

    <!-- Message View Modal -->
    <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-4xl w-full max-h-96 overflow-y-auto relative">
                <!-- Close button in top-right corner -->
                <button onclick="closeMessageModal()" 
                    class="absolute top-4 right-4 z-10 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center transition-colors duration-200 shadow-lg">
                    <i class="fas fa-times text-sm"></i>
                </button>
                
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Message Details</h3>
                        <button onclick="closeMessageModal()" 
                            class="text-gray-400 hover:text-gray-600 px-3 py-1 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <i class="fas fa-times mr-1"></i>
                            Close
                        </button>
                    </div>
                </div>
                <div id="messageModalContent" class="p-6">
                    <!-- Content will be loaded here -->
                </div>
                
                <!-- Close button at bottom -->
                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    <div class="flex justify-end">
                        <button onclick="closeMessageModal()" 
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Close Modal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Status filter functionality
        document.getElementById('status-filter').addEventListener('change', function() {
            const status = this.value;
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(3) span');
                if (statusCell) {
                    const messageStatus = statusCell.textContent.toLowerCase().trim();
                    if (status === '' || messageStatus === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });

        // Search functionality
        document.getElementById('search-messages').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });

        // Reset filters
        document.getElementById('reset-filters').addEventListener('click', function() {
            document.getElementById('status-filter').value = '';
            document.getElementById('search-messages').value = '';
            
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.style.display = '';
            });
        });

        // View message
        function viewMessage(messageId) {
            fetch(`/user/messages/${messageId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('messageModalContent').innerHTML = html;
                    document.getElementById('messageModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error loading message'
                    });
                });
        }

        // Close message modal
        function closeMessageModal() {
            document.getElementById('messageModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMessageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('messageModal');
                if (!modal.classList.contains('hidden')) {
                    closeMessageModal();
                }
            }
        });

        // Select all functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.message-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkDeleteButton();
        });

        // Individual checkbox functionality
        document.querySelectorAll('.message-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkDeleteButton);
        });

        function updateBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            
            if (checkedBoxes.length > 0) {
                bulkDeleteBtn.classList.remove('hidden');
            } else {
                bulkDeleteBtn.classList.add('hidden');
            }
        }

        // Bulk delete functionality
        document.getElementById('bulk-delete-btn').addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');
            const messageIds = Array.from(checkedBoxes).map(cb => cb.value);
            
            if (messageIds.length === 0) return;
            
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete ${messageIds.length} message(s). This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/user/messages/bulk-delete', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ message_ids: messageIds })
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

        // Delete single message
        function deleteMessage(messageId, messageSubject) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete message "${messageSubject}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/user/messages/${messageId}`, {
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
