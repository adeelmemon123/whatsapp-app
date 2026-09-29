<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.scripts')

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link rel="canonical" href="{{ url()->current() }}" />

    @php
        $currentPath = ucfirst(Str::afterLast(Request::path(), '/'));
    @endphp

    @if (isset($site_title))
        <title>{{ $site_title }} | {{ $currentPath }} @yield('title', '')</title>
    @else
        <title>WhatsApp | @yield('title', '')</title>
    @endif

    <link rel="icon" href="{{ asset('images/logo.webp') }}" type="image/x-icon">
</head>
