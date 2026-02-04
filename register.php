<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | EduLens</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br from-[#cbb59b] to-[#efe3d3] font-sans">

    <!-- CARD -->
    <div class="w-[900px] h-[550px] bg-white rounded-[30px]
                shadow-[0_10px_30px_rgba(0,0,0,0.25)]
                flex overflow-hidden">

        <!-- LEFT IMAGE -->
        <div class="w-[45%] bg-[#8b5e3c] flex items-center justify-center">
            <img src="woman.png" alt="student"
                 class="w-full h-full object-cover">
        </div>

        <!-- RIGHT FORM -->
        <form action="registerhandler.php" method="POST"
              class="w-[55%] p-[50px] flex flex-col justify-center">

            <h1 class="text-3xl font-bold text-purple-700 mb-2">
                Create Account
            </h1>
            <p class="text-sm text-gray-500 mb-6">
                Join Digital Subject Difficulty Analyzer
            </p>

            <!-- Full Name -->
            <label class="text-sm mb-1">Full Name</label>
            <input type="text" name="full_name" required
                   placeholder="Enter your full name"
                   class="w-full p-2 mb-4 rounded-md border border-gray-300
                          focus:outline-none focus:ring-2 focus:ring-purple-400">

            <!-- Username -->
            <label class="text-sm mb-1">Username</label>
            <input type="text" name="username" required
                   placeholder="Choose a username"
                   class="w-full p-2 mb-4 rounded-md border border-gray-300
                          focus:outline-none focus:ring-2 focus:ring-purple-400">

            <!-- Password -->
            <label class="text-sm mb-1">Password</label>
            <input type="password" name="password" required
                   placeholder="Create a password"
                   class="w-full p-2 mb-4 rounded-md border border-gray-300
                          focus:outline-none focus:ring-2 focus:ring-purple-400">

            <!-- Role -->
            <label class="text-sm mb-1">Role</label>
            <select name="role_id" required
                    class="w-full p-2 mb-6 rounded-md border border-gray-300
                           focus:outline-none focus:ring-2 focus:ring-purple-400">
                <option value="">Select role</option>
                <option value="1">Student</option>
                <option value="2">Teacher</option>
                <option value="3">Admin</option>
            </select>

            <!-- Button -->
            <button type="submit"
                    class="w-full py-2 rounded-lg bg-fuchsia-600 text-white
                           font-semibold hover:bg-purple-700 transition">
                Register
            </button>

            <!-- Error / Success -->
            <p class="text-red-500 text-sm mt-3">
                <?php
                if (isset($_GET['error'])) {
                    echo $_GET['error'];
                }
                ?>
            </p>

            <p class="text-sm text-gray-600 mt-4 text-center">
                Already have an account?
                <a href="index.php" class="text-purple-600 font-semibold hover:underline">
                    Login
                </a>
            </p>

        </form>
    </div>

</body>
</html>
