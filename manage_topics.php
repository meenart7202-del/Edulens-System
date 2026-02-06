<?php
session_start();
include "db.php";
if($_SESSION['role']!=="Teacher") header("Location:index.php");

if(isset($_POST['add'])){
mysqli_query($conn,"INSERT INTO topics(topic_name,subject_id)
VALUES('".$_POST['topic']."','".$_POST['subject']."')");
}

$subjects=mysqli_query($conn,"SELECT * FROM subjects");
$topics=mysqli_query($conn,"
SELECT t.topic_id,t.topic_name,s.subject_name
FROM topics t JOIN subjects s ON t.subject_id=s.subject_id");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Topics</title>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="p-10 bg-[#f5eee9]">

<h1 class="text-2xl font-bold mb-6">Manage Topics</h1>

<form method="post" class="flex gap-4 mb-6">
<input name="topic" required class="border p-2 rounded">
<select name="subject" class="border p-2 rounded">
<?php while($s=mysqli_fetch_assoc($subjects)){ ?>
<option value="<?= $s['subject_id'] ?>"><?= $s['subject_name'] ?></option>
<?php } ?>
</select>
<button name="add" class="bg-green-600 text-white px-4 py-2 rounded">Add</button>
</form>

<table class="bg-white rounded shadow w-full">
<?php while($t=mysqli_fetch_assoc($topics)){ ?>
<tr class="border-b">
<td class="p-4"><?= $t['topic_name'] ?></td>
<td class="p-4"><?= $t['subject_name'] ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>
