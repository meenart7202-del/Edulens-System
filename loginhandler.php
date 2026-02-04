<?php
session_start();
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT u.user_id, u.username, u.password, r.role_name
        FROM users u
        JOIN roles r ON u.role_id = r.role_id
        WHERE u.username = '$username' LIMIT 1";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){
    $user = mysqli_fetch_assoc($result);

    // Check password
    if($password === $user['password']){
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role_name'];

        if($user['role_name'] === "Student"){
            header("Location: student.php");
        } elseif($user['role_name'] === "Teacher"){
            header("Location: teacher.php");
        } elseif($user['role_name'] === "Admin"){
            header("Location: admin.php");
        }
        exit();
    } else {
        header("Location: index.php?error=1");
    }
} else {
    header("Location: index.php?error=1");
}
?>
