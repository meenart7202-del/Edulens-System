<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== "Admin"){
    header("Location: index.php");
    exit();
}
include "db.php";

/* COUNTS */
$total_students = mysqli_num_rows(mysqli_query($conn,"SELECT user_id FROM users WHERE role_id=1"));
$total_teachers = mysqli_num_rows(mysqli_query($conn,"SELECT user_id FROM users WHERE role_id=2"));

$hard_q = mysqli_query($conn,"
SELECT s.subject_name, COUNT(*) cnt
FROM feedback f JOIN subjects s ON f.subject_id=s.subject_id
WHERE f.difficulty_id=3
GROUP BY s.subject_name
ORDER BY cnt DESC LIMIT 1");
$hard = mysqli_fetch_assoc($hard_q);
$hard_subject = $hard ? $hard['subject_name'] : "N/A";

/* FETCH DATA */
$students = mysqli_query($conn,"SELECT * FROM users WHERE role_id=1");
$teachers = mysqli_query($conn,"SELECT * FROM users WHERE role_id=2");
$subjects = mysqli_query($conn,"SELECT * FROM subjects");
$topics = mysqli_query($conn,"
SELECT t.topic_id,t.topic_name,s.subject_name
FROM topics t JOIN subjects s ON t.subject_id=s.subject_id");

/* ACTIONS */
if(isset($_POST['add_student'])){
    mysqli_query($conn,"INSERT INTO users(full_name,username,password,role_id)
    VALUES('$_POST[name]','$_POST[username]','".password_hash($_POST['password'],PASSWORD_DEFAULT)."',1)");
}
if(isset($_POST['add_teacher'])){
    mysqli_query($conn,"INSERT INTO users(full_name,username,password,role_id)
    VALUES('$_POST[name]','$_POST[username]','".password_hash($_POST['password'],PASSWORD_DEFAULT)."',2)");
}
if(isset($_GET['delete_user'])){
    mysqli_query($conn,"DELETE FROM users WHERE user_id=".$_GET['delete_user']);
}
if(isset($_POST['add_subject'])){
    mysqli_query($conn,"INSERT INTO subjects(subject_name) VALUES('$_POST[subject]')");
}
if(isset($_GET['delete_subject'])){
    mysqli_query($conn,"DELETE FROM subjects WHERE subject_id=".$_GET['delete_subject']);
}
if(isset($_POST['add_topic'])){
    mysqli_query($conn,"INSERT INTO topics(topic_name,subject_id)
    VALUES('$_POST[topic]',$_POST[subject_id])");
}
if(isset($_GET['delete_topic'])){
    mysqli_query($conn,"DELETE FROM topics WHERE topic_id=".$_GET['delete_topic']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#f5eee9] min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-72 bg-[#8b5e3c] text-white flex flex-col fixed h-full shadow-2xl">
    <div class="p-6 border-b border-white/20">
        <h2 class="text-2xl font-extrabold tracking-wide">Admin Panel</h2>
        <p class="text-sm text-white/80">Education System</p>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 text-sm font-medium">
        <a href="#dashboard" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition">📊 Dashboard</a>
        <a href="#students" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition">🎓 Students</a>
        <a href="#teachers" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition">👨‍🏫 Teachers</a>
        <a href="#subjects" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition">📚 Subjects</a>
        <a href="#topics" class="block px-4 py-3 rounded-lg hover:bg-white/20 transition">🧩 Topics</a>
    </nav>

    <div class="p-4 border-t border-white/20">
        <a href="logout.php"
           class="block w-full text-center bg-[#8b5e3c] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#6b442a] transition duration-300 shadow-lg">
           Log out
        </a>
    </div>
</aside>

<!-- MAIN -->
<main class="ml-72 flex-1 p-8">

<!-- DASHBOARD -->
<section id="dashboard" class="mb-10">
    <h1 class="text-3xl font-bold text-[#8b5e3c] mb-2">Headmaster Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <p class="text-sm">Total Students</p>
            <h2 class="text-3xl font-bold"><?= $total_students ?></h2>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <p class="text-sm">Total Teachers</p>
            <h2 class="text-3xl font-bold"><?= $total_teachers ?></h2>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow text-center">
            <p class="text-sm">Most Difficult Subject</p>
            <h2 class="text-xl font-bold"><?= $hard_subject ?></h2>
        </div>
    </div>
</section>

<!-- STUDENTS -->
<section id="students" class="mb-10">
<h2 class="section-title">Students</h2>
<form method="POST" class="flex gap-2 mb-3">
<input name="name" placeholder="Full name" class="border p-2 rounded w-1/3" required>
<input name="username" placeholder="Username" class="border p-2 rounded w-1/3" required>
<input name="password" type="password" placeholder="Password" class="border p-2 rounded w-1/3" required>
<button name="add_student" class="bg-green-600 text-white px-4 rounded">Add</button>
</form>
<?php while($s=mysqli_fetch_assoc($students)){ ?>
<div class="bg-white rounded-lg shadow p-3 mb-2 flex justify-between">
<?= $s['full_name'] ?>
<a href="?delete_user=<?= $s['user_id'] ?>" class="text-red-600">Delete</a>
</div>
<?php } ?>
</section>

<!-- TEACHERS -->
<section id="teachers" class="mb-10">
<h2 class="section-title">Teachers</h2>
<form method="POST" class="flex gap-2 mb-3">
<input name="name" placeholder="Full name" class="border p-2 rounded w-1/3" required>
<input name="username" placeholder="Username" class="border p-2 rounded w-1/3" required>
<input name="password" type="password" placeholder="Password" class="border p-2 rounded w-1/3" required>
<button name="add_teacher" class="bg-green-600 text-white px-4 rounded">Add</button>
</form>
<?php while($t=mysqli_fetch_assoc($teachers)){ ?>
<div class="bg-white rounded-lg shadow p-3 mb-2 flex justify-between">
<?= $t['full_name'] ?>
<a href="?delete_user=<?= $t['user_id'] ?>" class="text-red-600">Delete</a>
</div>
<?php } ?>
</section>

<!-- SUBJECTS -->
<section id="subjects" class="mb-10">
<h2 class="section-title">Subjects</h2>
<form method="POST" class="flex gap-2 mb-3">
<input name="subject" placeholder="Subject name" class="border p-2 rounded w-full" required>
<button name="add_subject" class="bg-green-600 text-white px-6 rounded">Add</button>
</form>
<?php while($sub=mysqli_fetch_assoc($subjects)){ ?>
<div class="bg-white rounded-lg shadow p-3 mb-2 flex justify-between">
<?= $sub['subject_name'] ?>
<a href="?delete_subject=<?= $sub['subject_id'] ?>" class="text-red-600">Delete</a>
</div>
<?php } ?>
</section>

<!-- TOPICS -->
<section id="topics">
<h2 class="section-title">Topics</h2>
<form method="POST" class="grid grid-cols-3 gap-2 mb-3">
<input name="topic" placeholder="Topic name" class="border p-2 rounded" required>
<select name="subject_id" class="border p-2 rounded">
<?php mysqli_data_seek($subjects,0); while($s=mysqli_fetch_assoc($subjects)){ ?>
<option value="<?= $s['subject_id'] ?>"><?= $s['subject_name'] ?></option>
<?php } ?>
</select>
<button name="add_topic" class="bg-green-600 text-white rounded">Add</button>
</form>

<?php while($tp=mysqli_fetch_assoc($topics)){ ?>
<div class="bg-white rounded-lg shadow p-3 mb-2 flex justify-between">
<?= $tp['topic_name'] ?> (<?= $tp['subject_name'] ?>)
<a href="?delete_topic=<?= $tp['topic_id'] ?>" class="text-red-600">Delete</a>
</div>
<?php } ?>
</section>

</main>
</body>
</html>
