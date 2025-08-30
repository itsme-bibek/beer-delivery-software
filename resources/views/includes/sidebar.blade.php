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
                             <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <title>office</title>
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                         fill-rule="nonzero">
                                         <g transform="translate(1716.000000, 291.000000)">
                                             <g transform="translate(153.000000, 2.000000)">
                                                 <path class="fill-slate-800 opacity-60"
                                                     d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                 </path>
                                                 <path class="fill-slate-800"
                                                     d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,36.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                 </path>
                                             </g>
                                         </g>
                                     </g>
                                 </g>
                             </svg>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Admin Dashboard</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.menu*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.menu') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.menu*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <title>office</title>
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                         fill-rule="nonzero">
                                         <g transform="translate(1716.000000, 291.000000)">
                                             <g transform="translate(153.000000, 2.000000)">
                                                 <path class="fill-slate-800 opacity-60"
                                                     d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                 </path>
                                                 <path class="fill-slate-800"
                                                     d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,36.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                 </path>
                                             </g>
                                         </g>
                                     </g>
                                 </g>
                             </svg>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Beer Menu Management</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('admin.orders*') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('admin.orders.index') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.orders*') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <title>office</title>
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                         fill-rule="nonzero">
                                         <g transform="translate(1716.000000, 291.000000)">
                                             <g transform="translate(153.000000, 2.000000)">
                                                 <path class="fill-slate-800 opacity-60"
                                                     d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                 </path>
                                                 <path class="fill-slate-800"
                                                     d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,36.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                 </path>
                                             </g>
                                         </g>
                                     </g>
                                 </g>
                             </svg>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">All Orders</span>
                     </a>
                 </li>
             @elseif (auth()->user() && auth()->user()->isUser())
                 <!-- User Navigation -->
                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('user-home') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('user-home') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('user-home') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <title>office</title>
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                         fill-rule="nonzero">
                                         <g transform="translate(1716.000000, 291.000000)">
                                             <g transform="translate(153.000000, 2.000000)">
                                                 <path class="fill-slate-800 opacity-60"
                                                     d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                 </path>
                                                 <path class="fill-slate-800"
                                                     d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,36.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                 </path>
                                             </g>
                                         </g>
                                     </g>
                                 </g>
                             </svg>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('my-orders') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('my-orders') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('my-orders') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <title>office</title>
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                         fill-rule="nonzero">
                                         <g transform="translate(1716.000000, 291.000000)">
                                             <g transform="translate(153.000000, 2.000000)">
                                                 <path class="fill-slate-800 opacity-60"
                                                     d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                 </path>
                                                 <path class="fill-slate-800"
                                                     d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,36.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                 </path>
                                             </g>
                                         </g>
                                     </g>
                                 </g>
                             </svg>
                         </div>
                         <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">My Orders</span>
                     </a>
                 </li>

                 <li class="mt-0.5 w-full">
                     <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ request()->routeIs('buybeer') ? 'bg-gradient-to-tl from-blue-500 to-cyan-400 text-white shadow-soft-2xl' : 'text-slate-700' }} rounded-lg"
                         href="{{ route('buybeer') }}">
                         <div
                             class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('buybeer') ? 'bg-white' : 'bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                             <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <title>office</title>
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                         fill-rule="nonzero">
                                         <g transform="translate(1716.000000, 291.000000)">
                                             <g transform="translate(153.000000, 2.000000)">
                                                 <path class="fill-slate-800 opacity-60"
                                                     d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                 </path>
                                                 <path class="fill-slate-800"
                                                     d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,36.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                 </path>
                                             </g>
                                         </g>
                                     </g>
                                 </g>
                             </svg>
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
                 <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors text-slate-700 rounded-lg"
                     href="#">
                     <div
                         class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                         <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                             <title>customer-support</title>
                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                     fill-rule="nonzero">
                                     <g transform="translate(1716.000000, 291.000000)">
                                         <g transform="translate(1.000000, 0.000000)">
                                             <path class="fill-slate-800 opacity-60"
                                                 d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                             </path>
                                             <path class="fill-slate-800"
                                                 d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                             </path>
                                             <path class="fill-slate-800"
                                                 d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                             </path>
                                         </g>
                                     </g>
                                 </g>
                             </g>
                         </svg>
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
                             <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                 <title>logout</title>
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                         fill-rule="nonzero">
                                         <g transform="translate(1716.000000, 291.000000)">
                                             <g transform="translate(1.000000, 0.000000)">
                                                 <path class="fill-slate-800 opacity-60"
                                                     d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z">
                                                 </path>
                                             </g>
                                         </g>
                                     </g>
                                 </g>
                             </svg>
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
