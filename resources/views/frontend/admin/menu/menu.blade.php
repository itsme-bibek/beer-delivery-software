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
                <li class="text-gray-800 font-semibold">Add New Beer</li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div
            class="bg-white rounded-3xl shadow-xl overflow-hidden transform transition-transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-orange-400/30 duration-500">

            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-500 to-yellow-400 px-6 py-6 md:px-8 md:py-8 animate-gradient">
                <h2 class="text-2xl md:text-3xl font-bold text-white">Add New Beer</h2>
                <p class="text-orange-100 mt-1 md:mt-2 md:text-lg">Fill in the details to add a new beer to your catalog.
                </p>
            </div>

            <!-- Body -->
            <div class="p-6 md:p-8">

                <form id="beerForm" action="{{ route('admin.beer.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Left Column -->
                        <div class="space-y-5">

                            <!-- Beer Name -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Beer Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
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
                                            {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Beer Image <span
                                        class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <label for="image-upload" class="cursor-pointer">
                                        <div
                                            class="flex flex-col items-center justify-center px-4 py-6 bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl hover:bg-orange-50 hover:border-orange-400 transition duration-300">
                                            <svg class="w-14 h-14 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="text-gray-600 font-medium">Click to upload image</span>
                                            <span class="text-xs text-gray-500">PNG, JPG, JPEG (Max 2MB)</span>
                                        </div>
                                        <input id="image-upload" type="file" name="image" accept="image/*"
                                            class="hidden" required>
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
                                <input type="number" name="stock" value="{{ old('stock') }}" min="0"
                                    placeholder="e.g. 100"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 shadow-sm"
                                    required>
                            </div>

                            <!-- Price -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Price <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                                    <input type="number" name="price" value="{{ old('price') }}" min="0"
                                        step="0.01" placeholder="0.00"
                                        class="w-full pl-8 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 shadow-sm"
                                        required>
                                </div>
                            </div>

                            <!-- Alcohol Percentage -->
                            <div>
                                <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Alcohol % <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="number" name="alcohol_percentage" value="{{ old('alcohol_percentage') }}"
                                        min="0" max="100" step="0.1" placeholder="e.g. 5.5"
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
                                            {{ old('origin') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm md:text-base font-medium text-gray-700 mb-1">Description <span
                                class="text-red-500">*</span></label>
                        <textarea name="description" rows="4" placeholder="Describe the beer..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition duration-300 shadow-sm"
                            required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex flex-col sm:flex-row sm:justify-end gap-3">
                        <a href="{{ route('admin.menu') }}"
                            class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-orange-50 transition duration-300 text-center">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-yellow-400 hover:from-orange-600 hover:to-yellow-500 transition duration-500 shadow-lg text-white text-center animate-pulse-on-hover">
                            Save Beer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Beers Table -->
        <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8">
            <h3 class="text-xl font-bold mb-4">Beers List</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-orange-500 to-yellow-400 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">S.N</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Image</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Category</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Stock</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Price</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Alcohol %</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Origin</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($beers as $index => $beer)
                            <tr class="hover:bg-orange-50 transition">
                                <td class="px-4 py-3 text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    @if ($beer->image)
                                        <img src="{{ asset('storage/' . $beer->image) }}"
                                            class="w-16 h-16 object-cover rounded-xl shadow-sm">
                                    @else
                                        <span class="text-gray-400">No Image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-800 font-medium">{{ $beer->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $beer->category }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $beer->stock }}</td>
                                <td class="px-4 py-3 text-gray-600">${{ number_format($beer->price, 2) }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $beer->alcohol_percentage }}%</td>
                                <td class="px-4 py-3 text-gray-600">{{ $beer->origin }}</td>
                                <td class="px-4 py-3 space-x-2">
                                    <a href="{{ route('admin.menu.edit', $beer->id) }}"
                                        class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Edit</a>
                                    <form action="{{ route('admin.beer.destroy', $beer->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirmDelete(this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($beers) === 0)
                            <tr>
                                <td colspan="9" class="px-4 py-4 text-center text-gray-500">No beers added yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Confirmation before submitting form
        document.getElementById('beerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save this beer?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f97316',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Save it!'
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

    <!-- Extra Tailwind Animations -->
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
