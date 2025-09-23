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
                                <h6 class="text-lg font-semibold text-gray-800">LLBO Licenses Expiring Soon</h6>
                                <p class="text-sm text-slate-500 mt-1">Users whose licenses expire within 30 days</p>
                            </div>
                            <a href="{{ route('admin.llbo-verifications.index') }}" class="bg-gradient-to-tl from-gray-500 to-gray-600 px-4 py-2 rounded-lg text-white text-sm font-semibold hover:shadow-lg transition-all">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="flex-auto p-6 px-0 pb-2">
                        <div class="overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">User</th>
                                        <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">License #</th>
                                        <th class="px-6 py-3 font-bold text-left text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Type</th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Expiry Date</th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Days Left</th>
                                        <th class="px-6 py-3 font-bold text-center text-xxs text-slate-400 uppercase tracking-normal border-b border-gray-200 opacity-70">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($expiringVerifications as $verification)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 rounded-full bg-gradient-to-tl from-blue-500 to-cyan-400 flex items-center justify-center text-white text-sm font-bold mr-3">
                                                        {{ substr($verification->user->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="text-sm font-semibold text-gray-800">{{ $verification->user->name }}</h6>
                                                        <p class="text-xs text-slate-400">{{ $verification->user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">{{ $verification->license_number }}</td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap">{{ $verification->license_type }}</td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">{{ $verification->expiry_date->format('M d, Y') }}</td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                <span class="text-sm font-semibold text-yellow-600">{{ $verification->days_until_expiry }}</span>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="{{ route('admin.llbo-verifications.show', $verification) }}" class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all"><i class="fas fa-eye"></i></a>
                                                    <form action="{{ route('admin.llbo-verifications.reminder', $verification) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-gradient-to-tl from-yellow-500 to-orange-400 px-3 py-1 rounded-lg text-white text-xs font-semibold hover:shadow-lg transition-all"><i class="fas fa-bell"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="p-8 text-center text-gray-500">
                                                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-id-card text-3xl text-gray-400"></i>
                                                </div>
                                                <h6 class="text-lg font-semibold text-gray-800 mb-2">No expiring licenses found</h6>
                                                <p class="text-sm text-gray-600">No LLBO verifications are expiring within the next 30 days.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


