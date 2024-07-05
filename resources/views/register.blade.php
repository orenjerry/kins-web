<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Kins Web</title>
    <!-- Include your CSS stylesheets here -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-[600px] h-[500px] flex justify-center items-center">
        <div class="w-1/2 pr-4">
            <img src="{{ \Illuminate\Support\Facades\URL::asset('images/bg1-resize.png') }}" alt="Login Image"
                class="w-full h-auto">
        </div>

        <div class="w-1/2 text-left">
            <h1 class="text-2xl font-semibold mb-4">Sign Up</h1>
            <form id="form-register" method="POST" autocomplete="off">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="mt-1 p-2 w-full border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded" required>
                </div>
                <div class="mb-4">
                    <h3 class="block text-sm font-medium text-gray-700">Already have an account? <a href="/auth/login"
                            class="text-blue-600 underline">Login here!</a></h3>
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Register</button>
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

        $('#form-register').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $('#form-register')[0];
            if (form.checkValidity()) {
                $.ajax({
                    url: "{{ url('auth/register') }}",
                    type: "POST",
                    dataType: "json",
                    data: $('#form-register').serializeArray()
                }).done(function(response) {
                    notification(response.message, response.status);

                    if (response.status == 200 || response.status == 201) {
                        setTimeout(() => {
                            window.location.href = '{{ url('/auth/login') }}';
                        }, 500);
                    }
                }).fail(function(error) {
                    notification(error.message, error.status);
                });
            } else {
                // Optionally, you can display a message to the user that the form is not valid
            }
        });
    </script>
</body>

</html>
