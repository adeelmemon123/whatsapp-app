@extends('layouts.auth')

@section('title', 'Sign in')

@section('content')

    <div
        class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-green-100 dark:from-gray-950 dark:via-gray-900 dark:to-emerald-950 flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-md">

            {{-- Logo / App Name --}}
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-emerald-500 to-green-700 shadow-lg shadow-emerald-500/30">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />
                    </svg>
                </div>

                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">
                    {{ config('app.name') }}
                </a>

                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Welcome back! Please sign in to continue.
                </p>
            </div>

            {{-- Status Message --}}
            @if (session('status'))
                <div
                    class="mb-5 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-400">
                    <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span>{{ session('status') }}</span>
                </div>
            @endif


            <div
                class="relative overflow-hidden rounded-3xl border border-gray-200/70 bg-white/90 p-8 shadow-2xl shadow-emerald-900/10 backdrop-blur-xl dark:border-gray-700/70 dark:bg-gray-800/90 sm:p-9">


                <div
                    class="absolute -right-16 -top-16 h-32 w-32 rounded-full bg-emerald-200/40 blur-2xl dark:bg-emerald-500/10">
                </div>
                <div
                    class="absolute -bottom-16 -left-16 h-32 w-32 rounded-full bg-green-200/40 blur-2xl dark:bg-green-500/10">
                </div>

                <div class="relative">


                    <div class="mb-7">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Sign in to your account
                        </h1>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Enter your credentials below to access your account.
                        </p>
                    </div>


                    <form class="space-y-5" method="POST" action="{{ route('login') }}">
                        @csrf

                        <input type="hidden" name="device_token" value="">


                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Email address
                            </label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>

                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    autocomplete="email" autofocus placeholder="name@company.com"
                                    class="block w-full rounded-xl border bg-gray-50 py-3 pl-11 pr-4 text-sm text-gray-900 outline-none transition duration-200 placeholder:text-gray-400
                                    {{ $errors->has('email')
                                        ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-100'
                                        : 'border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100' }}
                                    dark:bg-gray-700/50 dark:text-white dark:placeholder-gray-400
                                    dark:focus:ring-emerald-900/40">
                            </div>

                            @error('email')
                                <p class="mt-2 flex items-center gap-1 text-sm text-red-600 dark:text-red-400">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Password
                                </label>

                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-semibold text-emerald-600 transition hover:text-emerald-700 hover:underline dark:text-emerald-400">
                                    Forgot password?
                                </a>
                            </div>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v2h8z" />
                                    </svg>
                                </div>

                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    autocomplete="current-password"
                                    class="block w-full rounded-xl border bg-gray-50 py-3 pl-11 pr-12 text-sm text-gray-900 outline-none transition duration-200 placeholder:text-gray-400
                                    {{ $errors->has('password')
                                        ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-100'
                                        : 'border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100' }}
                                    dark:bg-gray-700/50 dark:text-white dark:placeholder-gray-400
                                    dark:focus:ring-emerald-900/40">

                                {{-- Show Password --}}
                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 transition hover:text-emerald-600 dark:hover:text-emerald-400"
                                    aria-label="Show password">
                                    <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>

                            @error('password')
                                <p class="mt-2 flex items-center gap-1 text-sm text-red-600 dark:text-red-400">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <div class="flex items-center">
                            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-emerald-600 focus:ring-2 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800">

                            <label for="remember" class="ml-3 text-sm text-gray-600 dark:text-gray-300">
                                Remember me
                            </label>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-500 to-green-600 px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/25 transition-all duration-200 hover:-translate-y-0.5 hover:from-emerald-600 hover:to-green-700 hover:shadow-xl hover:shadow-emerald-500/30 focus:outline-none focus:ring-4 focus:ring-emerald-300 active:translate-y-0 dark:focus:ring-emerald-800">
                            <span>Sign in</span>

                            <svg class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>

                    </form>

                    {{-- Register --}}
                    <div class="mt-7 border-t border-gray-100 pt-6 text-center dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Don't have an account yet?
                            <a href="{{ route('register') }}"
                                class="font-semibold text-emerald-600 transition hover:text-emerald-700 hover:underline dark:text-emerald-400">
                                Create an account
                            </a>
                        </p>
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <p class="mt-6 text-center text-xs text-gray-400 dark:text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>

        </div>
    </div>

    {{-- Password Toggle --}}
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';

                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.086-3.692M6.228 6.228A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.132 5.411M6.228 6.228L3 3m3.228 3.228l3.58 3.58m0 0a3 3 0 104.243 4.243m-4.243-4.243l4.243 4.243m0 0L21 21" />
                `;
            } else {
                password.type = 'password';

                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>

@endsection
```
