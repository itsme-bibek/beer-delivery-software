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
                                <h6 class="text-lg font-semibold text-gray-800">Banner Detail</h6>
                                <p class="text-sm text-slate-500 mt-1">{{ $marketingBanner->title }}</p>
                            </div>
                            <a href="{{ route('admin.marketing-banners.index') }}" class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                        </div>
                    </div>
                    <div class="flex-auto p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <img src="{{ $marketingBanner->image_url }}" alt="{{ $marketingBanner->title }}" class="w-full rounded-2xl shadow-lg object-cover">
                            </div>
                            <div class="space-y-3 text-sm">
                                <div><span class="text-gray-600">Title:</span> <span class="font-semibold text-gray-800">{{ $marketingBanner->title }}</span></div>
                                @if($marketingBanner->description)
                                    <div><span class="text-gray-600">Description:</span> <span class="text-gray-800">{{ $marketingBanner->description }}</span></div>
                                @endif
                                @if($marketingBanner->welcome_message)
                                    <div><span class="text-gray-600">Welcome:</span> <span class="text-gray-800">{{ $marketingBanner->welcome_message }}</span></div>
                                @endif
                                <div><span class="text-gray-600">Button:</span> <span class="text-gray-800">{{ $marketingBanner->button_text ?? '—' }}</span></div>
                                <div><span class="text-gray-600">URL:</span> <span class="text-gray-800">{{ $marketingBanner->button_url ?? '—' }}</span></div>
                                <div><span class="text-gray-600">Audience:</span> <span class="text-gray-800">{{ implode(', ', $marketingBanner->target_audience ?? ['all']) }}</span></div>
                                <div><span class="text-gray-600">Schedule:</span> <span class="text-gray-800">{{ $marketingBanner->start_date ? $marketingBanner->start_date->format('M d, Y') : '—' }} — {{ $marketingBanner->end_date ? $marketingBanner->end_date->format('M d, Y') : '—' }}</span></div>
                                <div><span class="text-gray-600">Order:</span> <span class="text-gray-800">{{ $marketingBanner->display_order }}</span></div>
                                <div><span class="text-gray-600">Status:</span> <span class="text-gray-800">{{ $marketingBanner->is_active ? 'Active' : 'Inactive' }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


