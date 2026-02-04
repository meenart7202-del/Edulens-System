<?php
include "db.php";

$data = mysqli_query($conn,"
SELECT u.full_name,c.class_name,s.subject_name,d.level_name,f.feedback_date
FROM feedback f
JOIN users u ON f.user_id=u.user_id
JOIN classes c ON f.class_id=c.class_id
JOIN subjects s ON f.subject_id=s.subject_id
JOIN difficulty_levels d ON f.difficulty_id=d.difficulty_id
");
?>

<h2>Teacher Dashboard</h2>

<table border="1">
<tr>
<th>Student</th>
<th>Class</th>
<th>Subject</th>
<th>Difficulty</th>
<th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $row['full_name'] ?></td>
<td><?= $row['class_name'] ?></td>
<td><?= $row['subject_name'] ?></td>
<td><?= $row['level_name'] ?></td>
<td><?= $row['feedback_date'] ?></td>
</tr>
<?php } ?>
</table>
