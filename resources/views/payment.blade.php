<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/assets/css/payment.css') }}">
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
        <script src="https://cdn.omise.co/omise.js"></script>
    </head>
    <body class="flex flex-col min-h-screen">
        @include('sweetalert::alert')
        <div id="app">
            <payment
            :csrf-token="'{{ csrf_token() }}'"
            :card-payment="'{{ route('booking.payment.card') }}'"
            :prompt-pay="'{{ route('booking.payment.promptpay') }}'"
            :success-route="'{{ route('booking.success') }}'"
            >
            </payment>
        </div>
    </body>
</html>
