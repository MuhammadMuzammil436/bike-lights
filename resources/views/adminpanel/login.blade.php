<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bike Lights | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite('resources/css/app.css')
</head>

<body>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 px-4">

        <div class="w-full max-w-md">

            {{-- Login Card --}}
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

                {{-- Header --}}
                <div class="px-7 pt-7 pb-5">
                    {{-- <div class="flex items-center justify-center mb-5">
                        <div class="w-14 h-14 rounded-xl bg-blue-950 flex items-center justify-center shadow-lg">
                            <i class="fa-solid fa-bicycle text-white text-2xl"></i>
                        </div>
                    </div> --}}

                    <h1 class="text-2xl font-bold text-gray-900 text-center">
                        Welcome Back
                    </h1>

                    <p class="text-sm text-gray-500 text-center mt-1">
                        Sign in to your admin panel
                    </p>
                </div>

                <div class="px-7 pb-7">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div
                            class="mb-5 flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- General Error --}}
                    @if (session('error'))
                        <div
                            class="mb-5 flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    {{-- All Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3">
                            <div class="flex items-center gap-2 text-sm font-semibold text-red-700 mb-1">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span>Please check the following:</span>
                            </div>

                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.form') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Email Address
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fa-regular fa-envelope"></i>
                                </span>

                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Enter your email" autocomplete="email"
                                    class="w-full rounded-lg border bg-gray-50 py-2.5 pl-10 pr-3 text-sm text-gray-800
                                outline-none transition
                                focus:bg-white focus:ring-2 focus:ring-blue-950/20
                                @error('email')
                                    border-red-500 focus:ring-red-200
                                @else
                                    border-gray-300 focus:border-blue-950
                                @enderror">
                            </div>

                            @error('email')
                                <p class="mt-1.5 text-xs font-medium text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Password
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fa-solid fa-lock"></i>
                                </span>

                                <input type="password" id="password" name="password" placeholder="Enter your password"
                                    autocomplete="current-password"
                                    class="w-full rounded-lg border bg-gray-50 py-2.5 pl-10 pr-11 text-sm text-gray-800
                                outline-none transition
                                focus:bg-white focus:ring-2 focus:ring-blue-950/20
                                @error('password')
                                    border-red-500 focus:ring-red-200
                                @else
                                    border-gray-300 focus:border-blue-950
                                @enderror">

                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-700 transition">
                                    <i id="passwordIcon" class="fa-regular fa-eye"></i>
                                </button>
                            </div>

                            @error('password')
                                <p class="mt-1.5 text-xs font-medium text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 rounded-lg
                        bg-blue-950 px-4 py-2.5
                        text-sm font-semibold text-white
                        shadow-md
                        transition-all duration-200
                        hover:bg-blue-900 hover:-translate-y-0.5 hover:shadow-lg
                        active:translate-y-0
                        focus:outline-none focus:ring-2 focus:ring-blue-950 focus:ring-offset-2">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Sign In
                        </button>

                    </form>

                </div>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-gray-500 mt-5">
                © {{ date('Y') }} BikeLight PK. All rights reserved.
            </p>

        </div>
    </div>

    {{-- Password Toggle --}}
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        togglePassword.addEventListener('click', function() {
            const isPassword = password.type === 'password';

            password.type = isPassword ? 'text' : 'password';

            passwordIcon.classList.toggle('fa-eye', !isPassword);
            passwordIcon.classList.toggle('fa-eye-slash', isPassword);
        });
    </script>
</body>

</html>
