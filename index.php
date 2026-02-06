<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br from-[#cbb59b] to-[#efe3d3] font-sans">

    <!-- FORM (800 x 500) -->
    <form action="loginhandler.php" method="POST"
          class="w-[800px] h-[500px] bg-white rounded-[30px]
                 shadow-[0_10px_25px_rgba(0,0,0,0.2)]
                 flex gap-[80px] p-[40px]">

        <!-- LEFT (70%) -->
        <div class="w-[70%] flex flex-col justify-center text-left">

            <h1 class="text-2xl font-bold text-purple-700 mb-4">
                Digital School Subject Difficulty Analyzer
            </h1>

            <label class="text-sm mb-1">Username</label>
            <input type="text" name="username" required
                   placeholder="Enter your username"
                   class="w-[95%] p-2 mb-3 rounded-md border border-gray-300
                          focus:outline-none focus:ring-2 focus:ring-purple-400">

            <label class="text-sm mb-1">Password</label>
            <input type="password" name="password" required
                   placeholder="Password"
                   class="w-[95%] p-2 mb-4 rounded-md border border-gray-300
                          focus:outline-none focus:ring-2 focus:ring-purple-400">

            <button type="submit"
                    class="w-full py-2 rounded-lg bg-fuchsia-600 text-white
                           font-semibold hover:bg-purple-700 transition">
                Login
            </button>

            <!-- Error -->
            <p class="text-red-500 text-sm mt-3">
                <?php
                if (isset($_GET['error'])) {
                    echo "Invalid username or password";
                }
                ?>
            </p>

            <p class="text-sm text-gray-600 mt-4 text-center">
                Don't have an account?
                <a href="register.php" class="text-purple-600 font-semibold hover:underline">
                    Register
                </a>
            </p>
        </div>

        <!-- RIGHT IMAGE (400 x 500) -->
        <div class="w-[400px] h-[500px] -mt-[40px] -mr-[40px]
                    bg-[#8b5e3c] rounded-[30px]
                    flex items-center justify-center">

            <img src="woman.png" alt="woman holding books"
                 class="w-full h-full object-cover rounded-[30px]">
        </div>

    </form>

</body>
</html>
