@extends('layouts.auth')


@section('title', 'Sign up')


@section('content')

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-4 mt-4 text-2xl font-semibold text-gray-900 dark:text-white">
                <img src="{{ $site_logo }}" class="mr-3 h-10 w-auto" alt="Create Account Logo"
                    fetchpriority="high" />
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
                        class="space-y-4 md:space-y-6">
                        @csrf


                         <input type="hidden" name="device_token" value="">

                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input id="name" type="text" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Son of Adam" value="{{ old('name') }}" autocomplete="name" autofocus>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}</span> </p>
                            @enderror
                        </div>


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
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class=" @error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                autocomplete="current-password">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}</span> </p>
                            @enderror
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password_confirmation" id="confirm-password" placeholder="••••••••"
                                class=" @error('password_confirmation') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                autocomplete="confirm-password">
                            @error('password_confirmation')
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
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create
                            an account</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="{{ route('login') }}"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

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

