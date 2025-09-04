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
                    <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                        aria-current="page">
                        Beer Menu Management
                    </li>
                </ol>
                <h6 class="mb-0 font-bold capitalize">Beer Menu Management</h6>
            </nav>

            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                <div class="flex items-center md:ml-auto md:pr-4">
                    <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                        <span
                            class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="search-beers"
                            class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Search beers..." />
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

    <div class="w-full px-6 py-6 mx-auto">
        <!-- Add New Beer Section -->
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mx-auto mt-0 lg:w-12/12 lg:flex-none">
                <div class="flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0 font-bold text-slate-700">Add New Beer</h6>
                                <p class="mb-0 text-sm leading-normal">
                                    <a class="text-slate-500" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    <span class="text-slate-500"> / </span>
                                    <span class="text-slate-700">Beer Menu Management</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        <form id="beerForm" action="{{ route('admin.beer.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                                <!-- Left Column -->
                                <div class="space-y-5">

                                    <!-- Beer Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Beer Name <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
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
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Beer Image <span
                                                class="text-red-500">*</span></label>
                                        <div class="mt-1">
                                            <label for="image-upload" class="cursor-pointer">
                                                <div
                                                    class="flex flex-col items-center justify-center px-4 py-6 bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-400 transition duration-300">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
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
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Stock Quantity
                                            <span class="text-red-500">*</span></label>
                                        <input type="number" name="stock" value="{{ old('stock') }}" min="0"
                                            placeholder="e.g. 100"
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            required>
                                    </div>

                                    <!-- Price -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Price <span
                                                class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                                            <input type="number" name="price" value="{{ old('price') }}" min="0"
                                                step="0.01" placeholder="0.00"
                                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding pl-8 pr-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Alcohol Percentage -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-2">Alcohol % <span
                                                class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input type="number" name="alcohol_percentage" value="{{ old('alcohol_percentage') }}"
                                                min="0" max="100" step="0.1" placeholder="e.g. 5.5"
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
                                                    {{ old('origin') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Description <span
                                        class="text-red-500">*</span></label>
                                <textarea name="description" rows="4" placeholder="Describe the beer..."
                                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    required>{{ old('description') }}</textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-3">
                                <button type="submit"
                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-cyan-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 hover:shadow-soft-xs active:opacity-85 hover:-translate-y-px">
                                    Save Beer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Beers List Section -->
        <div class="flex flex-wrap -mx-3 mt-6">
            <div class="w-full max-w-full px-3 mx-auto mt-0 lg:w-12/12 lg:flex-none">
                <div class="flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0 font-bold text-slate-700">Beers List</h6>
                                <p class="mb-0 text-sm leading-normal">Manage your beer catalog and inventory.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        <div class="overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            S.N
                                        </th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Image
                                        </th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Name
                                        </th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Category
                                        </th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Stock
                                        </th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Price
                                        </th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Alcohol %
                                        </th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Origin
                                        </th>
                                        <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beers as $index => $beer)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <div class="flex px-2 py-1">
                                                    <div>
                                                        <p class="mb-0 text-xs font-semibold leading-tight text-slate-700">
                                                            {{ $index + 1 }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                @if ($beer->image)
                                                    <img src="{{ asset('storage/' . $beer->image) }}"
                                                        class="w-12 h-12 rounded-lg object-cover shadow-soft-2xl">
                                                @else
                                                    <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-slate-700">
                                                    {{ $beer->name }}
                                                </p>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <span class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                    {{ $beer->category }}
                                                </span>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-slate-700">
                                                    {{ $beer->stock }}
                                                </p>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-slate-700">
                                                    ${{ number_format($beer->price, 2) }}
                                                </p>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-slate-700">
                                                    {{ $beer->alcohol_percentage }}%
                                                </p>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <p class="mb-0 text-xs font-semibold leading-tight text-slate-700">
                                                    {{ $beer->origin }}
                                                </p>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.menu.edit', $beer->id) }}"
                                                        class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 px-3 py-1.5 rounded-lg hover:bg-blue-50 border border-blue-100"
                                                        title="Edit Beer">
                                                        <i class="fas fa-edit"></i>
                                                        <span class="text-xs">Edit</span>
                                                    </a>
                                                    <button onclick="deleteBeer({{ $beer->id }}, '{{ $beer->name }}')"
                                                        class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 px-3 py-1.5 rounded-lg hover:bg-red-50 border border-red-100"
                                                        title="Delete Beer">
                                                        <i class="fas fa-trash"></i>
                                                        <span class="text-xs">Delete</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($beers) === 0)
                                        <tr>
                                            <td colspan="9" class="p-8 text-center text-slate-400">
                                                <div class="flex flex-col items-center">
                                                    <i class="fas fa-beer text-4xl mb-4 text-slate-300"></i>
                                                    <p class="text-lg font-semibold mb-2">No beers added yet</p>
                                                    <p class="text-sm">Add your first beer to start building your catalog.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
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
            text: "Do you want to save this beer?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save it!'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        })
    });

    // Delete beer function
    function deleteBeer(beerId, beerName) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete "${beerName}". This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/beer-delete') }}/${beerId}`;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Search functionality
    document.getElementById('search-beers').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
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
