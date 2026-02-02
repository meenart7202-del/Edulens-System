<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="loginhandler.php" method="POST">
        <div class="left">
            <h1>Edulens Login</h1>
            <label>Select your role</label>
            <select id="role">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select><br>

                <label>Username</label><br>
                <input type="text" id="name" placeholder="Enter your username"><br>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password"><br>

            <button >Login</button>

            <p id="msg"></p>
        </div>
        <div>
            <img src="woman.png" alt="woman hold books">
        </div>
    </form>
        <script src="script.js"></script>

</body>
</html>