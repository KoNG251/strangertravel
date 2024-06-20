<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/assets/css/chat.css') }}">
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
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            /* Hide scrollbar for IE, Edge and Firefox */
            .no-scrollbar {
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }
        </style>
        <script src="https://cdn.omise.co/omise.js"></script>
    </head>
    <body class="flex flex-col min-h-screen">
        @include('sweetalert::alert')
        <div id="app">
            <chat
            :logo="'{{ asset('assets/picture/logo.png') }}'"
            :chat-route="'{{ route('chat') }}'"
            :user-id="'{{ session('user') }}'"
            :create-chat="'{{ route('chat.create') }}'"
            :csrf-token="'{{ csrf_token() }}'"
            :chat-group="'{{ asset('storage/groupProfiles/') }}'"
            :pusher-key="'{{ env('VITE_PUSHER_APP_KEY') }}'"
            :pusher-cluster="' {{ env('VITE_PUSHER_APP_CLUSTER') }} '"
            :profile-route="'{{ asset('storage/userProfiles') }}'"
            :index-route="'{{ route('index') }}'"
            >
            </chat>
        </div>
    </body>
</html>
