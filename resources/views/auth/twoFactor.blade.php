@extends('layouts.auth')

@section('title', 'Two Factor Sign in')

@section('content')

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img src="{{ url('images/logo.png') }}" class="mr-3 h-10" alt="Orido Profile" />
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Two-Factor Authentication
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('verify.store') }}">
                        @csrf
                        <div>
                            <label for="code"
                                class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-300">Please enter the
                                authentication code sent to your email.</label>
                            <input id="two_factor_code" type="text" maxlength="6" name="two_factor_code"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="XXXXXX" value="" required autofocus>
                            @error('two_factor_code')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}</span> </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">If you haven't received
                                        the authentication code click <a href="{{ route('verify.resend') }}"
                                            class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">here</a>
                                        to request another.</label>
                                </div>
                            </div>

                        </div>
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Verify</button>

                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
