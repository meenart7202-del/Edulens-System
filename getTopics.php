<?php
include "db.php";

if (!isset($_GET['subject_id'])) {
    exit;
}

$subject_id = intval($_GET['subject_id']);

$sql = "SELECT topic_id, topic_name FROM topics WHERE subject_id = $subject_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<p>No topics found</p>";
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {
    echo '
        <label class="flex items-center gap-2 mb-2">
            <input type="checkbox" name="topics[]" value="'.$row['topic_id'].'">
            '.$row['topic_name'].'
        </label>
    ';
}
