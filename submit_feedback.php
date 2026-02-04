<?php
session_start();
include "db.php";

$user_id = $_SESSION['user_id'];
$class_id = $_POST['class_id'];
$subject_id = $_POST['subject_id'];
$difficulty_id = $_POST['difficulty_id'];
$comment = $_POST['comment'];
$feedback_date = $_POST['date'];
$academic_year = $_POST['year'];
$topics = $_POST['topics'];

mysqli_query($conn,"INSERT INTO feedback (user_id,class_id,subject_id,difficulty_id,comment,feedback_date,academic_year)
VALUES ($user_id,$class_id,$subject_id,$difficulty_id,'$comment','$feedback_date','$academic_year')");

$feedback_id = mysqli_insert_id($conn);

foreach($topics as $topic_id){
    mysqli_query($conn,"INSERT INTO feedback_topics (feedback_id,topic_id) VALUES ($feedback_id,$topic_id)");
}

header("Location: student.php?success=1");
?>
