<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile | Kins Web</title>
    @vite('resources/css/app.css')
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-[550px] h-[650px] flex justify-center items-center">
        <div class="text-left">
            <h1 class="text-2xl font-semibold mb-4">Create Profile</h1>
            <form method="POST" id="form-profile" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" id="photo" name="photo" class="mt-1 p-2 w-full border rounded">
                </div>
                <div class="mb-4">
                    <label for="banner" class="block text-sm font-medium text-gray-700">Banner</label>
                    <input type="file" id="banner" name="banner" class="mt-1 p-2 w-full border rounded">
                </div>
                <div class="mb-4">
                    <label for="about" class="block text-sm font-medium text-gray-700">About</label>
                    <textarea id="about" name="about" class="mt-1 p-2 w-full border rounded" rows="3"></textarea>
                </div>
                <div class="mb-4">
                    <label for="pronouns" class="block text-sm font-medium text-gray-700">Pronouns</label>
                    <input type="text" id="pronouns" name="pronouns" class="mt-1 p-2 w-full border rounded">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Profile</button>
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

        @if ($errors->has('profile'))
            notification('{{ $errors->first('profile') }}', 400);
        @endif

        $('#form-profile').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            $.ajax({
                url: "{{ url('profile/make-profile') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json"
            }).done(function(response) {
                notification(response.message, response.status);

                if (response.status == 200 || response.status == 201) {
                    setTimeout(() => {
                        window.location.href = '{{ url('/') }}';
                    }, 500);
                }
            }).fail(function(error) {
                notification(error.data, error.status);
                console.log(error);
            });
        });
    </script>
</body>

</html>
