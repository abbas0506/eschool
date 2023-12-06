<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ghss-cb</title>
    <link rel="icon" href="{{ asset('/images/logo/logo-light.png') }}">
    <!-- Fonts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    @vite(['resources/js/app.js','resources/css/app.css'])

    <script src="{{ asset('/fonts/bootstrap-icons/bootstrap-icons.min.css') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/swiper.css') }}">
    <style>
        body {
            /* font-family: Nunito, sans-serif; */
        }
    </style>
</head>

<body>
    @yield('header')
    @yield('sidebar')
    @yield('body')

    <script src="{{asset('js/sweetalert2@10.js')}}"></script>
    <script type="module" src="{{asset('js/collapsible.js')}}"></script>
    <script type="module" src="{{asset('js/swiper.js')}}"></script>
    <script type="module" src="{{asset('js/testimonial.js')}}"></script>

    @yield('script')
    @yield('footer')
</body>

</html>