//for login page
function login(){
    const role = document.getElementById("role").value;
    const msg = document.getElementById("msg");

    if(role === ""){
        msg.innerText = "Please select role!";
        msg.style.color = "red";
        return;
    }

    if(role === "Student"){
        window.location.href = "student.html";
    }
    if(role === "Teacher"){
        window.location.href = "teacher.html";
    }
    if(role === "Admin"){
        window.location.href = "admin.html";
    }
}

//for student page
let studentFeedback = [];

const topics = {
    Physics: ["Baenolli", "Friction"],
    Mathematics: ["Algebra", "Trigonometry" ,"Geometry"],
    Chemistry: ["Organic Chemistry", "Stoichiometry" ,"Acids and Bases"],
    Biology: ["Cell Biology", "Genetic" ,"Ecology"],
    English: ["Grammar", "Essay Writing" ,"Comprehension"],
    Geography: ["Map", "Trigonometry" ,"Geometry"],
    Kiswahili: ["Fasihi", "Insha" ,"Sarufi"],
    Civics: ["Human Right", "Gender", "Election"],
    History: ["Third World Wide", "Trigonometry", "Geometry"],
    Bookeeping: ["Algebra", "Trigonometry" ,"Geometry"]
};

function loadSubject(checkbox){
  const area = document.getElementById("feedbackArea");
  const subject = checkbox.value;

  if(checkbox.checked){
    let html = `
      <div class="subject-box" id="${subject}">
        <h4>${subject}</h4>

        <p><strong>Difficult Topics</strong></p>
        ${topics[subject].map(t =>
          `<label><input type="checkbox"> ${t}</label>`
        ).join("")}

        <p><strong>Difficulty Level</strong></p>
        <label><input type="radio" name="diff_${subject}"> Easy</label>
        <label><input type="radio" name="diff_${subject}"> Medium</label>
        <label><input type="radio" name="diff_${subject}"> Hard</label>

        <textarea placeholder="Comment for ${subject}"></textarea>
      </div>
    `;
    area.innerHTML += html;
  } else {
    document.getElementById(subject).remove();
  }
}

function submitForm(){

  //Student info
  const name = document.getElementById("name").value.trim();
  const cls = document.getElementById("class").value.trim();
  const year = document.getElementById("year").value.trim();
  const date = document.getElementById("date").value;

  if(!name || !cls || !year || !date){
    alert("Please fill your information");
    return;
  }

  //Subjects feedback
  const feedback = [];

  document.querySelectorAll(".subject-box").forEach(box => {
    const subject = box.id;

    // topics
    const selectedTopics = [];
    box.querySelectorAll("input[type='checkbox']:checked").forEach(t =>{
      selectedTopics.push(t.parentElement.innerText.trim());
    });

    // difficulty
    const diffInput = box.querySelector("input[type='radio']:checked");
    if(!diffInput || selectedTopics.length === 0){
      alert("Please complete feedback for " + subject);
      return;
    }

    const difficulty = diffInput.parentElement.innerText.trim();

    // comment
    const comment = box.querySelector("textarea").value;

    feedback.push({
      subject,
      topics: selectedTopics,
      difficulty,
      comment
    });
  });

  if(feedback.length === 0){
    alert("Please select at least one subject");
    return;
  }

  // 3. Save all
  studentFeedback.push({
    name,
    class: cls,
    year,
    date,
    feedback
  });

  alert("Thank you ,your information has been recorded ✅");

  // optional: collapse form
  document.getElementById("feedbackArea").innerHTML = "";
  document.querySelectorAll("input").forEach(i => i.checked = false);
}


//for teacher page
function loadTeacher(){
  const table = document.getElementById("teacherTable");
  table.innerHTML = "";

  if(studentFeedback.length === 0){
    table.innerHTML = `<tr><td colspan="6">No feedback yet</td></tr>`;
    return;
  }

  studentFeedback.forEach(s =>{
    s.feedback.forEach(f =>{
      table.innerHTML += `
        <tr>
          <td>${s.name}</td>
          <td>${s.class}</td>
          <td>${f.subject}</td>
          <td>${f.topics.join(", ")}</td>
          <td>${f.difficulty}</td>
          <td>${f.comment || "-"}</td>
        </tr>
      `;
    });
  });
}

//for admin page
function loadAdmin() {

  document.getElementById("totalStudents").innerText = studentFeedback.length;

  let subjectCount = {};

  studentFeedback.forEach(s => {
    s.feedback.forEach(f => {
      if (f.difficulty === "Hard") {
        subjectCount[f.subject] =
          (subjectCount[f.subject] || 0) + 1;
      }
    });
  });

  let max = 0;
  let hardSub = "-";

  for (let s in subjectCount) {
    if (subjectCount[s] > max) {
      max = subjectCount[s];
      hardSub = s;
    }
  }

  document.getElementById("hardSubject").innerText = hardSub;
}
