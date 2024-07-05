<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Kins Web</title>
    @vite('resources/css/app.css')
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-[600px] h-[500px] flex justify-center items-center">
        <div class="w-1/2 pr-4">
            <img src="{{ \Illuminate\Support\Facades\URL::asset('images/bg1-resize.png') }}" alt="Login Image" class="w-full h-auto">
        </div>

        <div class="w-1/2 text-left">
            <h1 class="text-2xl font-semibold mb-4">Login</h1>
            <form method="POST" id="form-login">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="mt-1 p-2 w-full border rounded">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded">
                </div>
                <div class="mb-4">
                    <h3 class="block text-sm font-medium text-gray-700">Don't have account? <a href="/auth/register"
                            class="text-blue-600 underline">Register here!</a></h3>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function notification(message, status = 200) {
            if (status == 200 || status == 201) {
                toastr.success(message);
            } else {
                toastr.error(message);
            }
        }

        @if (session('message'))
            notification('{{ session('message') }}');
        @endif

        @if ($errors->has('login'))
            notification('{{ $errors->first('login') }}', 400);
        @endif

        document.getElementById("password").addEventListener("keydown", function(event) {
            if (event.keyCode === 13) { // Check if Enter key is pressed
                event.preventDefault(); // Prevent the default form submission

                var form = $('#form-login')[0];
                if (form.checkValidity()) {
                    $.ajax({
                        url: "{{ url('auth/login') }}",
                        type: "POST",
                        dataType: "json",
                        data: $('#form-login').serializeArray()
                    }).done(function(response) {
                        notification(response.message, response.status);

                        if (response.status == 200 || response.status == 201) {
                            setTimeout(() => {
                                window.location.href = '{{ url('/') }}';
                            }, 500);
                        }
                    }).fail(function(error) {
                        console.log(error);
                        notification(error.statusText, error.status);
                    });
                } else {
                    // Optionally, you can display a message to the user that the form is not valid
                }
            }
        });

        $('#form-login').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $('#form-login')[0];
            if (form.checkValidity()) {
                $.ajax({
                    url: "{{ url('auth/login') }}",
                    type: "POST",
                    dataType: "json",
                    data: $('#form-login').serializeArray()
                }).done(function(response) {
                    notification(response.message, response.status);

                    if (response.status == 200 || response.status == 201) {
                        setTimeout(() => {
                            window.location.href = '{{ url('/') }}';
                        }, 500);
                    }
                }).fail(function(error) {
                    notification(error.statusText, error.status);
                });
            } else {
                // Optionally, you can display a message to the user that the form is not valid
            }
        });
    </script>
</body>

</html>
