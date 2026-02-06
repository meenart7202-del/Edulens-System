<?php session_start(); include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Syllabus</title>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#f5eee9] p-6 max-w-3xl mx-auto">

<h2 class="text-2xl font-bold mb-4">Manage Subjects</h2>
<form method="POST" action="teacher_add_subject.php" class="flex gap-2 mb-4">
<input name="subject_name" class="border p-2 rounded flex-1">
<button class="bg-green-600 text-white px-4 rounded">Add</button>
</form>

<?php
$s=mysqli_query($conn,"SELECT * FROM subjects");
while($r=mysqli_fetch_assoc($s)){
echo "<div class='flex justify-between bg-white p-3 rounded mb-2'>
{$r['subject_name']}
<a href='teacher_delete_subject.php?id={$r['subject_id']}' class='text-red-600'>Delete</a>
</div>";
}
?>
</body>
</html>
