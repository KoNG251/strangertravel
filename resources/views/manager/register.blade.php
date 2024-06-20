<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth focus:scroll-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>StrangerTravel</title>
    </head>
    <body id="app" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>

            <manager-register
            :logo="'{{ asset('assets/favicon.ico') }}'"
            :background="'{{ asset('assets/media/illustrations/sigma-1/14.png') }}'"
            :csrf-token="'{{ csrf_token() }}'"
            :login-route="'{{ route('manager.index') }}'"
            >
            </manager-register>

        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    </body>
</html>
