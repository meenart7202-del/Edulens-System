<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== "Student"){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$class_id = $_POST['class_id'] ?? null;
$subject_id = $_POST['subject_id'] ?? null;
$difficulty_id = $_POST['difficulty_id'] ?? null;
$feedback_date = $_POST['date'] ?? null;
$academic_year = $_POST['year'] ?? null;
$comment = $_POST['comment'] ?? '';
$topics = $_POST['topics'] ?? [];

if(!$class_id || !$subject_id || !$difficulty_id || !$feedback_date || !$academic_year){
    die("All fields are required");
}

// Prevent duplicate feedback for same subject/date
$check = mysqli_query($conn,"SELECT * FROM feedback WHERE user_id=$user_id AND subject_id=$subject_id AND feedback_date='$feedback_date'");
if(mysqli_num_rows($check) > 0){
    die("You have already submitted feedback for this subject and date.");
}

// Insert feedback
mysqli_query($conn,"INSERT INTO feedback (user_id,class_id,subject_id,difficulty_id,comment,feedback_date,academic_year)
VALUES ($user_id,$class_id,$subject_id,$difficulty_id,'$comment','$feedback_date','$academic_year')");
$feedback_id = mysqli_insert_id($conn);

// Insert topics
foreach($topics as $topic_name){
    $topic_name_safe = mysqli_real_escape_string($conn,$topic_name);
    $topic_id_res = mysqli_query($conn,"SELECT topic_id FROM topics WHERE topic_name='$topic_name_safe' AND subject_id=$subject_id");
    if($topic_id_res && mysqli_num_rows($topic_id_res)){
        $topic_id = mysqli_fetch_assoc($topic_id_res)['topic_id'];
        mysqli_query($conn,"INSERT INTO feedback_topics (feedback_id, topic_id) VALUES ($feedback_id,$topic_id)");
    }
}

header("Location: student.php?success=1");
exit();
