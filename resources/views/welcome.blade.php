<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page | Arrafi</title>
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

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out both;
        }

        .input-style {
            @apply w-full px-5 py-4 text-base rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500;
        }

        .social-btn {
            @apply w-12 h-12 rounded-full flex items-center justify-center border border-gray-300 hover:bg-gray-100 transition;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-gray-100 to-blue-100 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 fade-in-up">
        <!-- Sign In Section -->
        <div class="p-12 flex flex-col justify-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-4 text-center">Log In</h2>

<!-- Social Icons -->
<div class="flex justify-center gap-5 mb-4">
    <!-- Google -->
    <a href="#" onclick="alert('Maaf, untuk sementara belum bisa diakses'); return false;" class="social-btn">
        <img src="https://img.icons8.com/color/48/google-logo.png" alt="Google" class="w-6 h-6">
    </a>
    <!-- Facebook -->
    <a href="#" onclick="alert('Maaf, untuk sementara belum bisa diakses'); return false;" class="social-btn">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" alt="Facebook" class="w-6 h-6">
    </a>
    <!-- Twitter (X) -->
    <a href="#" onclick="alert('Maaf, untuk sementara belum bisa diakses'); return false;" class="social-btn">
        <img src="https://img.icons8.com/ios-filled/50/000000/twitterx--v1.png" alt="Twitter X" class="w-6 h-6">
    </a>
</div>


            <!-- OR divider -->
            <p class="text-sm text-gray-500 mb-4 text-center -mt-1">or use your email and password</p>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6 w-full">
                @csrf

                <div class="flex flex-col">
                    <label for="email" class="mb-1 font-semibold text-gray-800">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Enter your email" 
                        class="w-full bg-white text-black border border-gray-400 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="flex flex-col">
                    <label for="password" class="mb-1 font-semibold text-gray-800">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Enter your password" 
                        class="w-full bg-white text-black border border-gray-400 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="text-right">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forgot Your Password?</a>
                </div>

                <button type="submit" class="w-full bg-purple-800 text-white py-3 rounded-lg text-lg font-semibold hover:bg-purple-900 transition">Sign In</button>
            </form>
        </div>

        <!-- Right Side Section -->
        <div class="bg-blue-900 text-white p-12 flex flex-col justify-center items-center text-center">
            <h2 class="text-3xl font-bold mb-4">Welcome To ArrafiStore</h2>
            <p class="mb-3 text-sm">Daftar sekarang dan nikmati berbagai promo menarik!</p>
            <a href="{{ route('register') }}" class="border border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-900 transition">
                Register
            </a>
        </div>
    </div>

</body>
</html>
