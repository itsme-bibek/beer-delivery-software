<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Soft UI Dashboard</title>
    <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />
</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-base leading-default text-slate-500">
    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
        <section>
            <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
                <div class="container z-10">
                    <div class="flex flex-wrap justify-center mt-0 -mx-3">
                        <div class="flex flex-col w-full max-w-full px-3 mx-auto md:w-6/12 lg:w-5/12 xl:w-4/12">
                            <div
                                class="relative flex flex-col min-w-0 mt-32 break-words bg-white border-0 shadow-soft-2xl rounded-2xl bg-clip-border">
                                <div class="p-6 pb-0 mb-0 text-center bg-transparent border-b-0 rounded-t-2xl">
                                    <h3
                                        class="font-bold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">
                                        Welcome Back
                                    </h3>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>

                                <div class="flex-auto p-6">
                                    <!-- Laravel Login Form -->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <!-- Email -->
                                        <div class="mb-4">
                                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" required
                                                autofocus
                                                class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 transition-all focus:border-fuchsia-300 focus:outline-none" />
                                            @error('email')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-4">
                                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
                                            <input type="password" name="password" required
                                                class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 transition-all focus:border-fuchsia-300 focus:outline-none" />
                                            @error('password')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Remember me -->
                                        <div class="flex items-center mb-4">
                                            <input id="rememberMe" name="remember" type="checkbox"
                                                class="mr-2 rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200">
                                            <label for="rememberMe" class="text-sm text-slate-700">Remember me</label>
                                        </div>

                                        <!-- Submit -->
                                        <div class="text-center">
                                            <button type="submit"
                                                class="inline-block w-full px-6 py-3 mt-6 font-bold text-white uppercase bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:scale-105 transition">
                                                Sign In
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="p-6 text-center border-t-0 rounded-b-2xl">
                                    <p class="text-sm">
                                        Don't have an account?
                                        <a href="{{ route('register') }}"
                                            class="font-semibold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">
                                            Sign up
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
