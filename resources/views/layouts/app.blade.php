<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body>


    <div>

        @include('partials.navigation')
        @include('partials.sidebar')
        <main class="pl-12 md:pl-24">
            @yield('breadcrumbs')
            @yield('content')
        </main>

        @yield('scripts')

    </div>


</body>

</html>
