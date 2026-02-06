<?php
session_start();
include "db.php";

if($_SESSION['role']!=="Admin") exit();

$teacher_id = $_POST['teacher_id'];
$comment = $_POST['comment'];
$admin_id = $_SESSION['user_id'];

mysqli_query($conn,"
INSERT INTO teacher_reviews(teacher_id,admin_id,comment)
VALUES($teacher_id,$admin_id,'$comment')
");

header("Location: admin.php");
