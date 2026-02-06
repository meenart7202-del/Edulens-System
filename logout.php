<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Logged Out</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Tailwind CDN -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<!-- Auto redirect after 3 seconds -->
<meta http-equiv="refresh" content="3;url=index.php">
</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br from-[#cbb59b] to-[#efe3d3] font-sans">

<div class="bg-white rounded-2xl shadow-xl p-10 text-center max-w-md">
    <h1 class="text-2xl font-bold text-[#8b5e3c] mb-4">
         Thanks for using EduLens
    </h1>

    <p class="text-[#6b4a35] text-lg mb-6">
        You're welcome again!  
        We hope to see you soon 
    </p>

    <p class="text-sm text-gray-500">
        Redirecting to login page...
    </p>

    <div class="mt-4 w-full bg-[#f3e6d8] rounded-full h-2 overflow-hidden">
        <div class="bg-[#8b5e3c] h-2 w-full animate-pulse"></div>
    </div>
</div>

</body>
</html>
