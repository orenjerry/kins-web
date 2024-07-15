<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">
        <link rel="canonical" href="{{ $page->getUrl }}">

        <meta name="description" content="{{ $page->description }}">

        <title>{{ $page->title }} | Kins Web</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
            @include('layouts.admin_dashboard.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                @include('layouts.admin_dashboard.header')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">
                        @yield('body')
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest"></script>
    </body>

</html>
