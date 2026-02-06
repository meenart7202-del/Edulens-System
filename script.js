function loadTopics(subjectId) {

    const box = document.getElementById("topicsBox");

    if (subjectId === "") {
        box.innerHTML = "Select subject first";
        return;
    }

    fetch("getTopics.php?subject_id=" + subjectId)
        .then(response => response.text())
        .then(data => {
            box.innerHTML = data;
        })
        .catch(error => {
            box.innerHTML = "Error loading topics";
        });
}