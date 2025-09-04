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
                        <a class="opacity-50 text-slate-700" href="{{ route('admin.dashboard') }}">Admin</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">
                        <a class="opacity-50 text-slate-700" href="{{ route('admin.menu') }}">Beer Menu</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                        aria-current="page">
                        Edit Beer
                    </li>
                </ol>
                <h6 class="mb-0 font-bold capitalize">Edit Beer - {{ $beer->name }}</h6>
            </nav>

            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
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

    <div class="w-full px-6 py-6 mx-auto">
        <!-- Edit Beer Section -->
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mx-auto mt-0 lg:w-12/12 lg:flex-none">
                <div class="flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0 font-bold text-slate-700">Edit Beer</h6>
                                <p class="mb-0 text-sm leading-normal">
                                    <a class="text-slate-500" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    <span class="text-slate-500"> / </span>
                                    <a class="text-slate-500" href="{{ route('admin.menu') }}">Beer Menu</a>
                                    <span class="text-slate-500"> / </span>
                                    <span class="text-slate-700">Edit Beer</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        <form id="beerForm" action="{{ route('admin.beer.update', $beer) }}" method="POST"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                                <!-- Left Column -->
                                <div class="space-y-5">

                                    <!-- Beer Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Beer Name <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $beer->name) }}"
                                            placeholder="e.g. Pale Ale Supreme"
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            required>
                                        @error('name')
                                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Category -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Category <span
                                                class="text-red-500">*</span></label>
                                        <select name="category" required
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
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
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Beer Image</label>
                                        <div class="mt-1">
                                            @if ($beer->image)
                                                <div class="mb-3">
                                                    <p class="text-xs text-slate-500 mb-2">Current Image:</p>
                                                    <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}"
                                                        class="w-24 h-24 rounded-lg object-cover shadow-soft-2xl">
                                                </div>
                                            @endif
                                            <label for="image-upload" class="cursor-pointer">
                                                <div
                                                    class="flex flex-col items-center justify-center px-4 py-6 bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-400 transition duration-300">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                                    <span class="text-gray-600 font-medium">
                                                        {{ $beer->image ? 'Click to replace image' : 'Click to upload image' }}
                                                    </span>
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
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Stock Quantity
                                            <span class="text-red-500">*</span></label>
                                        <input type="number" name="stock" value="{{ old('stock', $beer->stock) }}"
                                            min="0"
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            required>
                                    </div>

                                    <!-- Price -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Price <span
                                                class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                                            <input type="number" name="price" value="{{ old('price', $beer->price) }}"
                                                min="0" step="0.01"
                                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding pl-8 pr-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Alcohol Percentage -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Alcohol % <span
                                                class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input type="number" name="alcohol_percentage"
                                                value="{{ old('alcohol_percentage', $beer->alcohol_percentage) }}" min="0"
                                                max="100" step="0.1"
                                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                required>
                                            <span class="absolute right-3 top-2 text-gray-500">%</span>
                                        </div>
                                    </div>

                                    <!-- Origin -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Country of Origin
                                            <span class="text-red-500">*</span></label>
                                        <select name="origin" required
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
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
                                <label class="block text-sm font-medium text-slate-700 mb-2">Description <span
                                        class="text-red-500">*</span></label>
                                <textarea name="description" rows="4"
                                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    required>{{ old('description', $beer->description) }}</textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('admin.menu') }}"
                                    class="inline-block px-6 py-3 font-bold text-center text-slate-700 uppercase align-middle transition-all rounded-lg cursor-pointer bg-gray-100 border border-gray-300 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 hover:shadow-soft-xs active:opacity-85 hover:-translate-y-px">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-cyan-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 hover:shadow-soft-xs active:opacity-85 hover:-translate-y-px">
                                    Update Beer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Confirmation before submitting form
    document.getElementById('beerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update this beer?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        })
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
        })
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            confirmButtonColor: '#3085d6',
        })
    @endif
</script>
@endsection
