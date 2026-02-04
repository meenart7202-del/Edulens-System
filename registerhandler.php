<?php
// DB CONNECTION
$host = "localhost";
$user = "root";
$password = "";
$dbname = "edulens";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// CHECK IF FORM SUBMITTED
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // GET FORM DATA
    $full_name = trim($_POST['full_name']);
    $username  = trim($_POST['username']);
    $password  = $_POST['password'];
    $role_id   = $_POST['role_id'];

    // BASIC VALIDATION
    if (empty($full_name) || empty($username) || empty($password) || empty($role_id)) {
        header("Location: register.php?error=All fields are required");
        exit();
    }

    // CHECK IF USERNAME EXISTS
    $checkUser = "SELECT user_id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $checkUser);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: register.php?error=Username already exists");
        exit();
    }

    mysqli_stmt_close($stmt);


    // INSERT USER
    $insert = "INSERT INTO users (full_name, username, password, role_id)
               VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($stmt, "sssi",
        $full_name,
        $username,
        $password,
        $role_id
    );

    if (mysqli_stmt_execute($stmt)) {
        // SUCCESS → REDIRECT TO LOGIN
        header("Location: index.php?success=Account created successfully");
        exit();
    } else {
        header("Location: register.php?error=Something went wrong");
        exit();
    }
}

// CLOSE CONNECTION
mysqli_close($conn);
?>
