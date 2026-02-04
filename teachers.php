<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== "Teacher"){
    header("Location: index.php");
    exit();
}
include "db.php";

/* COUNTS FOR PIE CHART */
$easy = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS c FROM feedback WHERE difficulty_id=1"))['c'];

$medium = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS c FROM feedback WHERE difficulty_id=2"))['c'];

$hard = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) AS c FROM feedback WHERE difficulty_id=3"))['c'];

/* STUDENT LIST */
$students = mysqli_query($conn,"
SELECT DISTINCT u.full_name, c.class_name
FROM feedback f
JOIN users u ON f.user_id = u.user_id
JOIN classes c ON f.class_id = c.class_id
");

/* FEEDBACK TABLE */
$feedbacks = mysqli_query($conn,"
SELECT u.full_name,c.class_name,s.subject_name,d.level_name,f.feedback_date
FROM feedback f
JOIN users u ON f.user_id=u.user_id
JOIN classes c ON f.class_id=c.class_id
JOIN subjects s ON f.subject_id=s.subject_id
JOIN difficulty_levels d ON f.difficulty_id=d.difficulty_id
");

include "teacher.php";
?>
