 <aside
     class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
     <div class="h-19.5">
         <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
             sidenav-close></i>
         <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="javascript:;" target="_blank">
             <img src="{{ asset('./assets/img/logo-ct.png') }}"
                 class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
             <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">peaksip</span>
         </a>
     </div>

     <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

     <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
         <ul class="flex flex-col pl-0 mb-0">

             @if (auth()->user() && auth()->user()->isAdmin())
                 <!-- Admin Navigation -->
                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.dashboard') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-tachometer-alt sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Admin Dashboard</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.menu*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.menu') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.menu*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-beer sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Beer Menu Management</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.orders*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.orders.index') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.orders*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-shopping-cart sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">All Orders</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.messages*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.messages.index') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.messages*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-headset sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Customer Messages</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.users*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.users.index') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.users*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-users sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Users Management</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.llbo-verifications*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.llbo-verifications.index') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.llbo-verifications*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-id-card sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">LLBO Verifications</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.marketing-banners*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.marketing-banners.index') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.marketing-banners*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-bullhorn sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Marketing Banners</span>
                     </a>
                 </li>
             @elseif (auth()->user() && auth()->user()->isUser())
                 <!-- User Navigation -->
                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('user-home') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('user-home') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('user-home') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-home sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('my-orders') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('my-orders') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('my-orders') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-clipboard-list sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">My Orders</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('user.messages.*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('user.messages.index') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('user.messages.*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-envelope sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">My Messages</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('user.llbo-verification.*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('user.llbo-verification.index') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('user.llbo-verification.*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-id-card sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">LLBO License</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('buybeer') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('buybeer') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('buybeer') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <i class="fas fa-shopping-bag sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Buy Beer</span>
                     </a>
                 </li>
             @endif

             <!-- Common Navigation for all authenticated users -->
             @auth
             <li class="w-full mt-4">
                 <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">
                     Account
                 </h6>
             </li>

             <li class="mt-0.5 w-full">
                 <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('user.profile*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                     href="{{ route('user.profile') }}">
                     <div
                         class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('user.profile*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                         <i class="fas fa-user-circle sidebar-icon"></i>
                     </div>
                     <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Profile</span>
                 </a>
             </li>

             <li class="mt-0.5 w-full">
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf
                     <button type="submit"
                         class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors w-full text-left text-slate-700 rounded-lg hover:bg-gray-50">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white">
                             <i class="fas fa-sign-out-alt sidebar-icon"></i>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Logout</span>
                     </button>
                 </form>
             </li>
             @endauth

         </ul>
     </div>

     <div class="mx-4">
         <!-- load phantom colors for card after: -->
         <p
             class="invisible hidden text-gray-800 text-red-500 text-red-600 after:bg-gradient-to-tl after:from-gray-900 after:to-slate-800 after:from-blue-600 after:to-cyan-400 after:from-red-500 after:to-yellow-400 after:from-green-600 after:to-lime-400 after:from-red-600 after:to-rose-400 after:from-slate-600 after:to-slate-300 text-lime-500 text-cyan-500 text-slate-400 text-fuchsia-500">
         </p>
         <div class="after:opacity-65 after:bg-gradient-to-tl after:from-slate-600 after:to-slate-300 relative flex min-w-0 flex-col items-center break-words rounded-2xl border-0 border-solid border-blue-900 bg-white bg-clip-border shadow-none after:absolute after:top-0 after:bottom-0 after:left-0 after:z-10 after:block after:h-full after:w-full after:rounded-2xl after:content-['']"
             sidenav-card>
             <div class="mb-7.5 absolute h-full w-full rounded-2xl bg-cover bg-center"
                 style="
              background-image: url('./assets/img/curved-images/white-curved.jpeg');
            ">
             </div>
             <div class="relative z-20 flex-auto w-full p-4 text-left text-white">
                 <div
                     class="flex items-center justify-center w-8 h-8 mb-4 text-center bg-white bg-center rounded-lg icon shadow-soft-2xl">
                     <i class="top-0 z-10 text-lg leading-none text-transparent ni ni-diamond bg-gradient-to-tl from-slate-600 to-slate-300 bg-clip-text opacity-80"
                         sidenav-card-icon></i>
                 </div>
                 <div class="transition-all duration-200 ease-nav-brand">
                     <h6 class="mb-0 text-white">Need help?</h6>
                     <p class="mt-0 mb-4 text-xs font-semibold leading-tight">
                         Please check our docs
                     </p>
                     <a href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/soft-ui-dashboard/"
                         target="_blank"
                         class="inline-block w-full px-8 py-2 mb-0 text-xs font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro hover:shadow-soft-2xl hover:scale-102">Documentation</a>
                 </div>
             </div>
         </div>
     </div>
 </aside>
