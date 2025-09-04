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
                            My Orders
                        </li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">My Beer Orders</h6>
                </nav>
            </div>
        </nav>

        <div class="w-full px-6 py-6 mx-auto">
            <!-- Order Filters -->
            <div class="flex flex-wrap items-center justify-between mb-6 -mx-3">
                <div class="w-full px-3 mb-3 md:mb-0 md:w-1/2 lg:w-1/6">
                    <div class="relative">
                        <label for="status-filter" class="sr-only">Filter by status</label>
                        <select id="status-filter"
                            class="block w-full px-3 py-2 text-sm font-normal text-gray-700 transition-all bg-white border border-gray-200 rounded-lg outline-none focus:shadow-soft-primary-outline focus:border-fuchsia-300">
                            <option value="">All Statuses</option>
                            <option value="Pending">Pending</option>
                            <option value="Processing">Processing</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="w-full px-3 mb-3 md:mb-0 md:w-1/2 lg:w-1/6">
                    <div class="relative">
                        <select id="time-filter"
                            class="block w-full px-3 py-2 text-sm font-normal text-gray-700 transition-all bg-white border border-gray-200 rounded-lg outline-none focus:shadow-soft-primary-outline focus:border-fuchsia-300">
                            <option value="">All Time</option>
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                            <option value="quarter">This Quarter</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                </div>
                <div class="w-full px-3 mb-3 md:mb-0 md:w-1/2 lg:w-1/6">
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-slate-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <label for="search-group" class="sr-only">Search order group</label>
                        <input id="search-group" type="text"
                            class="pl-9 pr-3 py-2 w-full text-sm border border-gray-200 rounded-lg focus:shadow-soft-primary-outline focus:border-fuchsia-300"
                            placeholder="Search by order group...">
                    </div>
                </div>
                <div class="w-full px-3 mb-3 md:mb-0 md:w-1/2 lg:w-1/6">
                    <div class="relative flex items-center">
                        <span class="absolute ml-2">
                            <i class="fas fa-calendar text-slate-400"></i>
                        </span>
                        <input type="text" id="date-range"
                            class="pl-8 pr-2 py-2 text-sm border border-gray-200 rounded-lg focus:shadow-soft-primary-outline focus:border-fuchsia-300"
                            placeholder="Select date range">
                    </div>
                </div>
                <div class="w-full px-3 md:w-1/2 lg:w-1/6">
                    <button id="bulk-delete-btn" 
                        class="px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-red-600 to-pink-400 rounded-lg ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hidden">
                        Delete Selected
                    </button>
                </div>
                <div class="w-full px-3 mt-3 md:mt-0 md:w-auto">
                    <button id="reset-filters"
                        class="px-4 py-2 text-sm font-normal text-gray-700 transition-all bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                        Reset Filters
                    </button>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            </th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                Order Group
                                            </th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th
                                                class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                Items
                                            </th>
                                            <th
                                                class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                Total
                                            </th>
                                            <th
                                                class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                Payment
                                            </th>
                                            <th
                                                class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th
                                                class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $groupCode => $groupOrders)
                                            @php
                                                $firstOrder = $groupOrders->first();
                                                $totalAmount = $groupOrders->sum('total_price');
                                                $totalItems = $groupOrders->sum('quantity');
                                                $status = $firstOrder->status;
                                                $paymentMethod = $firstOrder->payment_method;
                                            @endphp
                                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 align-middle whitespace-nowrap">
                                                    <input type="checkbox" class="order-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $groupCode }}">
                                                </td>
                                                <td class="px-6 py-4 align-middle whitespace-nowrap">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-10 h-10 rounded-full bg-gradient-to-tl from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold">
                                                            <i class="fas fa-boxes"></i>
                                                        </div>
                                                        <div class="min-w-0">
                                                            <div class="flex items-center gap-2">
                                                                <span
                                                                    class="text-sm font-semibold text-blue-600 truncate max-w-[180px]"
                                                                    title="{{ $groupCode }}">{{ $groupCode }}</span>
                                                                <button type="button"
                                                                    onclick="copyGroupCode('{{ $groupCode }}')"
                                                                    class="text-gray-400 hover:text-gray-600"
                                                                    title="Copy group code">
                                                                    <i class="far fa-copy"></i>
                                                                </button>
                                                            </div>
                                                            <p class="text-xs text-gray-400">{{ $groupOrders->count() }}
                                                                items</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 align-middle whitespace-nowrap">
                                                    <span
                                                        class="text-sm text-gray-600">{{ $firstOrder->created_at->format('M d, Y H:i') }}</span>
                                                </td>
                                                <td class="px-6 py-4 align-middle text-center whitespace-nowrap">
                                                    <div class="flex flex-col items-center space-y-1">
                                                        @foreach ($groupOrders->take(3) as $order)
                                                            <div class="flex items-center justify-center gap-2">
                                                                @if($order->beer)
                                                                    <img src="{{ asset('storage/' . $order->beer->image) }}"
                                                                        alt="{{ $order->beer->name }}"
                                                                        class="w-6 h-6 rounded object-cover">
                                                                    <span class="text-xs text-gray-700">{{ $order->beer->name }}
                                                                        ({{ $order->quantity }})</span>
                                                                @else
                                                                    <div class="w-6 h-6 rounded bg-gray-200 flex items-center justify-center">
                                                                        <i class="fas fa-beer text-xs text-gray-500"></i>
                                                                    </div>
                                                                    <span class="text-xs text-gray-500">Unknown Beer
                                                                        ({{ $order->quantity }})</span>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                        @if ($groupOrders->count() > 3)
                                                            <span
                                                                class="text-xs text-gray-400">+{{ $groupOrders->count() - 3 }}
                                                                more</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 align-middle text-center whitespace-nowrap">
                                                    <div>
                                                        <span
                                                            class="text-lg font-bold text-green-600">${{ number_format($totalAmount, 2) }}</span>
                                                        <p class="text-xs text-gray-400">{{ $totalItems }} items</p>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 align-middle text-center whitespace-nowrap">
                                                    @php
                                                        $paymentColors = [
                                                            'cod' => 'from-orange-500 to-red-500',
                                                            'card' => 'from-green-500 to-emerald-500',
                                                        ];
                                                        $paymentColor =
                                                            $paymentColors[$paymentMethod] ??
                                                            'from-gray-500 to-slate-500';
                                                        $paymentText =
                                                            $paymentMethod === 'cod'
                                                                ? 'Cash on Delivery'
                                                                : 'Card Payment';
                                                    @endphp
                                                    <span
                                                        class="bg-gradient-to-tl {{ $paymentColor }} px-4 py-1.5 rounded-lg text-xs text-white font-semibold">{{ $paymentText }}</span>
                                                </td>
                                                <td class="px-6 py-4 align-middle text-center whitespace-nowrap">
                                                    @php
                                                        $statusColors = [
                                                            'Pending' => 'from-yellow-500 to-orange-500',
                                                            'Processing' => 'from-blue-500 to-cyan-500',
                                                            'Shipped' => 'from-purple-500 to-pink-500',
                                                            'Delivered' => 'from-green-500 to-emerald-500',
                                                            'Cancelled' => 'from-red-500 to-pink-500',
                                                        ];
                                                        $color = $statusColors[$status] ?? 'from-gray-500 to-slate-500';
                                                    @endphp
                                                    <span
                                                        class="bg-gradient-to-tl {{ $color }} px-3 py-1.5 rounded-lg text-xs text-white font-semibold">{{ $status }}</span>
                                                </td>
                                                <td class="px-6 py-4 align-middle text-center whitespace-nowrap">
                                                    <div class="flex items-center justify-center gap-2">
                                                        <button onclick="reorderGroup('{{ $groupCode }}')"
                                                            class="inline-flex items-center gap-1 text-orange-600 hover:text-orange-800 px-3 py-1.5 rounded-lg hover:bg-orange-50 border border-orange-100"
                                                            title="Reorder this order">
                                                            <i class="fas fa-redo"></i>
                                                            <span class="hidden sm:inline">Reorder</span>
                                                        </button>
                                                        <a href="{{ route('invoice.print', $groupCode) }}"
                                                            class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-800 px-3 py-1.5 rounded-lg hover:bg-indigo-50 border border-indigo-100"
                                                            title="Preview/Print Invoice">
                                                            <i class="fas fa-print"></i>
                                                            <span class="hidden sm:inline">Preview</span>
                                                        </a>
                                                        <a href="{{ route('invoice.download', $groupCode) }}"
                                                            class="inline-flex items-center gap-1 text-green-600 hover:text-green-800 px-3 py-1.5 rounded-lg hover:bg-green-50 border border-green-100"
                                                            title="Download Invoice">
                                                            <i class="fas fa-download"></i>
                                                            <span class="hidden sm:inline">Download</span>
                                                        </a>
                                                        <button onclick="messageAdmin('{{ $groupCode }}', '{{ $firstOrder->user->name }}')"
                                                            class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 px-3 py-1.5 rounded-lg hover:bg-blue-50 border border-blue-100"
                                                            title="Message Admin About This Order">
                                                            <i class="fas fa-comment"></i>
                                                            <span class="hidden sm:inline">Message</span>
                                                        </button>
                                                        <button onclick="deleteOrderGroup('{{ $groupCode }}')"
                                                            class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 px-3 py-1.5 rounded-lg hover:bg-red-50 border border-red-100"
                                                            title="Delete Order Group">
                                                            <i class="fas fa-trash"></i>
                                                            <span class="hidden sm:inline">Delete</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="p-8 text-center text-gray-400">
                                                    <div class="flex flex-col items-center gap-2">
                                                        <i class="fas fa-shopping-cart text-4xl text-gray-300"></i>
                                                        <p class="text-lg font-semibold">No orders yet</p>
                                                        <p class="text-sm">Start your beer journey by placing your first
                                                            order!</p>
                                                        <a href="{{ route('buybeer') }}"
                                                            class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-6 py-3 rounded-lg text-white font-semibold hover:shadow-lg transition-all duration-200">
                                                            Browse Beers
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


            <!-- Order Summary -->
            @if ($orders->count() > 0)
                <div class="flex flex-wrap mt-8 -mx-3">
                    <div class="w-full px-3 lg:w-1/3">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                            <!-- Header -->
                            <div class="bg-gray-50 border-b border-gray-200 rounded-t-2xl p-6">
                                <h6 class="text-lg font-semibold text-gray-700">Order Summary</h6>
                            </div>

                            <!-- Content -->
                            <div class="flex-auto p-6 space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Total Order Groups:</span>
                                    <span class="font-semibold text-gray-800">{{ $orders->count() }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Total Spent:</span>
                                    <span
                                        class="font-semibold text-green-600 text-lg">${{ number_format($orders->flatten()->sum('total_price'), 2) }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Total Items:</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $orders->flatten()->sum('quantity') }}</span>
                                </div>

                                <!-- Optional: Add a subtle divider -->
                                <div class="border-t border-gray-200 mt-4 pt-4">
                                    <p class="text-xs text-gray-400">Summary of all your beer orders in this account.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </main>

    <!-- Order Details Modal -->
    <div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-96 overflow-y-auto">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Order Details</h3>
                        <button onclick="closeOrderModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="orderModalContent" class="p-6">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Message Admin Modal -->
    <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Message Admin</h3>
                        <button onclick="closeMessageModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <form id="messageForm">
                        <div class="mb-4">
                            <label for="orderGroup" class="block text-sm font-medium text-gray-700 mb-2">Order Group</label>
                            <input type="text" id="orderGroup" name="orderGroup" readonly 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter subject...">
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="6" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Describe your issue or question about this order..."></textarea>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeMessageModal()"
                                class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Select all functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkDeleteButton();
        });

        // Individual checkbox functionality
        document.querySelectorAll('.order-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkDeleteButton);
        });

        function updateBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.order-checkbox:checked');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            
            if (checkedBoxes.length > 0) {
                bulkDeleteBtn.classList.remove('hidden');
                bulkDeleteBtn.textContent = `Delete Selected (${checkedBoxes.length})`;
            } else {
                bulkDeleteBtn.classList.add('hidden');
            }
        }

        // Bulk delete functionality
        document.getElementById('bulk-delete-btn').addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.order-checkbox:checked');
            const groupCodes = Array.from(checkedBoxes).map(cb => cb.value);
            
            if (groupCodes.length === 0) return;

            Swal.fire({
                title: 'Delete Selected Orders?',
                text: `Are you sure you want to delete ${groupCodes.length} order group(s)? This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    bulkDeleteOrders(groupCodes);
                }
            });
        });

        function bulkDeleteOrders(groupCodes) {
            fetch('/user/orders/bulk-delete', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ groupCodes: groupCodes })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Failed to delete orders'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error deleting orders'
                });
            });
        }

        // Time filter functionality
        document.getElementById('time-filter').addEventListener('change', function() {
            const timeFilter = this.value;
            const rows = document.querySelectorAll('tbody tr');
            const now = new Date();
            
            rows.forEach(row => {
                const dateCell = row.querySelector('td:nth-child(2) span');
                if (!dateCell) return;
                
                const orderDate = new Date(dateCell.textContent);
                let show = true;
                
                switch(timeFilter) {
                    case 'today':
                        show = orderDate.toDateString() === now.toDateString();
                        break;
                    case 'week':
                        const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                        show = orderDate >= weekAgo;
                        break;
                    case 'month':
                        const monthAgo = new Date(now.getFullYear(), now.getMonth(), 1);
                        show = orderDate >= monthAgo;
                        break;
                    case 'quarter':
                        const quarterStart = new Date(now.getFullYear(), Math.floor(now.getMonth() / 3) * 3, 1);
                        show = orderDate >= quarterStart;
                        break;
                    case 'year':
                        const yearStart = new Date(now.getFullYear(), 0, 1);
                        show = orderDate >= yearStart;
                        break;
                    default:
                        show = true;
                }
                
                row.style.display = show ? '' : 'none';
            });
        });

        // Status filter functionality
        document.getElementById('status-filter').addEventListener('change', function() {
            const status = this.value;
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(6) span');
                if (statusCell) {
                    const orderStatus = statusCell.textContent.trim();
                    if (status === '' || orderStatus === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });

        // Search by group code
        document.getElementById('search-group').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const codeEl = row.querySelector('td:nth-child(1) span.text-sm');
                if (!codeEl) return;
                const code = codeEl.getAttribute('title') || codeEl.textContent;
                if (code.toLowerCase().includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Copy group code helper
        function copyGroupCode(groupCode) {
            navigator.clipboard.writeText(groupCode).then(() => {
                const toast = document.createElement('div');
                toast.textContent = 'Group code copied';
                toast.className =
                    'fixed bottom-6 right-6 bg-black text-white text-xs px-3 py-2 rounded-md opacity-90';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 1500);
            });
        }

        // View order details
        function viewOrderDetails(groupCode) {
            // This would typically fetch order details via AJAX
            // For now, we'll show a simple message
            document.getElementById('orderModalContent').innerHTML = `
                <div class="text-center">
                    <h4 class="text-lg font-semibold mb-4">Order Group: ${groupCode}</h4>
                    <p class="text-gray-600">Detailed order information would be displayed here.</p>
                </div>
            `;
            document.getElementById('orderModal').classList.remove('hidden');
        }

        // Close order modal
        function closeOrderModal() {
            document.getElementById('orderModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('orderModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });

        // Message admin functionality
        function messageAdmin(groupCode, customerName) {
            document.getElementById('orderGroup').value = groupCode;
            document.getElementById('messageModal').classList.remove('hidden');
        }

        function closeMessageModal() {
            document.getElementById('messageModal').classList.add('hidden');
            document.getElementById('messageForm').reset();
        }

        // Handle message form submission
        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                orderGroup: formData.get('orderGroup'),
                subject: formData.get('subject'),
                message: formData.get('message')
            };

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            fetch('/user/message-admin', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    closeMessageModal();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message || 'Failed to send message'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error sending message'
                });
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });

        // Close message modal when clicking outside
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMessageModal();
            }
        });

        // Delete individual order group
        function deleteOrderGroup(groupCode) {
            Swal.fire({
                title: 'Delete Order Group?',
                text: `Are you sure you want to delete order group ${groupCode}? This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/user/orders/group/${groupCode}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message || 'Failed to delete order'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Error deleting order'
                        });
                    });
                }
            });
        }

        // Reorder functionality
        function reorderGroup(groupCode) {
            if (!confirm('Are you sure you want to reorder this order? This will create a new order with the same items.')) {
                return;
            }

            // Show loading state
            const button = event.target.closest('button');
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span class="hidden sm:inline">Processing...</span>';
            button.disabled = true;

            // Make AJAX request
            fetch(`/user/reorder/${groupCode}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showToast('Order reordered successfully!', 'success');
                    
                    // Optionally redirect to orders page or refresh
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || 'Failed to reorder. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                // Restore button state
                button.innerHTML = originalContent;
                button.disabled = false;
            });
        }

        // Reset filters
        document.getElementById('reset-filters').addEventListener('click', function() {
            document.getElementById('status-filter').value = '';
            document.getElementById('time-filter').value = '';
            document.getElementById('search-group').value = '';
            document.getElementById('date-range').value = '';
            document.getElementById('select-all').checked = false;
            
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.style.display = '';
            });
            
            const checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            
            updateBulkDeleteButton();
        });

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.textContent = message;
            
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500'
            };
            
            toast.className = `fixed bottom-6 right-6 ${colors[type]} text-white text-sm px-4 py-3 rounded-lg shadow-lg z-50`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
@endsection
