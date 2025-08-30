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
                            Orders Management
                        </li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">All Customer Orders</h6>
                </nav>
                <div class="flex items-center">
                    <a href="#"
                        class="px-4 py-2 mr-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                        Export Orders
                    </a>
                </div>
            </div>
        </nav>

        <div class="w-full px-6 py-6 mx-auto">
            <!-- Order Filter -->
            <div class="flex flex-wrap items-center justify-between mb-6 -mx-3">
                <div class="w-full px-3 mb-6 md:mb-0 md:w-1/2 lg:w-1/4">
                    <div class="relative">
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
                <div class="w-full px-3 mb-6 md:mb-0 md:w-1/2 lg:w-1/4">
                    <div class="relative">
                        <select id="payment-filter"
                            class="block w-full px-3 py-2 text-sm font-normal text-gray-700 transition-all bg-white border border-gray-200 rounded-lg outline-none focus:shadow-soft-primary-outline focus:border-fuchsia-300">
                            <option value="">All Payment Methods</option>
                            <option value="cod">Cash on Delivery</option>
                            <option value="card">Card Payment</option>
                        </select>
                    </div>
                </div>
                <div class="w-full px-3 md:w-1/2 lg:w-1/4">
                    <div class="relative flex items-center">
                        <span class="absolute ml-2">
                            <i class="fas fa-calendar text-slate-400"></i>
                        </span>
                        <input type="text" id="date-range"
                            class="block w-full pl-8 pr-2 py-2 text-sm border border-gray-200 rounded-lg focus:shadow-soft-primary-outline focus:border-fuchsia-300"
                            placeholder="Select date range">
                    </div>
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
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6 px-0 pb-2">
                            <div class="overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Order Group
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Customer
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Items
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Total
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Payment
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
                                        @forelse($orders as $groupCode => $groupOrders)
                                            @php
                                                $firstOrder = $groupOrders->first();
                                                $totalAmount = $groupOrders->sum('total_price');
                                                $totalItems = $groupOrders->sum('quantity');
                                                $status = $firstOrder->status;
                                                $paymentMethod = $firstOrder->payment_method;
                                            @endphp
                                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tl from-blue-500 to-cyan-400 flex items-center justify-center text-white text-sm font-bold mr-3">
                                                            <i class="fas fa-boxes"></i>
                                                        </div>
                                                        <div>
                                                            <span class="text-sm font-semibold text-blue-600">{{ $groupCode }}</span>
                                                            <p class="text-xs text-slate-400">{{ $groupOrders->count() }} items</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-8 h-8 rounded-full bg-gradient-to-tl from-green-500 to-emerald-400 flex items-center justify-center text-white text-sm font-bold mr-2">
                                                            {{ strtoupper(substr($firstOrder->user->name, 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <span class="text-sm font-semibold">{{ $firstOrder->user->name }}</span>
                                                            <p class="text-xs text-slate-400">{{ $firstOrder->user->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <div class="space-y-1">
                                                        @foreach($groupOrders->take(3) as $order)
                                                            <div class="flex items-center justify-center space-x-2">
                                                                <img src="{{ asset('storage/' . $order->image) }}" 
                                                                     alt="{{ $order->beer->name }}" 
                                                                     class="w-6 h-6 rounded object-cover">
                                                                <span class="text-xs">{{ $order->beer->name }} ({{ $order->quantity }})</span>
                                                            </div>
                                                        @endforeach
                                                        @if($groupOrders->count() > 3)
                                                            <span class="text-xs text-slate-400">+{{ $groupOrders->count() - 3 }} more</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <div class="text-center">
                                                        <span class="text-lg font-bold text-green-600">${{ number_format($totalAmount, 2) }}</span>
                                                        <p class="text-xs text-slate-400">{{ $totalItems }} items</p>
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    @php
                                                        $paymentColors = [
                                                            'cod' => 'from-orange-500 to-red-500',
                                                            'card' => 'from-green-500 to-emerald-500'
                                                        ];
                                                        $paymentColor = $paymentColors[$paymentMethod] ?? 'from-gray-500 to-slate-500';
                                                        $paymentText = $paymentMethod === 'cod' ? 'Cash on Delivery' : 'Card Payment';
                                                    @endphp
                                                    <span class="bg-gradient-to-tl {{ $paymentColor }} px-3 py-1.5 rounded-lg text-xs text-white font-semibold">
                                                        {{ $paymentText }}
                                                    </span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <select onchange="updateGroupStatus('{{ $groupCode }}', this.value)" 
                                                            class="px-3 py-1.5 text-xs font-semibold rounded-lg border-0 focus:ring-2 focus:ring-blue-500">
                                                        @php
                                                            $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
                                                            $statusColors = [
                                                                'Pending' => 'bg-yellow-100 text-yellow-800',
                                                                'Processing' => 'bg-blue-100 text-blue-800',
                                                                'Shipped' => 'bg-purple-100 text-purple-800',
                                                                'Delivered' => 'bg-green-100 text-green-800',
                                                                'Cancelled' => 'bg-red-100 text-red-800'
                                                            ];
                                                        @endphp
                                                        @foreach($statuses as $statusOption)
                                                            <option value="{{ $statusOption }}" 
                                                                    {{ $status === $statusOption ? 'selected' : '' }}
                                                                    class="{{ $statusColors[$statusOption] }}">
                                                                {{ $statusOption }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <span class="text-sm">{{ $firstOrder->created_at->format('M d, Y H:i') }}</span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <div class="flex items-center justify-center space-x-2">
                                                        <button onclick="viewOrderDetails('{{ $groupCode }}')"
                                                            class="text-blue-500 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50"
                                                            title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        @if($status !== 'Cancelled')
                                                        <button onclick="cancelOrderGroup('{{ $groupCode }}')"
                                                            class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50"
                                                            title="Cancel All Orders">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="p-8 text-center text-slate-400">
                                                    <div class="flex flex-col items-center">
                                                        <i class="fas fa-shopping-cart text-4xl mb-4 text-slate-300"></i>
                                                        <p class="text-lg font-semibold mb-2">No orders found</p>
                                                        <p class="text-sm">Orders will appear here once customers start placing them.</p>
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
            @if($orders->count() > 0)
            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full px-3 lg:w-1/3">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                            <h6>Orders Summary</h6>
                        </div>
                        <div class="flex-auto p-6 px-0 pb-2">
                            <div class="flex justify-between mb-3">
                                <span class="text-sm text-slate-600">Total Order Groups:</span>
                                <span class="font-semibold">{{ $orders->count() }}</span>
                            </div>
                            <div class="flex justify-between mb-3">
                                <span class="text-sm text-slate-600">Total Revenue:</span>
                                <span class="font-semibold text-green-600">${{ number_format($orders->flatten()->sum('total_price'), 2) }}</span>
                            </div>
                            <div class="flex justify-between mb-3">
                                <span class="text-sm text-slate-600">Total Items:</span>
                                <span class="font-semibold">{{ $orders->flatten()->sum('quantity') }}</span>
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

    <script>
        // Status filter functionality
        document.getElementById('status-filter').addEventListener('change', function() {
            const status = this.value;
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(6) select');
                if (statusCell) {
                    const orderStatus = statusCell.value;
                    if (status === '' || orderStatus === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });

        // Payment filter functionality
        document.getElementById('payment-filter').addEventListener('change', function() {
            const payment = this.value;
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const paymentCell = row.querySelector('td:nth-child(5) span');
                if (paymentCell) {
                    const orderPayment = paymentCell.textContent.toLowerCase();
                    if (payment === '' || orderPayment.includes(payment)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });

        // Update group status
        function updateGroupStatus(groupCode, newStatus) {
            fetch(`/admin/orders/group/${groupCode}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to update order status'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error updating order status'
                });
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

        // Cancel order group
        function cancelOrderGroup(groupCode) {
            Swal.fire({
                title: 'Cancel Order Group?',
                text: `Are you sure you want to cancel all orders in group ${groupCode}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, cancel all!'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateGroupStatus(groupCode, 'Cancelled');
                }
            });
        }

        // Reset filters
        document.getElementById('reset-filters').addEventListener('click', function() {
            document.getElementById('status-filter').value = '';
            document.getElementById('payment-filter').value = '';
            document.getElementById('date-range').value = '';
            
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.style.display = '';
            });
        });

        // Close modal when clicking outside
        document.getElementById('orderModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeOrderModal();
            }
        });
    </script>
@endsection
