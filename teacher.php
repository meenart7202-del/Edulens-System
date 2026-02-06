<?php
// teacher.php
session_start();
include "db.php";

/* easy /medium/hard*/
$easy = 0;
$medium = 0;
$hard = 0;

$levelQuery = mysqli_query($conn,"
    SELECT d.difficulty_id, COUNT(f.feedback_id) AS total
    FROM feedback f
    JOIN difficulty_levels d 
        ON f.difficulty_id = d.difficulty_id
    GROUP BY d.difficulty_id
");

if($levelQuery){
    while($row = mysqli_fetch_assoc($levelQuery)){
        if($row['difficulty_id'] == 1){
            $easy = $row['total'];
        }elseif($row['difficulty_id'] == 2){
            $medium = $row['total'];
        }elseif($row['difficulty_id'] == 3){
            $hard = $row['total'];
        }
    }
}

/*students list*/
$students = mysqli_query($conn,"
    SELECT 
        u.full_name,
        c.class_name
    FROM feedback f
    JOIN users u 
        ON f.user_id = u.user_id
    JOIN roles r 
        ON u.role_id = r.role_id
    JOIN classes c 
        ON f.class_id = c.class_id
    WHERE r.role_name = 'Student'
    GROUP BY u.user_id, c.class_id
    ORDER BY u.full_name ASC
");

/* Feedback table*/
$feedbacks = mysqli_query($conn,"
    SELECT
        u.full_name,
        c.class_name,
        s.subject_name,
        GROUP_CONCAT(t.topic_name SEPARATOR ', ') AS topic_name,
        d.level_name,
        
        f.feedback_date,
        f.comment
    FROM feedback f
    JOIN users u 
        ON f.user_id = u.user_id
    JOIN roles r 
        ON u.role_id = r.role_id
    JOIN classes c 
        ON f.class_id = c.class_id
    JOIN subjects s 
        ON f.subject_id = s.subject_id
    LEFT JOIN feedback_topics ft
        ON f.feedback_id = ft.feedback_id
    LEFT JOIN topics t
        ON ft.topic_id = t.topic_id
    JOIN difficulty_levels d 
        ON f.difficulty_id = d.difficulty_id
    WHERE r.role_name = 'Student'
    GROUP BY f.feedback_id
    ORDER BY f.feedback_date DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Teacher Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<style>
#sidebar { transition: transform .3s ease; }
</style>
</head>

<body class="bg-[#f5eee9] min-h-screen font-sans flex">

<!-- side bar -->
<aside id="sidebar"
class="fixed inset-y-0 left-0 w-64 bg-[#8b5e3c] text-white
transform -translate-x-full md:translate-x-0 z-50">

<div class="p-6 text-2xl font-bold border-b border-white/30">
📘 Teacher Panel
</div>

<nav class="p-4 space-y-3">
<a href="teacher.php" class="block px-4 py-2 rounded hover:bg-white/20">Dashboard</a>
<a href="#students" class="block px-4 py-2 rounded hover:bg-white/20">Students</a>
<a href="manage_subjects.php" class="block px-4 py-2 rounded hover:bg-white/20">Subjects</a>
<a href="manage_topics.php" class="block px-4 py-2 rounded hover:bg-white/20">Topics</a>
<a href="logout.php" class="block px-4 py-2 rounded hover:bg-white/20">Log out</a>
</nav>
</aside>

<!-- main content -->
<div class="flex-1 md:ml-64 p-6">

<!-- top bar -->
<div class="flex justify-between items-center mb-6">
<button onclick="toggleSidebar()" 
class="md:hidden bg-[#8b5e3c] text-white px-4 py-2 rounded">
☰ Menu
</button>
<h1 class="text-3xl font-bold text-[#8b5e3c]">
Teacher Dashboard
</h1>
</div>

<!-- stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
<div class="bg-white p-6 rounded-xl shadow">
<p class="text-gray-500">Easy</p>
<h2 class="text-3xl font-bold text-green-600"><?= $easy ?></h2>
</div>

<div class="bg-white p-6 rounded-xl shadow">
<p class="text-gray-500">Medium</p>
<h2 class="text-3xl font-bold text-yellow-600"><?= $medium ?></h2>
</div>

<div class="bg-white p-6 rounded-xl shadow">
<p class="text-gray-500">Hard</p>
<h2 class="text-3xl font-bold text-red-600"><?= $hard ?></h2>
</div>
</div>

<!-- students list -->
<div id="students" class="bg-white rounded-xl shadow p-6 mb-10">
<h2 class="text-xl font-bold text-[#8b5e3c] mb-4">
Students in Your Classes
</h2>

<table class="min-w-full">
<thead class="bg-[#8b5e3c]/20">
<tr>
<th class="px-4 py-2 text-left">Student</th>
<th class="px-4 py-2 text-left">Class</th>
</tr>
</thead>
<tbody>
<?php if($students && mysqli_num_rows($students) > 0){ ?>
<?php while($s = mysqli_fetch_assoc($students)){ ?>
<tr class="border-b hover:bg-[#f3e6d8]">
<td class="px-4 py-2"><?= $s['full_name'] ?></td>
<td class="px-4 py-2"><?= $s['class_name'] ?></td>
</tr>
<?php } } else { ?>
<tr>
<td colspan="2" class="px-4 py-2 text-center text-red-500">
No students found
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<!-- feedback table -->
<div class="bg-white rounded-xl shadow p-6">
<h2 class="text-xl font-bold text-[#8b5e3c] mb-4">
Student Subject & Difficulty Feedback
</h2>

<table class="min-w-full">
<thead class="bg-[#8b5e3c]/20">
<tr>
<th class="px-4 py-2">Student</th>
<th class="px-4 py-2">Class</th>
<th class="px-4 py-2">Subject</th>
<th class="px-6 py-2">Topics</th>
<th class="px-4 py-2">Difficulty</th>
<th class="px-4 py-2">Date</th>
<th class="px-4 py-2">Comment</th>
</tr>
</thead>
<tbody>
<?php if($feedbacks && mysqli_num_rows($feedbacks) > 0){ ?>
<?php while($f = mysqli_fetch_assoc($feedbacks)){ ?>
<tr class="border-b hover:bg-[#f3e6d8]">
<td class="px-4 py-2"><?= $f['full_name'] ?></td>
<td class="px-4 py-2"><?= $f['class_name'] ?></td>
<td class="px-4 py-2"><?= $f['subject_name'] ?></td>
<td class="px-4 py-2"><?= $f['topic_name'] ?></td>
<td class="px-4 py-2"><?= $f['level_name'] ?></td>
<td class="px-4 py-2"><?= $f['feedback_date'] ?></td>
<td class="px-4 py-2"><?= $f['comment'] ?></td>

</tr>
<?php } } else { ?>
<tr>
<td colspan="5" class="px-4 py-2 text-center text-red-500">
No feedback data found
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

</div>

<script>
function toggleSidebar(){
    document.getElementById('sidebar')
        .classList.toggle('-translate-x-full');
}
</script>

</body>
</html>
