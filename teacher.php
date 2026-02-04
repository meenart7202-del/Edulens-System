<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== "Teacher"){
    header("Location: index.php");
    exit();
}
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Dashboard</title>

<!-- Tailwind CDN -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#f5eee9] min-h-screen font-sans p-6">

<!-- Header -->
<div class="max-w-7xl mx-auto mb-8">
    <h1 class="text-3xl font-bold text-[#8b5e3c] mb-2">Teacher Dashboard</h1>
    <p class="text-[#6b4a35]">View all student feedbacks</p>
</div>

<!-- Table Container -->
<div class="overflow-x-auto max-w-7xl mx-auto bg-white rounded-2xl shadow-xl p-6">

<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-[#8b5e3c]/20">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-[#8b5e3c] uppercase tracking-wider">Student</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-[#8b5e3c] uppercase tracking-wider">Class</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-[#8b5e3c] uppercase tracking-wider">Subject</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-[#8b5e3c] uppercase tracking-wider">Topics</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-[#8b5e3c] uppercase tracking-wider">Difficulty</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-[#8b5e3c] uppercase tracking-wider">Comment</th>
        </tr>
    </thead>

    <tbody class="bg-white divide-y divide-gray-200">
    <?php
    $sql = "SELECT f.feedback_id,u.full_name,c.class_name,s.subject_name,d.level_name,f.comment
    FROM feedback f
    JOIN users u ON f.user_id=u.user_id
    JOIN classes c ON f.class_id=c.class_id
    JOIN subjects s ON f.subject_id=s.subject_id
    JOIN difficulty_levels d ON f.difficulty_id=d.difficulty_id";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $feedback_id = $row['feedback_id'];
        $topics_res = mysqli_query($conn,"SELECT t.topic_name FROM feedback_topics ft JOIN topics t ON ft.topic_id=t.topic_id WHERE ft.feedback_id=$feedback_id");
        $topics_arr = [];
        while($t = mysqli_fetch_assoc($topics_res)){
            $topics_arr[] = $t['topic_name'];
        }
        $topics_str = implode(", ",$topics_arr);
        echo "<tr class='hover:bg-[#f3e6d8] transition'>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-[#6b4a35]'>".$row['full_name']."</td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-[#6b4a35]'>".$row['class_name']."</td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-[#6b4a35]'>".$row['subject_name']."</td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-[#6b4a35]'>".$topics_str."</td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-[#6b4a35]'>".$row['level_name']."</td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-[#6b4a35]'>".$row['comment']."</td>
        </tr>";
    }
    ?>
    </tbody>
</table>

</div>
</body>
</html>