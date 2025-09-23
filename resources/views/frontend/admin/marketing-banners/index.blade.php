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
                                <h6 class="text-lg font-semibold text-gray-800">Marketing Banners</h6>
                                <p class="text-sm text-slate-500 mt-1">Manage homepage/user welcome banners</p>
                            </div>
                            <a href="{{ route('admin.marketing-banners.create') }}" class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                <i class="fas fa-plus mr-2"></i>Create Banner
                            </a>
                        </div>
                    </div>
                    <div class="flex-auto p-6 px-0 pb-2">
                        <div class="overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Title</th>
                                        <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Audience</th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Active</th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Schedule</th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Order</th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="w-12 h-12 rounded-lg object-cover mr-3">
                                                    <div>
                                                        <h6 class="text-sm font-semibold text-gray-800">{{ $banner->title }}</h6>
                                                        @if($banner->welcome_message)
                                                            <p class="text-xs text-slate-400">{{ $banner->welcome_message }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                @php $aud = $banner->target_audience ?? ['all']; @endphp
                                                <span class="text-xs text-slate-600">{{ implode(', ', $aud) }}</span>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                @if($banner->is_active)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                <span class="text-xs text-slate-600">
                                                    {{ $banner->start_date ? $banner->start_date->format('M d, Y') : '—' }}
                                                    —
                                                    {{ $banner->end_date ? $banner->end_date->format('M d, Y') : '—' }}
                                                </span>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">{{ $banner->display_order }}</td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="{{ route('admin.marketing-banners.edit', $banner) }}" class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('admin.marketing-banners.toggle', $banner) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-gradient-to-tl from-yellow-500 to-orange-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all">
                                                            <i class="fas {{ $banner->is_active ? 'fa-pause' : 'fa-play' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.marketing-banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Delete this banner?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-gradient-to-tl from-red-500 to-pink-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="p-8 text-center text-gray-500">
                                                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-bullhorn text-3xl text-gray-400"></i>
                                                </div>
                                                <h6 class="text-lg font-semibold text-gray-800 mb-2">No banners found</h6>
                                                <p class="text-sm text-gray-600">Create your first marketing banner to welcome users.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6 px-6">
                            {{ $banners->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


