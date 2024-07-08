<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('assets/css/results.css') }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>StrangerTravel</title>
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
    </head>
    <body class="flex flex-col min-h-screen">
        @include('sweetalert::alert')
        <div id="app">
            <result
            :background="'{{ asset('assets/media/illustrations/dozzy-1/14-dark.png') }}'"
            :image1="'{{ asset('assets/media/illustrations/sketchy-1/5-dark.png') }}'"
            :image2="'{{ asset('assets/media/illustrations/sketchy-1/13.png') }}'"
            :image3="'{{ asset('assets/media/illustrations/sketchy-1/6-dark.png') }}'"
            :picture-hotel-route="'{{ asset('storage/hotelPicture/') }}'"
            :csrf-token="'{{ csrf_token() }}'"
            ></result>
        </div>
    </body>
</html>
