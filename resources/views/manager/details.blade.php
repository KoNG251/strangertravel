<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/manager/details.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>StrangerTravel</title>
    </head>
    <body class="flex flex-col min-h-screen">
        @include('sweetalert::alert')
        <div id="app">
            <detail
            :logo-primary="'{{ asset('assets/favicon.ico') }}'"
            :logout-route="'{{ route('logout_self') }}'"
            :index-route="'{{ route('index') }}'"
            :store-route="'{{ route('manager.saveDetails') }}'"
            :province-route="'{{ asset('assets/js/thai_provinces.json') }}'"
            :amphures-route="'{{ asset('assets/js/thai_amphures.json')}}'"
            :csrf-token="'{{ csrf_token() }}'"
            :add-picture-route="'{{ route('manager.viewPicture') }}'"
            >
            </detail>
        </div>
    </body>
</html>
