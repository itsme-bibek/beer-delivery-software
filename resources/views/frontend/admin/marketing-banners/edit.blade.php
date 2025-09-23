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
                                <h6 class="text-lg font-semibold text-gray-800">Edit Marketing Banner</h6>
                                <p class="text-sm text-slate-500 mt-1">Update banner details</p>
                            </div>
                            <a href="{{ route('admin.marketing-banners.index') }}" class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                        </div>
                    </div>
                    <div class="flex-auto p-6">
                        <form action="{{ route('admin.marketing-banners.update', $marketingBanner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                                        <input type="text" name="title" value="{{ old('title', $marketingBanner->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                        <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $marketingBanner->description) }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Welcome Message</label>
                                        <input type="text" name="welcome_message" value="{{ old('welcome_message', $marketingBanner->welcome_message) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                                            <input type="text" name="button_text" value="{{ old('button_text', $marketingBanner->button_text) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Button URL</label>
                                            <input type="url" name="button_url" value="{{ old('button_url', $marketingBanner->button_url) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                                        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        @if($marketingBanner->image_path)
                                            <p class="text-xs text-gray-500 mt-2">Current:</p>
                                            <img src="{{ $marketingBanner->image_url }}" alt="{{ $marketingBanner->title }}" class="w-40 h-24 object-cover rounded mt-1">
                                        @endif
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                            <input type="datetime-local" name="start_date" value="{{ old('start_date', optional($marketingBanner->start_date)->format('Y-m-d\TH:i')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                            <input type="datetime-local" name="end_date" value="{{ old('end_date', optional($marketingBanner->end_date)->format('Y-m-d\TH:i')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                                            <input type="number" min="0" name="display_order" value="{{ old('display_order', $marketingBanner->display_order) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        <div class="flex items-center mt-6">
                                            <input id="is_active" type="checkbox" name="is_active" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ $marketingBanner->is_active ? 'checked' : '' }}>
                                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Target Audience</label>
                                        @php $aud = $marketingBanner->target_audience ?? ['all']; @endphp
                                        <select name="target_audience[]" multiple class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="all" {{ in_array('all', $aud) ? 'selected' : '' }}>All</option>
                                            <option value="users" {{ in_array('users', $aud) ? 'selected' : '' }}>Users</option>
                                            <option value="guests" {{ in_array('guests', $aud) ? 'selected' : '' }}>Guests</option>
                                        </select>
                                        <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-6 py-3 rounded-lg text-white font-semibold hover:shadow-lg transition-all">Update Banner</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


