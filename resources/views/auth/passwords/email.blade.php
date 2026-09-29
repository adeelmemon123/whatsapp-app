@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img src="{{ $site_logo }}" class="mr-3 h-12 w-auto" alt="Forgot Password Logo"
                    fetchpriority="high" />
            </a>
            <div
                class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
                <h1 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Forgot your password?
                </h1>
                <p class="font-light text-gray-500 dark:text-gray-400">Don't fret! Just type in your email and we will send
                    you a code to reset your password!</p>
                <form method="POST" action="{{ route('password.email') }}" class="mt-4 space-y-4 lg:mt-5 md:space-y-5">
                    @csrf
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input id="email" type="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@company.com" value="{{ old('email') }}" autocomplete="email" autofocus>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">{{ $message }}</span> </p>
                        @enderror
                    </div>

                    <div>
                    <div class="flex items-center space-x-2">
                       <img id="captcha" src="{{ captcha_src('math') }}" alt="captcha" class="w-28 h-10 lg:w-40 lg:h-10">

                       <button type="button" id="reloadCaptcha" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300 transition duration-300 text-gray-600 text-xl shadow-sm">&#x21bb;</button>

                        <input type="number" name="captcha" id="captcha" class="w-24 lg:w-64 xl:w-64 @error('captcha') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="CAPTCHA">
                           
                      </div>

                         @error('captcha')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            <span class="font-medium">{{ $message }}</span>
                         </p>
                          @enderror
                    </div>


                    <button type="submit"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset
                        password</button>

                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-2"> Already have an account? <a href="{{ route('login') }}"  class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login</a></p>
                </form>

            </div>
        </div>
    </section>

    @if (session('status'))
        <div id="successModal" tabindex="-1" aria-hidden="true"
            class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="successModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div
                        class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                        <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Success</span>
                    </div>
                    <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">{{ session('status') }}</p>
                    <a href="{{ route('password.request') }}" data-modal-toggle="successModal" type="button"
                        class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:focus:ring-primary-900">
                        Continue
                    </a>
                </div>
            </div>
        </div>

        <script>
            // Show the modal by adding the necessary classes
            document.addEventListener("DOMContentLoaded", function(event) {
                document.getElementById('successModal').classList.add('visible'); // Add class to show modal
                document.body.classList.add('modal-open'); // Add class to prevent scrolling
            });
        </script>
    @endif

@endsection




@section('scripts')
<script>
    document.getElementById('reloadCaptcha').addEventListener('click', function () {
      fetch('/reload-captcha')
        .then(response => response.json())
        .then(data => {
            document.getElementById('captcha').src = data.captcha + '?' + Date.now();
        });
    });
</script>
@endsection
