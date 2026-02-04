<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== "Admin"){
    header("Location: index.php");
    exit();
}
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<!-- Tailwind CDN -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#f5eee9] min-h-screen font-sans p-6">

<!-- Header -->
<div class="max-w-7xl mx-auto mb-8 text-center">
    <h1 class="text-3xl font-bold text-[#8b5e3c] mb-2">Headmaster Dashboard</h1>
    <p class="text-[#6b4a35] font-semibold">Overview of Students and Subjects</p>
</div>

<?php
$total_students = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE role_id=1"));

$subject_hard = mysqli_query($conn,"SELECT s.subject_name, COUNT(*) as cnt 
FROM feedback f
JOIN subjects s ON f.subject_id=s.subject_id
JOIN difficulty_levels d ON f.difficulty_id=d.difficulty_id
WHERE d.level_name='Hard'
GROUP BY s.subject_name
ORDER BY cnt DESC
LIMIT 1");

$hard_subject_name = mysqli_fetch_assoc($subject_hard)['subject_name'];
?>

<!-- Cards Container -->
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Total Students Card -->
    <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center justify-center">
        <h4 class="text-xl font-semibold text-[#8b5e3c] mb-2">Total Students</h4>
        <p class="text-3xl font-bold text-[#6b4a35]"><?php echo $total_students; ?></p>
    </div>

    <!-- Most Difficult Subject Card -->
    <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center justify-center">
        <h4 class="text-xl font-semibold text-[#8b5e3c] mb-2">Most Difficult Subject</h4>
        <p class="text-3xl font-bold text-[#6b4a35]"><?php echo $hard_subject_name; ?></p>
    </div>

</div>

</body>
</html>
