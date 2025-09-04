@extends('layout.app')

@section('main')
    <main class="ease-soft-in-out relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="true">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="opacity-50 text-slate-700" href="javascript:;">Dashboard</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                            aria-current="page">
                            My Beer Orders
                        </li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">Welcome Back, {{ $user->name }}!</h6>
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
                                placeholder="Search beers..." />
                        </div>
                    </div>
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <li class="flex items-center">
                            <a href="{{ route('buybeer') }}"
                                class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500">
                                <i class="fas fa-shopping-cart sm:mr-1"></i>
                                <span class="hidden sm:inline">Buy Beer</span>
                            </a>
                        </li>
                        <li class="flex items-center pl-4">
                            <a href="{{ route('my-orders') }}"
                                class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500">
                                <i class="fa fa-user sm:mr-1"></i>
                                <span class="hidden sm:inline">My Orders</span>
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
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                                            Total Orders
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            {{ number_format($totalOrders) }}
                                        </h5>
                                        <p class="mt-1 text-xxs text-slate-400">All-time orders on peaksip</p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-amber-500 to-yellow-400">
                                        <i class="fas fa-clipboard-list text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Spent -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                                            Total Spent
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            ${{ number_format($totalSpent, 2) }}
                                        </h5>
                                        <p class="mt-1 text-xxs text-slate-400">This includes all completed orders</p>
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

                <!-- Monthly Orders -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                                            This Month
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            {{ number_format($monthlyOrders ?? 0) }}
                                        </h5>
                                        <p class="mt-1 text-xxs text-slate-400">orders placed in {{ now()->format('M') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-500 to-cyan-400">
                                        <i class="fas fa-calendar text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Favorite Beer -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">
                                            Favorite Beer
                                        </p>
                                        <h5 class="mb-0 font-bold">
                                            {{ $favoriteBeer ? $favoriteBeer->name : 'None' }}
                                        </h5>
                                        @if ($favoriteBeer)
                                            <p class="mt-1 text-xxs text-slate-400">Your most ordered beer</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-500 to-pink-400">
                                        <i class="fas fa-heart text-lg relative top-3.5 text-white"></i>
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
                            <h6 class="text-lg font-semibold text-gray-800">Order Status Distribution</h6>
                            <p class="text-sm text-slate-500 mt-1">Your orders breakdown by status</p>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="relative h-64">
                                <canvas id="orderStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Trends Chart -->
                <div class="w-full px-3 mb-6 lg:mb-0 lg:w-1/2 lg:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Monthly Order Trends</h6>
                            <p class="text-sm text-slate-500 mt-1">Your order activity over the last 6 months</p>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="relative h-64">
                                <canvas id="monthlyTrendsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beer Popularity Chart -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full px-3">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Your Favorite Beers</h6>
                            <p class="text-sm text-slate-500 mt-1">Most ordered beers by you</p>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="relative h-64">
                                <canvas id="beerPopularityChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row 2 - Recent Orders and Recommendations -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <!-- Recent Orders -->
                <div class="w-full px-3 mb-6 lg:mb-0 lg:w-8/12 lg:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h6 class="text-lg font-semibold text-gray-800">Recent Order Groups</h6>
                                    <p class="text-sm text-slate-500 mt-1">
                                        <i class="fa fa-arrow-up text-lime-500"></i>
                                        <span class="font-semibold">{{ $recentOrders->count() }} recent order groups</span> from
                                        your shopping
                                        @if($recentOrders->count() > 0)
                                            <span class="text-xs text-gray-400 ml-2">(Last updated: {{ now()->format('M d, Y H:i') }})</span>
                                        @endif
                                    </p>
                                </div>
                                @if($recentOrders->count() > 0)
                                    <a href="{{ route('my-orders') }}" 
                                       class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                        <i class="fas fa-list mr-2"></i>View All
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="flex-auto p-6 px-0 pb-2">
                            <div class="overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                Order Group
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                Items
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                Total
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                Status
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                Date
                                            </th>
                                            <th
                                                class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">
                                                Actions
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
                                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-8 h-8 rounded-full bg-gradient-to-tl from-blue-500 to-cyan-400 flex items-center justify-center text-white text-sm font-bold mr-3">
                                                            <i class="fas fa-boxes"></i>
                                                        </div>
                                                        <span
                                                            class="text-sm font-semibold text-blue-600 truncate max-w-[150px]">{{ $groupCode }}</span>
                                                    </div>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <div class="text-center">
                                                        <span class="text-sm font-semibold">{{ $totalItems }}</span>
                                                        <p class="text-xs text-slate-400">{{ $groupOrders->count() }}
                                                            types</p>
                                                        <div class="mt-1">
                                                            @foreach($groupOrders->take(2) as $order)
                                                                @php
                                                                    $beerName = 'Unknown Beer';
                                                                    if (is_object($order) && isset($order->beer) && is_object($order->beer)) {
                                                                        $beerName = $order->beer->name ?? 'Unknown Beer';
                                                                    } elseif (is_array($order) && isset($order['beer']) && is_array($order['beer'])) {
                                                                        $beerName = $order['beer']['name'] ?? 'Unknown Beer';
                                                                    }
                                                                @endphp
                                                                <span class="inline-block bg-gray-100 text-xs text-gray-600 px-2 py-1 rounded mr-1 mb-1">
                                                                    {{ $beerName }}
                                                                </span>
                                                            @endforeach
                                                            @if($groupOrders->count() > 2)
                                                                <span class="inline-block bg-gray-100 text-xs text-gray-600 px-2 py-1 rounded">
                                                                    +{{ $groupOrders->count() - 2 }} more
                                                                </span>
                                                            @endif
                                                        </div>
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
                                                        class="bg-gradient-to-tl {{ $color }} px-3 py-1.5 text-xs rounded-lg font-bold uppercase text-white inline-block">
                                                        {{ $status }}
                                                    </span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <span
                                                        class="text-sm leading-normal">{{ $firstOrder->created_at->format('M d, Y') }}</span>
                                                </td>
                                                <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                    <div class="flex items-center justify-center gap-2">
                                                        <button onclick="reorderGroup('{{ $groupCode }}')"
                                                            class="text-orange-500 hover:text-orange-700 p-2 rounded-lg hover:bg-orange-50 transition"
                                                            title="Reorder this order">
                                                            <i class="fas fa-redo"></i>
                                                        </button>
                                                        <a href="{{ route('invoice.print', $groupCode) }}"
                                                            class="text-indigo-500 hover:text-indigo-700 p-2 rounded-lg hover:bg-indigo-50 transition"
                                                            title="Preview/Print Invoice">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                        <a href="{{ route('invoice.download', $groupCode) }}"
                                                            class="text-green-500 hover:text-green-700 p-2 rounded-lg hover:bg-green-50 transition"
                                                            title="Download Invoice">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="p-6 text-center text-slate-400">
                                                    <div class="flex flex-col items-center py-8">
                                                        <i class="fas fa-shopping-cart text-4xl text-gray-300 mb-4"></i>
                                                        <p class="text-lg font-medium text-gray-500 mb-2">No orders yet</p>
                                                        <p class="text-sm text-gray-400 mb-4">Start your beer shopping journey!</p>
                                                        <a href="{{ route('buybeer') }}"
                                                            class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-6 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                                            <i class="fas fa-beer mr-2"></i>Browse Beers
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


                <!-- Recommendations and Stats -->
                <div class="w-full px-3 lg:w-4/12 lg:flex-none">
                    <!-- Beer Recommendations -->
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Recommended for You</h6>
                            <p class="text-sm text-slate-500 mt-1">Beers you might like</p>
                        </div>
                        <div class="flex-auto p-6 px-0 pb-2">
                            @forelse($recommendations as $beer)
                                <div
                                    class="flex items-center mb-4 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors shadow-sm">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-gradient-to-tl from-amber-500 to-yellow-400 flex items-center justify-center text-white text-lg font-bold">
                                        <i class="fas fa-beer"></i>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h6 class="mb-1 text-sm leading-normal font-semibold text-gray-800">
                                            {{ $beer->name }}</h6>
                                        <p class="mb-0 text-xs text-slate-400">${{ number_format($beer->price, 2) }}</p>
                                    </div>
                                    <a href="{{ route('buybeer') }}"
                                        class="text-blue-500 hover:text-blue-700 text-lg ml-3">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </div>
                            @empty
                                <p class="text-center text-slate-400 text-sm mt-2">No recommendations available</p>
                            @endforelse
                        </div>
                    </div>


                    <!-- Orders by Status -->
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border mt-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6 class="text-lg font-semibold text-gray-800">Your Orders by Status</h6>
                        </div>
                        <div class="flex-auto p-6 px-0 pb-2">
                            @php
                                $allStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
                                $statusCounts = array_fill_keys($allStatuses, 0);
                                foreach ($ordersByStatus as $row) {
                                    $statusCounts[$row->status] = (int) ($row->count ?? 0);
                                }

                                $statusColors = [
                                    'Pending' => 'from-yellow-400 to-yellow-600',
                                    'Processing' => 'from-blue-400 to-blue-600',
                                    'Shipped' => 'from-purple-400 to-purple-600',
                                    'Delivered' => 'from-green-400 to-green-600',
                                    'Cancelled' => 'from-red-400 to-red-600',
                                ];
                            @endphp

                            @foreach ($statusCounts as $status => $count)
                                <div
                                    class="flex items-center justify-between mb-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-medium text-slate-700">{{ $status }}</span>
                                    <span
                                        class="bg-gradient-to-tl {{ $statusColors[$status] ?? 'from-gray-400 to-gray-600' }} px-3 py-1.5 rounded-lg text-xs font-bold text-white">
                                        {{ $count }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- Quick Actions -->
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-lg rounded-2xl bg-clip-border mt-6">
                        <div class="bg-gray-50 border-b border-gray-200 mb-0 rounded-t-2xl p-6 pb-0">
                            <h6>Quick Actions</h6>
                        </div>
                        <div class="flex-auto p-6 grid grid-cols-2 gap-3">
                            <a href="{{ route('buybeer') }}"
                                class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-4 py-3 rounded-lg text-white text-sm font-semibold text-center hover:shadow-lg transition-all">Buy
                                Beer</a>
                            <a href="{{ route('my-orders') }}"
                                class="bg-gradient-to-tl from-emerald-500 to-green-400 px-4 py-3 rounded-lg text-white text-sm font-semibold text-center hover:shadow-lg transition-all">My
                                Orders</a>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
        <!-- end cards -->
    </main>

    <script>
        // Initialize charts when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
        });

        // Chart initialization function
        function initializeCharts() {
            // Order Status Pie Chart
            fetch('/user/analytics/order-status')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('orderStatusChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                data: data.data,
                                backgroundColor: data.colors,
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
                })
                .catch(error => {
                    console.error('Error loading order status chart:', error);
                    // Show a message if no data
                    const chartContainer = document.getElementById('orderStatusChart').parentElement;
                    chartContainer.innerHTML = '<div class="flex items-center justify-center h-full text-gray-500">No order data available</div>';
                });

            // Monthly Trends Chart
            fetch('/user/analytics/monthly-trends')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('monthlyTrendsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.months,
                            datasets: [{
                                label: 'Orders',
                                data: data.orderCounts,
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            }, {
                                label: 'Amount ($)',
                                data: data.orderAmounts,
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
                })
                .catch(error => {
                    console.error('Error loading monthly trends chart:', error);
                    // Show a message if no data
                    const chartContainer = document.getElementById('monthlyTrendsChart').parentElement;
                    chartContainer.innerHTML = '<div class="flex items-center justify-center h-full text-gray-500">No trend data available</div>';
                });

            // Beer Popularity Chart
            fetch('/user/analytics/beer-popularity')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('beerPopularityChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Order Count',
                                data: data.data,
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
                })
                .catch(error => {
                    console.error('Error loading beer popularity chart:', error);
                    // Show a message if no data
                    const chartContainer = document.getElementById('beerPopularityChart').parentElement;
                    chartContainer.innerHTML = '<div class="flex items-center justify-center h-full text-gray-500">No beer data available</div>';
                });
        }

        // Reorder functionality
        function reorderGroup(groupCode) {
            Swal.fire({
                title: 'Reorder Order?',
                text: 'This will create a new order with the same items.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reorder!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    const button = event.target.closest('button');
                    const originalContent = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Order reordered successfully!',
                                confirmButtonColor: '#3085d6',
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message || 'Failed to reorder. Please try again.',
                                confirmButtonColor: '#3085d6',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred. Please try again.',
                            confirmButtonColor: '#3085d6',
                        });
                    })
                    .finally(() => {
                        // Restore button state
                        button.innerHTML = originalContent;
                        button.disabled = false;
                    });
                }
            });
        }


    </script>
@endsection
