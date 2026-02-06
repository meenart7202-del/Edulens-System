<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== "Student") {
    header("Location: index.php");
    exit();
}
include "db.php";

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#f5eee9] min-h-screen flex font-sans">

<!-- SIDEBAR -->
<aside class="w-64 bg-[#8b5e3c] text-white min-h-screen p-6 hidden md:block">
    <h2 class="text-2xl font-bold mb-8">Student Panel</h2>
    <nav class="space-y-4">
        <a href="#info" class="block hover:text-yellow-200">Student Information</a>
        <a href="logout.php" class="block text-red-200 font-semibold">Log out</a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<main class="flex-1 p-8">

 <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#8b5e3c]">
                Student Feedback Form
            </h1>
            <p class="mt-2 text-[#6b4a35]">
                Please fill honestly to help improve teaching quality
            </p>
        </div>

<!-- Form -->
<form action="submit_feedback.php" method="POST" class="space-y-8">

    <!-- Student Information-->
    <div id="info" class="grid md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">
                Full Name
            </label>
            <input type="text" name="fullname" required
            placeholder="Full Name"
            class="w-full rounded-lg border border-[#d8c3b5] p-2
            focus:outline-none focus:ring-2 focus:ring-[#8b5e3c]">
        </div>
        <div>
            <label>Class</label>
            <select name="class_id" required class="w-full p-2 rounded-lg border">
                <option value="">-- Select Class --</option>
                <option value="1">Form One</option>
                <option value="2">Form Two</option>
                <option value="3">Form Three</option>
                <option value="4">Form Four</option>
            </select>
        </div>
        <div>
                <label class="block text-sm font-medium mb-1">
                     Academic Year
                </label>
                <input type="text" name="year" placeholder="2024" required
                        class="w-full rounded-lg border border-[#d8c3b5] p-2
                            focus:outline-none focus:ring-2 focus:ring-[#8b5e3c]">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">
                Date
            </label>
            <input type="date" name="date" required
                    class="w-full rounded-lg border border-[#d8c3b5] p-2
                        focus:outline-none focus:ring-2 focus:ring-[#8b5e3c]">
        </div>
    </div>

     <!-- Subject -->
            <div class="bg-[#f9f4f0] p-6 rounded-xl">
                <h2 class="text-xl font-semibold text-[#8b5e3c] mb-4">
                    Select Subject
                </h2>

                <select name="subject_id" onchange="loadTopics(this.value)" required
                        class="w-full rounded-lg border border-[#d8c3b5] p-2
                               focus:outline-none focus:ring-2 focus:ring-[#8b5e3c]">
                    <option value="">-- Select Subject --</option>
                    <option value="1">Physics</option>
                    <option value="2">Mathematics</option>
                    <option value="3">Chemistry</option>
                    <option value="4">Biology</option>
                    <option value="5">English</option>
                    <option value="6">Geography</option>
                    <option value="7">Kiswahili</option>
                    <option value="8">Civics</option>
                    <option value="9">History</option>
                    <option value="10">Bookkeeping</option>
                </select>
            </div>

            <!-- Difficult Topics -->
            <div class="bg-[#f9f4f0] p-6 rounded-xl">
                <h2 class="text-xl font-semibold text-[#8b5e3c] mb-4">
                    Difficult Topics
                </h2>

                <div id="topicsBox" class="italic text-[#6b4a35]">
                    Select subject first
                </div>
            </div>

            <!-- Difficulty Level -->
            <div class="bg-[#f9f4f0] p-6 rounded-xl">
                <h2 class="text-xl font-semibold text-[#8b5e3c] mb-4">
                    Difficulty Level
                </h2>

                <div class="flex gap-6">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="difficulty_id" value="1" required>
                        Easy
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="difficulty_id" value="2">
                        Medium
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="difficulty_id" value="3">
                        Hard
                    </label>
                </div>
            </div>

            <!-- Comment -->
            <div class="bg-[#f9f4f0] p-6 rounded-xl">
                <h2 class="text-xl font-semibold text-[#8b5e3c] mb-4">
                    Comment (Optional)
                </h2>

                <textarea name="comment" rows="4"
                          placeholder="Write your comment here..."
                          class="w-full rounded-lg border border-[#d8c3b5] p-2
                                 focus:outline-none focus:ring-2 focus:ring-[#8b5e3c]"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                        class="bg-[#8b5e3c] text-white px-8 py-3 rounded-xl font-semibold
                               hover:bg-[#6b442a] transition duration-300 shadow-lg">
                    Submit Feedback
                </button>
            </div>
</form>

</main>
<script src="script.js"></script>
</body>
</html>
