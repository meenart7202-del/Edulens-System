<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard">
        <h2>Headmaster</h2>

        <div class="admin-cards">
            <div class="card-box">
                <h4>Total Students</h4>
                <p id="totalStudents">0</p>
            </div>
            
            <div class="card-box">
                <h4>Most Difficulty Subject</h4>
                <p id="hardSubject"></p>
            </div>
        </div>

        <button onclick="loadAdmin()">Analyzing</button>
    </div>
    <script src="script.js"></script>
</body>
</html>