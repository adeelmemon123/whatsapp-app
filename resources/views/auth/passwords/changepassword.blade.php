@extends('layouts.auth')

@section('title', 'Change Password')

@section('content')

<div class="px-4">
@include('error')
@include('success')
</div>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img src="{{ $site_logo }}" class="mr-3 h-12" alt="Change Password Logo" fetchpriority="high" />
            </a>
            <div
                class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
                <h1 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Change Password
                </h1>
                <form method="POST" action="{{ route('profile.password') }}" class="mt-4 space-y-4 lg:mt-5 md:space-y-5">
                    @csrf
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                            Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span> </p>
                        @enderror
                    </div>
                    <div>
                        <label for="confirm-password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                        <input type="password" name="password_confirmation" id="confirm-password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div>
                        <label for="oldpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Old Password</label>
                        <input type="oldpassword" name="oldpassword" id="oldpassword" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('oldpassword')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span> </p>
                        @enderror
                    </div>

                    <div class="flex justify-between space-x-2">
                        <!-- Reset Password Button -->
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Reset Password
                        </button>

                        <!-- Back Button -->
                        <a href="{{ route('profile') }}"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            Back
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
