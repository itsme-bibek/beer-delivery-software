@extends('layout.app')

@section('main')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="true">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="opacity-50 text-slate-700" href="javascript:;">Admin</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                            aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">Beer Orders Dashboard</h6>
                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center md:ml-auto md:pr-4">
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                            <span
                                class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text"
                                class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                placeholder="Search orders..." />
                        </div>
                    </div>
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <li class="flex items-center">
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500">
                                <i class="fa fa-user sm:mr-1"></i>
                                <span class="hidden sm:inline">Admin</span>
                            </a>
                        </li>
                        <li class="flex items-center pl-4 xl:hidden">
                            <a href="javascript:;" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500"
                                sidenav-trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i
                                        class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                    <i
                                        class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                    <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- end Navbar -->

        

        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 - Summary Cards -->
            <div class="flex flex-wrap -mx-3">
                <!-- Total Orders -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                                            Total Orders
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            {{ number_format($totalOrders) }}
                                            @if ($todayOrders > 0)
                                                <span
                                                    class="text-sm leading-normal font-weight-bolder text-lime-500">+{{ $todayOrders }}
                                                    today</span>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-500 to-cyan-400">
                                        <i class="fas fa-clipboard-list text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                                            Total Users
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            {{ number_format($totalUsers) }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-emerald-400">
                                        <i class="fas fa-users text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Beers -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                                            Total Beers
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            {{ number_format($totalBeers) }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-amber-500 to-yellow-400">
                                        <i class="fas fa-beer text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Sales -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                                            Total Sales
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            ${{ number_format($totalSales, 2) }}
                                            @if ($todaySales > 0)
                                                <span
                                                    class="text-sm leading-normal font-weight-bolder text-lime-500">+${{ number_format($todaySales, 2) }}
                                                    today</span>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-emerald-400">
                                        <i class="fas fa-dollar-sign text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Charts Section -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <!-- Order Status Pie Chart -->
                <div class="w-full px-3 mb-6 lg:mb-0 lg:w-1/2 lg:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">All Orders Status Distribution</h6>
                            <p class="text-sm text-slate-500 mt-1">System-wide order status breakdown</p>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="relative h-64">
                                <canvas id="adminOrderStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Trends Chart -->
                <div class="w-full px-3 mb-6 lg:mb-0 lg:w-1/2 lg:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Monthly Business Trends</h6>
                            <p class="text-sm text-slate-500 mt-1">System-wide order activity over the last 6 months</p>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="relative h-64">
                                <canvas id="adminMonthlyTrendsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Beers Chart -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full px-3">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Most Popular Beers</h6>
                            <p class="text-sm text-slate-500 mt-1">Top ordered beers across all users</p>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="relative h-64">
                                <canvas id="adminBeerPopularityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row 2 - Charts and Tables -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <!-- Recent Orders -->
                <div class="w-full px-3 mb-6 lg:mb-0 lg:w-8/12 lg:flex-none">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                            <h6>Recent Order Groups</h6>
                            <p class="text-sm leading-normal">
                                <i class="fa fa-arrow-up text-lime-500"></i>
                                <span class="font-semibold">{{ $recentOrders->count() }} recent order groups</span> from
                                customers
                            </p>
                        </div>
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
                                                Status
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                                Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentOrders as $groupCode => $groupOrders)
                                            @php
                                                $firstOrder = $groupOrders->first();
                                                $totalAmount = $groupOrders->sum('total_price');
                                                $totalItems = $groupOrders->sum('quantity');
                                                $status = $firstOrder->status;
                                            @endphp
                                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-8 h-8 rounded-full bg-gradient-to-tl from-blue-500 to-cyan-400 flex items-center justify-center text-white text-sm font-bold mr-2">
                                                            <i class="fas fa-boxes"></i>
                                                        </div>
                                                        <span
                                                            class="text-sm font-semibold text-blue-600">{{ $groupCode }}</span>
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <div class="flex px-2 py-1">
                                                        <div>
                                                            <h6 class="mb-0 text-sm leading-normal">
                                                                {{ $firstOrder->user->name }}</h6>
                                                            <p class="mb-0 text-xs leading-tight text-slate-400">
                                                                {{ $firstOrder->user->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <div class="text-center">
                                                        <span class="text-sm font-semibold">{{ $totalItems }}</span>
                                                        <p class="text-xs text-slate-400">{{ $groupOrders->count() }}
                                                            types</p>
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <span
                                                        class="text-sm font-semibold text-green-600">${{ number_format($totalAmount, 2) }}</span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
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
                                                        class="bg-gradient-to-tl {{ $color }} px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                        {{ $status }}
                                                    </span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <span
                                                        class="text-sm leading-normal">{{ $firstOrder->created_at->format('M d, Y') }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="p-4 text-center text-slate-400">
                                                    No orders found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Beers -->
                <div class="w-full px-3 lg:w-4/12 lg:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Popular Beers</h6>
                            <p class="text-sm text-slate-500 mt-1">
                                <i class="fa fa-arrow-up text-lime-500 mr-1"></i>
                                <span class="font-semibold">Most ordered beers</span> by customers
                            </p>
                        </div>
                        <div class="flex-auto p-6 px-0 pb-2">
                            @forelse($popularBeers as $beer)
                                <div
                                    class="flex items-center justify-between mb-4 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gradient-to-tl from-amber-500 to-yellow-400 flex items-center justify-center text-white text-lg font-bold mr-3">
                                            <i class="fas fa-beer"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-sm font-semibold text-gray-800">{{ $beer->name }}</h6>
                                            <p class="text-xs text-slate-400">{{ $beer->order_count }} orders</p>
                                        </div>
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-green-600">${{ number_format($beer->price, 2) }}</span>
                                </div>
                            @empty
                                <p class="text-center text-slate-400 py-4 text-sm">No popular beers yet</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

            <!-- row 3 - Additional Stats -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <!-- Orders by Status -->
                <div class="w-full px-3 mb-6 lg:mb-0 lg:w-6/12 lg:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Orders by Status</h6>
                        </div>
                        <div class="flex-auto p-6 px-0 pb-2">
                            @foreach ($ordersByStatus as $status => $count)
                                <div
                                    class="flex items-center justify-between mb-3 p-2 rounded-lg hover:bg-gray-50 transition">
                                    <span class="text-sm font-medium text-slate-700">{{ $status }}</span>
                                    <span class="font-semibold text-gray-800">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="w-full px-3 lg:w-6/12 lg:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Recent Users</h6>
                        </div>
                        <div class="flex-auto p-6 px-0 pb-2">
                            @forelse($recentUsers as $user)
                                <div
                                    class="flex items-center justify-between mb-3 p-2 rounded-lg hover:bg-gray-50 transition">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-tl from-green-500 to-emerald-400 flex items-center justify-center text-white text-lg font-bold mr-3">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="text-sm font-semibold text-gray-800">{{ $user->name }}</h6>
                                            <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-slate-400">{{ $user->created_at->format('M d') }}</span>
                                </div>
                            @empty
                                <p class="text-center text-slate-400 py-4 text-sm">No recent users</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            

        </div>
        <!-- end cards -->
    </main>

    <script>
        // Initialize admin charts when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeAdminCharts();
        });

        // Admin chart initialization function
        function initializeAdminCharts() {
            // Fetch admin analytics data
            fetch('/admin/analytics/admin')
                .then(response => response.json())
                .then(data => {
                    // Order Status Pie Chart
                    const statusCtx = document.getElementById('adminOrderStatusChart').getContext('2d');
                    new Chart(statusCtx, {
                        type: 'doughnut',
                        data: {
                            labels: data.statusAnalytics.labels,
                            datasets: [{
                                data: data.statusAnalytics.data,
                                backgroundColor: data.statusAnalytics.colors,
                                borderWidth: 2,
                                borderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true
                                    }
                                }
                            }
                        }
                    });

                    // Monthly Trends Chart
                    const trendsCtx = document.getElementById('adminMonthlyTrendsChart').getContext('2d');
                    new Chart(trendsCtx, {
                        type: 'line',
                        data: {
                            labels: data.monthlyTrends.months,
                            datasets: [{
                                label: 'Orders',
                                data: data.monthlyTrends.orderCounts,
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            }, {
                                label: 'Revenue ($)',
                                data: data.monthlyTrends.orderAmounts,
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                tension: 0.4,
                                fill: true,
                                yAxisID: 'y1'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                },
                                y1: {
                                    type: 'linear',
                                    display: true,
                                    position: 'right',
                                    grid: {
                                        drawOnChartArea: false,
                                    },
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top',
                                }
                            }
                        }
                    });

                    // Beer Popularity Chart
                    const beerCtx = document.getElementById('adminBeerPopularityChart').getContext('2d');
                    new Chart(beerCtx, {
                        type: 'bar',
                        data: {
                            labels: data.popularBeers.labels,
                            datasets: [{
                                label: 'Order Count',
                                data: data.popularBeers.data,
                                backgroundColor: [
                                    'rgba(59, 130, 246, 0.8)',
                                    'rgba(16, 185, 129, 0.8)',
                                    'rgba(245, 158, 11, 0.8)',
                                    'rgba(139, 92, 246, 0.8)',
                                    'rgba(239, 68, 68, 0.8)'
                                ],
                                borderColor: [
                                    'rgba(59, 130, 246, 1)',
                                    'rgba(16, 185, 129, 1)',
                                    'rgba(245, 158, 11, 1)',
                                    'rgba(139, 92, 246, 1)',
                                    'rgba(239, 68, 68, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                });
        }
    </script>
@endsection
