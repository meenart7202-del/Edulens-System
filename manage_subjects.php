<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "Teacher") {
    header("Location: index.php");
    exit();
}

/* ADD SUBJECT */
if (isset($_POST['add'])) {
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    mysqli_query($conn, "INSERT INTO subjects (subject_name) VALUES ('$subject')");
}

/* DELETE SUBJECT (only if no topics) */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    // Check if subject has topics
    $check = mysqli_query($conn, "SELECT * FROM topics WHERE subject_id = $id");

    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "DELETE FROM subjects WHERE subject_id = $id");
    } else {
        $error = "You cannot delete a subject that has topics. Delete the topics first.";
    }
}

$subjects = mysqli_query($conn, "SELECT * FROM subjects");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Subjects</title>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="p-10 bg-[#f5eee9]">

<h1 class="text-2xl font-bold mb-6">Manage Subjects</h1>

<?php if (isset($error)) { ?>
<div class="bg-red-100 text-red-700 p-3 rounded mb-4">
    <?= $error ?>
</div>
<?php } ?>

<form method="post" class="flex gap-4 mb-6">
    <input name="subject" required placeholder="Subject Name"
           class="border p-2 rounded w-64">
    <button name="add"
            class="bg-green-600 text-white px-4 py-2 rounded">
        Add Subject
    </button>
</form>

<table class="bg-white rounded shadow w-full">
<thead class="bg-gray-100">
<tr>
    <th class="p-3 text-left">Subject Name</th>
    <th class="p-3 text-right">Action</th>
</tr>
</thead>

<tbody>
<?php while ($s = mysqli_fetch_assoc($subjects)) { ?>
<tr class="border-b">
    <td class="p-3"><?= $s['subject_name'] ?></td>
    <td class="p-3 text-right">
        <a href="?delete=<?= $s['subject_id'] ?>"
           onclick="return confirm('Are you sure?')"
           class="text-red-600 hover:underline">
           Delete
        </a>
    </td>
</tr>
<?php } ?>
</tbody>
</table>

</body>
</html>
