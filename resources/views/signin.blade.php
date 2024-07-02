<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Kins Web</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-[600px] h-[500px] flex justify-center items-center">
        <div class="w-1/2 pr-4">
            <img src="../images/bg1-resize.png" alt="Login Image" class="w-full h-auto">
        </div>

        <div class="w-1/2 text-left">
            <h1 class="text-2xl font-semibold mb-4">Sign In</h1>
            <form action="{{ route('signin') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="mt-1 p-2 w-full border rounded">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded">
                </div>
                <div class="mb-4">
                    <h3 class="block text-sm font-medium text-gray-700">Don't have account? <a href="/auth/signup"
                            class="text-blue-600 underline">Register here!</a></h3>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
            </form>
            @error('login')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </div>
</body>

</html>
