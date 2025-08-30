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
                            <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                            aria-current="page">
                            Buy Beer
                        </li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">Craft Beer Shop</h6>
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
                        <!-- Cart Icon with Badge -->
                        <li class="flex items-center">
                            <a href="javascript:;"
                                class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500 relative"
                                id="cart-icon">
                                <i class="fa fa-shopping-cart sm:mr-1"></i>
                                <span class="hidden sm:inline">Cart</span>
                                <span
                                    class="absolute -top-1 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden"
                                    id="cart-count">0</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end Navbar -->

        <!-- Main Content -->
        <div class="w-full px-6 py-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <!-- Beer Products -->
                <div class="w-full px-3 mb-6 lg:mb-0 lg:w-8/12 lg:flex-none">
                    <div class="mb-4">
                        <h4 class="text-lg font-bold">Our Craft Beers</h4>
                        <p class="text-sm">Select from our premium collection of craft beers</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($beers as $beer)
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                                <div class="flex-auto p-4">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}"
                                            class="w-full h-48 object-cover rounded-xl mb-4">
                                        <span
                                            class="bg-gradient-to-tl from-blue-600 to-cyan-400 text-white text-xs font-bold px-3 py-1 rounded-full absolute top-2 right-2">${{ number_format($beer->price, 2) }}</span>
                                    </div>
                                    <h5 class="text-lg font-bold">{{ $beer->name }}</h5>
                                    <p class="text-sm text-slate-500 mb-3">{{ $beer->description }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-semibold">ABV: {{ $beer->alcohol_percentage }}%</span>
                                        <button
                                            class="bg-gradient-to-tl from-blue-600 to-cyan-400 text-white text-xs font-bold px-3 py-2 rounded-lg add-to-cart"
                                            data-id="{{ $beer->id }}" data-name="{{ $beer->name }}"
                                            data-price="{{ $beer->price }}"
                                            data-image="{{ asset('storage/' . $beer->image) }}">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shopping Cart & Checkout -->
                <div class="w-full max-w-full px-3 lg:w-4/12 lg:flex-none">
                    <div
                        class="border-black/12.5 shadow-soft-xl relative flex flex-col min-w-0 break-words rounded-2xl border-0 border-solid bg-white bg-clip-border sticky top-4">
                        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                            <h6>Your Order</h6>
                            <p class="text-sm leading-normal">
                                <i class="fa fa-shopping-cart text-blue-500"></i>
                                <span class="font-semibold" id="cart-items-count">0 items</span> in cart
                            </p>
                        </div>
                        <div class="flex-auto p-6">
                            <div class="" id="empty-cart-message">
                                <p class="text-center text-slate-500 py-4">Your cart is empty</p>
                            </div>

                            <div id="cart-items"></div>

                            <div class="mt-6 border-t border-slate-200 pt-4">
                                <div class="flex justify-between mb-2 text-sm">
                                    <span>Payment Method</span>
                                    <div class="text-right">
                                        <label class="mr-3 text-xs"><input type="radio" name="payment" value="cod"
                                                checked> Cash on Delivery</label>
                                        <label class="text-xs"><input type="radio" name="payment" value="card"> Card
                                            (dummy)</label>
                                    </div>
                                </div>
                                <div class="flex justify-between mb-4 text-lg font-bold">
                                    <span>Total</span>
                                    <span id="cart-total">$0.00</span>
                                </div>

                                <button
                                    class="bg-gradient-to-tl from-green-600 to-emerald-500 w-full py-3 rounded-lg text-white font-semibold mt-2 order-now-btn"
                                    disabled>
                                    Order Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="pt-4">
                <div class="w-full px-6 mx-auto">
                    <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                                ©
                                <script>
                                    document.write(new Date().getFullYear() + ",");
                                </script>
                                Beer Ordering System - Shop
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end cards -->
    </main>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let cart = [];

            const cartCount = document.getElementById('cart-count');
            const cartItemsCount = document.getElementById('cart-items-count');
            const cartItems = document.getElementById('cart-items');
            const emptyCartMsg = document.getElementById('empty-cart-message');
            const cartTotal = document.getElementById('cart-total');
            const orderNowBtn = document.querySelector('.order-now-btn');

            const currency = (n) => `$${Number(n).toFixed(2)}`;

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Toast helper
            const toast = (title, icon = 'success') => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1400,
                    icon,
                    title
                });
            };

            document.addEventListener('click', (e) => {
                // Add to cart
                const addBtn = e.target.closest('.add-to-cart');
                if (addBtn) {
                    const beer = {
                        id: Number(addBtn.dataset.id),
                        name: addBtn.dataset.name,
                        price: Number(addBtn.dataset.price),
                        image: addBtn.dataset.image,
                    };
                    addToCart(beer);
                    return;
                }

                // Increase quantity
                const incBtn = e.target.closest('[data-action="inc"]');
                if (incBtn) {
                    const id = Number(incBtn.dataset.id);
                    updateQty(id, 1);
                    return;
                }

                // Decrease quantity
                const decBtn = e.target.closest('[data-action="dec"]');
                if (decBtn) {
                    const id = Number(decBtn.dataset.id);
                    updateQty(id, -1);
                    return;
                }

                // Remove item
                const remBtn = e.target.closest('[data-action="remove"]');
                if (remBtn) {
                    const id = Number(remBtn.dataset.id);
                    Swal.fire({
                        title: 'Remove item?',
                        text: 'This will remove the beer from your cart.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it'
                    }).then((res) => {
                        if (res.isConfirmed) {
                            removeItem(id);
                            toast('Removed from cart', 'info');
                        }
                    });
                    return;
                }

                // Order Now
                const orderNow = e.target.closest('.order-now-btn');
                if (orderNow) {
                    if (cart.length === 0) return;
                    const payment = document.querySelector('input[name="payment"]:checked').value;
                    const payload = {
                        items: cart.map(i => ({
                            beer_id: i.id,
                            quantity: i.quantity
                        })),
                        payment_method: payment
                    };

                    fetch("{{ route('orders.bulk') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf
                            },
                            body: JSON.stringify(payload)
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data && data.success) {
                                toast('Order placed successfully!');
                                cart = [];
                                renderCart();
                            } else {
                                Swal.fire('Error', 'Failed to place order', 'error');
                            }
                        })
                        .catch(() => Swal.fire('Error', 'Failed to place order', 'error'));
                }
            });

            function addToCart(beer) {
                // merge by unique beer id only; distinct beers will be separate entries
                const existing = cart.find(i => i.id === beer.id);
                if (existing) {
                    existing.quantity += 1;
                } else {
                    cart.push({
                        ...beer,
                        quantity: 1
                    });
                }
                renderCart();
                toast(`${beer.name} added to cart`);
            }

            function updateQty(id, delta) {
                const item = cart.find(i => i.id === id);
                if (!item) return;
                item.quantity += delta;
                if (item.quantity <= 0) {
                    cart = cart.filter(i => i.id !== id);
                }
                renderCart();
            }

            function removeItem(id) {
                cart = cart.filter(i => i.id !== id);
                renderCart();
            }

            function renderCart() {
                const totalItems = cart.reduce((s, i) => s + i.quantity, 0);
                cartCount.textContent = totalItems;
                cartCount.classList.toggle('hidden', totalItems === 0);
                cartItemsCount.textContent = `${totalItems} ${totalItems === 1 ? 'item' : 'items'}`;

                const total = cart.reduce((s, i) => s + i.price * i.quantity, 0);
                cartTotal.textContent = currency(total);

                // enable/disable order now
                orderNowBtn.disabled = totalItems === 0;

                if (cart.length === 0) {
                    emptyCartMsg.classList.remove('hidden');
                    cartItems.innerHTML = '';
                    return;
                }
                emptyCartMsg.classList.add('hidden');

                cartItems.innerHTML = cart.map(item => `
                    <div class="flex items-center justify-between mb-4 p-3 bg-slate-50 rounded-lg">
                        <div class="flex items-center">
                            <img src="${item.image}" alt="${item.name}" class="w-12 h-12 rounded-lg object-cover">
                            <div class="ml-3">
                                <h6 class="text-sm font-semibold">${item.name}</h6>
                                <p class="text-xs text-slate-500">${currency(item.price)} each</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <button class="w-6 h-6 rounded-full bg-slate-200 text-xs font-bold" data-action="dec" data-id="${item.id}">-</button>
                            <span class="mx-2 text-sm font-semibold">${item.quantity}</span>
                            <button class="w-6 h-6 rounded-full bg-slate-200 text-xs font-bold" data-action="inc" data-id="${item.id}">+</button>
                            <button class="ml-3 text-red-500 text-sm" data-action="remove" data-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `).join('');
            }

            renderCart();
        });
    </script>
@endsection
