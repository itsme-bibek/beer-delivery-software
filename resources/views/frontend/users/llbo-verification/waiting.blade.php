@extends('layout.app')

@section('main')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex items-center justify-center">
            <div class="bg-white shadow-soft-xl rounded-2xl p-8 max-w-xl text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-hourglass-half text-3xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Waiting for LLBO Verification</h1>
                <p class="text-gray-600 mb-6">Your account is pending LLBO license verification. You will receive an email once it's reviewed.</p>
                <div class="space-x-2">
                    <a href="{{ route('user.llbo-verification.index') }}" class="bg-gradient-to-tl from-blue-500 to-cyan-400 px-5 py-2 rounded-lg text-white font-semibold">View Status</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-gray-600 px-5 py-2 rounded-lg text-white font-semibold">Logout</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
        </div>
    </div>
</main>
@endsection


