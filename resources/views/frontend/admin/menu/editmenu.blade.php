@extends('layout.app')

@section('main')
    <main class="xl:ml-68.5 relative h-full max-h-screen overflow-auto p-6 bg-gray-50">

        <!-- Breadcrumbs -->
        <nav class="mb-6 text-sm md:text-base">
            <ol class="flex items-center space-x-2 text-gray-600">
                <li><a href="{{ route('admin.dashboard') }}" class="text-orange-600 hover:underline">Dashboard</a></li>
                <li>/</li>
                <li><a href="{{ route('admin.menu') }}" class="text-orange-600 hover:underline">Beers</a></li>
                <li>/</li>
                <li class="text-gray-800 font-semibold">Edit Beer</li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div
            class="bg-white rounded-3xl shadow-xl overflow-hidden transform transition-transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-400/30 duration-500">

            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-500 to-yellow-400 px-6 py-6 md:px-8 md:py-8 animate-gradient">
                <h2 class="text-2xl md:text-3xl font-bold text-white">Edit Beer</h2>
                <p class="text-orange-100 mt-1 md:mt-2 md:text-lg">Update the details of your beer.</p>
            </div>

            <!-- Body -->
            <div class="p-6 md:p-8">

                <form id="beerForm" action="{{ route('admin.beer.update', $beer) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Left Column -->
                        <div class="space-y-5">

                            <!-- Beer Name -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Beer Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $beer->name) }}"
                                    placeholder="e.g. Pale Ale Supreme"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 shadow-sm"
                                    required>
                                @error('name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Category <span
                                        class="text-red-500">*</span></label>
                                <select name="category" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 appearance-none shadow-sm">
                                    <option value="">Select a category</option>
                                    @foreach (['IPA', 'Lager', 'Stout', 'Porter', 'Pale Ale', 'Wheat Beer', 'Pilsner', 'Sour', 'Other'] as $category)
                                        <option value="{{ $category }}"
                                            {{ old('category', $beer->category) == $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Beer Image</label>
                                <div class="mt-1">
                                    @if ($beer->image)
                                        <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}"
                                            class="w-32 h-32 rounded-lg object-cover mb-2">
                                    @endif
                                    <label for="image-upload" class="cursor-pointer">
                                        <div
                                            class="flex flex-col items-center justify-center px-4 py-6 bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl hover:bg-orange-50 hover:border-orange-400 transition duration-300">
                                            <svg class="w-14 h-14 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="text-gray-600 font-medium">Click to replace image</span>
                                            <span class="text-xs text-gray-500">PNG, JPG, JPEG (Max 2MB)</span>
                                        </div>
                                        <input id="image-upload" type="file" name="image" accept="image/*"
                                            class="hidden">
                                    </label>
                                    @error('image')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-5">
                            <!-- Stock -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Stock Quantity
                                    <span class="text-red-500">*</span></label>
                                <input type="number" name="stock" value="{{ old('stock', $beer->stock) }}"
                                    min="0"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 shadow-sm"
                                    required>
                            </div>

                            <!-- Price -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Price <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                                    <input type="number" name="price" value="{{ old('price', $beer->price) }}"
                                        min="0" step="0.01"
                                        class="w-full pl-8 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 shadow-sm"
                                        required>
                                </div>
                            </div>

                            <!-- Alcohol Percentage -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Alcohol % <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="number" name="alcohol_percentage"
                                        value="{{ old('alcohol_percentage', $beer->alcohol_percentage) }}" min="0"
                                        max="100" step="0.1"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 shadow-sm"
                                        required>
                                    <span class="absolute right-3 top-3 text-gray-500">%</span>
                                </div>
                            </div>

                            <!-- Origin -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Country of Origin
                                    <span class="text-red-500">*</span></label>
                                <select name="origin" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 appearance-none shadow-sm">
                                    <option value="">Select country</option>
                                    @foreach (['United States', 'Germany', 'Belgium', 'United Kingdom', 'Netherlands', 'Ireland', 'Czech Republic', 'Mexico', 'Canada', 'Australia', 'Japan', 'Other'] as $country)
                                        <option value="{{ $country }}"
                                            {{ old('origin', $beer->origin) == $country ? 'selected' : '' }}>
                                            {{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Description <span
                                class="text-red-500">*</span></label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 shadow-sm"
                            required>{{ old('description', $beer->description) }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex flex-col sm:flex-row sm:justify-end gap-3">
                        <a href="{{ route('admin.menu') }}"
                            class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-orange-50 transition duration-300 text-center">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-yellow-400 hover:from-orange-600 hover:to-yellow-500 transition duration-500 shadow-lg text-white text-center animate-pulse-on-hover">
                            Update Beer
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('beerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to update this beer?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f97316',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            })
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#f97316',
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#f97316',
            })
        </script>
    @endif

    <style>
        /* Gradient animation for header */
        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradientBG 6s ease infinite;
        }

        /* Button pulse on hover */
        .animate-pulse-on-hover:hover {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 0 10px rgba(255, 165, 0, 0.5);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 0 20px rgba(255, 165, 0, 0.8);
            }
        }
    </style>
@endsection
