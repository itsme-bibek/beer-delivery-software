@extends('layout.app')

@section('main')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex items-center justify-between">
                            <div>
                                <h6 class="text-lg font-semibold text-gray-800">Create Marketing Banner</h6>
                                <p class="text-sm text-slate-500 mt-1">Add a new banner for users</p>
                            </div>
                            <a href="{{ route('admin.marketing-banners.index') }}" class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                        </div>
                    </div>
                    <div class="flex-auto p-6">
                        @if ($errors->any())
                            <div class="mb-4 p-4 rounded-lg border border-red-200 bg-red-50 text-red-700 text-sm">
                                <div class="font-semibold mb-1"><i class="fas fa-exclamation-triangle mr-1"></i>There were some problems with your input:</div>
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="mb-4 p-3 rounded-lg border border-green-200 bg-green-50 text-green-700 text-sm">
                                <i class="fas fa-check-circle mr-1"></i>{{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.marketing-banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="w-full px-3 py-2 border {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                        <textarea name="description" rows="3" class="w-full px-3 py-2 border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description') }}</textarea>
                                        @error('description')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Welcome Message</label>
                                        <input type="text" name="welcome_message" value="{{ old('welcome_message') }}" class="w-full px-3 py-2 border {{ $errors->has('welcome_message') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        @error('welcome_message')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                                            <input type="text" name="button_text" value="{{ old('button_text') }}" class="w-full px-3 py-2 border {{ $errors->has('button_text') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('button_text')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Button URL</label>
                                            <input type="url" name="button_url" value="{{ old('button_url') }}" class="w-full px-3 py-2 border {{ $errors->has('button_url') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('button_url')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Image *</label>
                                        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border {{ $errors->has('image') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                        @error('image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                            <input type="datetime-local" name="start_date" value="{{ old('start_date') }}" class="w-full px-3 py-2 border {{ $errors->has('start_date') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('start_date')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                            <input type="datetime-local" name="end_date" value="{{ old('end_date') }}" class="w-full px-3 py-2 border {{ $errors->has('end_date') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('end_date')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                                            <input type="number" min="0" name="display_order" value="{{ old('display_order', 0) }}" class="w-full px-3 py-2 border {{ $errors->has('display_order') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('display_order')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                        </div>
                                        <div class="flex items-center mt-6">
                                            <input id="is_active" type="checkbox" name="is_active" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Target Audience</label>
                                        @php $oldAudience = old('target_audience', []); @endphp
                                        <select name="target_audience[]" multiple class="w-full px-3 py-2 border {{ $errors->has('target_audience') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="all" {{ in_array('all', $oldAudience) ? 'selected' : '' }}>All</option>
                                            <option value="users" {{ in_array('users', $oldAudience) ? 'selected' : '' }}>Users</option>
                                            <option value="guests" {{ in_array('guests', $oldAudience) ? 'selected' : '' }}>Guests</option>
                                        </select>
                                        @error('target_audience')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                                        <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-6 py-3 rounded-lg text-white font-semibold hover:shadow-lg transition-all">Create Banner</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


