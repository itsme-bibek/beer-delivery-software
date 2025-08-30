<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Soft UI Dashboard</title>
    <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />
</head>

<body class="m-0 font-sans antialiased bg-white text-base leading-default text-slate-500">
    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
        <section>
            <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
                <div class="container z-10">
                    <div class="flex flex-wrap justify-center mt-0 -mx-3">
                        <div class="flex flex-col w-full max-w-full px-3 mx-auto md:w-6/12 lg:w-5/12 xl:w-4/12">
                            <div
                                class="relative flex flex-col min-w-0 mt-20 break-words bg-white border-0 shadow-soft-2xl rounded-2xl bg-clip-border">
                                <div class="p-6 pb-0 mb-0 text-center">
                                    <h3
                                        class="font-bold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">
                                        Create Account
                                    </h3>
                                    <p class="mb-0">Fill in your details to register</p>
                                </div>

                                <div class="flex-auto p-6">
                                    <!-- Laravel Register Form -->
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <!-- Name -->
                                        <div class="mb-4">
                                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" required
                                                autofocus
                                                class="text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-fuchsia-300 focus:outline-none" />
                                            @error('name')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-4">
                                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" required
                                                class="text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-fuchsia-300 focus:outline-none" />
                                            @error('email')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-4">
                                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
                                            <input type="password" name="password" required
                                                class="text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-fuchsia-300 focus:outline-none" />
                                            @error('password')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mb-4">
                                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Confirm
                                                Password</label>
                                            <input type="password" name="password_confirmation" required
                                                class="text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-fuchsia-300 focus:outline-none" />
                                        </div>

                                        <!-- Submit -->
                                        <div class="text-center">
                                            <button type="submit"
                                                class="inline-block w-full px-6 py-3 mt-6 font-bold text-white uppercase bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:scale-105 transition">
                                                Sign Up
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="p-6 text-center">
                                    <p class="text-sm">
                                        Already have an account?
                                        <a href="{{ route('login') }}"
                                            class="font-semibold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">
                                            Sign in
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side Image -->
                        <div class="hidden md:block md:w-6/12 lg:w-7/12">
                            <div class="absolute top-0 right-0 w-1/2 h-full overflow-hidden rounded-bl-xl">
                                <div class="h-full bg-cover"
                                    style="background-image: url('{{ asset('assets/img/curved-images/curved6.jpg') }}');">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
