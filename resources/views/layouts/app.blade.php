<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Kins Web</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-500 text-white py-4">
        <div class="container mx-auto">
            <a href="/" class="text-xl font-semibold">Kins Web</a>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        @yield('content')
    </div>

    @yield('script')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#test-query').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('profile/activity/last-online/set') }}",
                    data: {
                        activity: 'offline',
                    },
                    success: function(response) {
                        console.log('Activity status updated:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to update activity status:', error);
                    }
                });
            });
        });
    </script> --}}

</body>

</html>
