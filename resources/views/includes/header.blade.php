<!-- Responsive Header -->
<header class="xl:hidden fixed top-0 left-0 right-0 z-50 bg-white shadow-soft-xl border-b border-gray-200">
    <div class="flex items-center justify-between px-4 py-3">
        <!-- Logo and Brand -->
        <div class="flex items-center">
            <a href="{{ auth()->user() && auth()->user()->isAdmin() ? route('admin.dashboard') : route('user-home') }}" 
               class="flex items-center text-slate-700">
                <img src="{{ asset('./assets/img/logo-ct.png') }}" 
                     class="h-8 w-auto" alt="peaksip" />
                <span class="ml-2 font-semibold text-lg">peaksip</span>
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" 
                class="p-2 rounded-lg text-slate-700 hover:bg-gray-100 transition-colors duration-200"
                onclick="toggleSidebar()">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div id="mobile-nav" class="hidden bg-white border-t border-gray-200 shadow-lg">
        <div class="px-4 py-2">
            <ul class="space-y-1">
                @if (auth()->user() && auth()->user()->isAdmin())
                    <!-- Admin Mobile Navigation -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.menu') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('admin.menu*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-beer w-5 h-5 mr-3"></i>
                            Beer Menu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('admin.orders*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                            All Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.messages.index') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('admin.messages*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-headset w-5 h-5 mr-3"></i>
                            Messages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('admin.users*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-users w-5 h-5 mr-3"></i>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.llbo-verifications.index') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('admin.llbo-verifications*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-id-card w-5 h-5 mr-3"></i>
                            LLBO Verifications
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.marketing-banners.index') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('admin.marketing-banners*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-bullhorn w-5 h-5 mr-3"></i>
                            Marketing Banners
                        </a>
                    </li>
                @elseif (auth()->user() && auth()->user()->isUser())
                    <!-- User Mobile Navigation -->
                    <li>
                        <a href="{{ route('user-home') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('user-home') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-home w-5 h-5 mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('my-orders') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('my-orders') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-clipboard-list w-5 h-5 mr-3"></i>
                            My Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.messages.index') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('user.messages.*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-envelope w-5 h-5 mr-3"></i>
                            Messages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.llbo-verification.index') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('user.llbo-verification.*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-id-card w-5 h-5 mr-3"></i>
                            LLBO License
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('buybeer') }}" 
                           class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('buybeer') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                            <i class="fas fa-shopping-bag w-5 h-5 mr-3"></i>
                            Buy Beer
                        </a>
                    </li>
                @endif

                <!-- Common Mobile Navigation for all authenticated users -->
                @auth
                <hr class="my-2 border-gray-200">
                <li>
                    <a href="{{ route('user.profile') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors {{ request()->routeIs('user.profile*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white' : '' }}">
                        <i class="fas fa-user-circle w-5 h-5 mr-3"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" 
                                class="flex items-center w-full px-3 py-2 text-sm font-medium text-slate-700 rounded-lg hover:bg-gray-100 transition-colors">
                            <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                            Logout
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden xl:hidden" onclick="closeSidebar()"></div>

<script>
    function toggleSidebar() {
        const mobileNav = document.getElementById('mobile-nav');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        
        if (mobileNav.classList.contains('hidden')) {
            mobileNav.classList.remove('hidden');
            mobileOverlay.classList.remove('hidden');
            mobileMenuBtn.innerHTML = '<i class="fas fa-times text-xl"></i>';
        } else {
            mobileNav.classList.add('hidden');
            mobileOverlay.classList.add('hidden');
            mobileMenuBtn.innerHTML = '<i class="fas fa-bars text-xl"></i>';
        }
    }

    function closeSidebar() {
        const mobileNav = document.getElementById('mobile-nav');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        
        mobileNav.classList.add('hidden');
        mobileOverlay.classList.add('hidden');
        mobileMenuBtn.innerHTML = '<i class="fas fa-bars text-xl"></i>';
    }

    // Close mobile menu when clicking on a link
    document.addEventListener('DOMContentLoaded', function() {
        const mobileNavLinks = document.querySelectorAll('#mobile-nav a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeSidebar();
            });
        });
    });
</script>


