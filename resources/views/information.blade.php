<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/assets/css/information.css') }}">
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
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
        <div id="app" class="container mx-auto">
            @php

                $jsonString = json_encode($item);
                $jsonString = preg_replace('/"\[/', '[', $jsonString);
                $jsonString = preg_replace('/\]"/', ']', $jsonString);

                $roomString = json_encode($rooms);
                $roomString = preg_replace('/"\{/', '{', $roomString);
                $roomString = preg_replace('/\}"/', '}', $roomString);

            @endphp
            <information
            :index-route="'{{ route('index') }}'"
            :item-array="'{{ $jsonString }}'"
            :room-array="'{{ $roomString }}'"
            :picture-hotel-route="'{{ asset('storage/hotelPicture/') }}'"
            :count="'{{ $count }}'"
            :add-booking-route="'{{ route('booking.add') }}'"
            :csrf-toker="'{{ csrf_token() }}'"
            :booking-information-route="'{{ route('booking.info') }}'"
            ></information>
        </div>
    </body>
</html>
