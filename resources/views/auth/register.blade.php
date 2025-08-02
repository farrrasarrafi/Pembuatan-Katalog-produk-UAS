<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page | Arrafi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      integrity="sha512-bu3YykGp1XBm0xAlCKb5ClP4TGLP2V+5Kox0I1XRpNiWxLsR9ZfWevZm2E2+lDHeZB0JYdJ7Iq9xGOuCu0AYyg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .social-btn {
            @apply w-12 h-12 rounded-full flex items-center justify-center border border-gray-300 hover:bg-gray-100 transition;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-gray-100 to-blue-100 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2">

        <!-- Register Form Section -->
        <div class="p-12 flex flex-col justify-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-4 text-center">Register</h2>

            <!-- OR divider -->
            <p class="text-sm text-gray-500 mb-6 text-center -mt-1">use your email and password</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-6 w-full">
                @csrf

                <div class="flex flex-col">
                    <label for="name" class="mb-1 font-semibold text-gray-800">Name</label>
                    <input id="name" type="text" name="name" required
                        class="w-full bg-white text-black border border-gray-400 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your name">
                </div>

                <div class="flex flex-col">
                    <label for="email" class="mb-1 font-semibold text-gray-800">Email</label>
                    <input id="email" type="email" name="email" required
                        class="w-full bg-white text-black border border-gray-400 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your email">
                </div>

                <div class="flex flex-col">
                    <label for="password" class="mb-1 font-semibold text-gray-800">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full bg-white text-black border border-gray-400 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your password">
                </div>

                <div class="flex flex-col">
                    <label for="password_confirmation" class="mb-1 font-semibold text-gray-800">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full bg-white text-black border border-gray-400 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Repeat your password">
                </div>

                <div class="text-right">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Already have an account?</a>
                </div>

                <button type="submit"
                    class="w-full bg-purple-800 text-white py-3 rounded-lg text-lg font-semibold hover:bg-purple-900 transition">
                    Register
                </button>
            </form>
        </div>

        <!-- Right Side Section -->
        <div class="bg-blue-900 text-white p-12 flex flex-col justify-center items-center text-center">
            <h2 class="text-3xl font-bold mb-4">Welcome to ArrafiStore</h2>
            <p class="mb-3 text-sm">Sudah punya akun? Silakan login dan nikmati berbagai promo menarik!</p>
            <a href="{{ route('login') }}"
               class="border border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-900 transition">
                Login
            </a>
        </div>
    </div>

</body>
</html>
