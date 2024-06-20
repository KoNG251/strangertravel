<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/assets/css/index.css') }}">
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
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
            <navbar
            :logo-primary="'{{ asset('assets/favicon.ico') }}'"
            :user="'{{ json_encode(session('user')) }}'"
            :csrf-token="'{{ csrf_token() }}'"
            :picture-profile="'{{ asset('storage/userProfiles/') }}'"
            :profile-route="'{{ route('auth.profiles') }}'"
            :chat-route="'{{route('chat')}}'"
            :login-path="'{{ route('viewlogin') }}'"
            :register-path="'{{ route('viewregister') }}'"
            :calculate-route="'{{ route('calculate') }}'"
            ></navbar>


            <div class="container grid grid-cols-4 gap-5 mx-auto p-10">
                @foreach ($query as $hotel)
                @php
                    $photos = $hotel->photos ? explode(',', $hotel->photos) : [];
                    $firstPhoto = !empty($photos) ? $photos[0] : 'default.jpg';
                @endphp
                <a href="{{ route('booking.information',['id'=>$hotel->id]) }}" class="box-hotel col-span-4 md:col-span-2 xl:col-span-1">
                    <div class="box-picture rounded-3xl" style="background-image: url('{{ asset('storage/hotelPicture/' . $firstPhoto) }}')">
                    </div>
                    <h1 class="hotel-title font-bold">{{ $hotel->name }}</h1>
                    <p class="hotel-sub">{{ $hotel->province }}</p>
                </a>
                @endforeach
            </div>
            <div class="mt-4 mb-6">
                {{ $query->links() }}
            </div>

            <index-footer
            :logo-primary="'{{ asset('assets/favicon.ico') }}'"
            ></index-footer>

        </div>
    </body>
</html>
