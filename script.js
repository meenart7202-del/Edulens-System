/***********************
 STUDENT PAGE
************************/

const topics = {
  Physics: ["Bernoulli", "Friction"],
  Mathematics: ["Algebra", "Trigonometry", "Geometry"],
  Chemistry: ["Organic Chemistry", "Acids and Bases"],
  Biology: ["Cell Biology", "Genetics", "Ecology"],
  English: ["Grammar", "Essay Writing"],
  Geography: ["Map Reading", "Climate"],
  Kiswahili: ["Fasihi", "Sarufi"],
  Civics: ["Human Rights", "Elections"],
  History: ["World War", "Independence"],
  Bookeeping: ["Ledger", "Trial Balance"]
};

// Load feedback form for the selected subject
function loadSubject(radio) {
  const area = document.getElementById("feedbackArea");
  const subject = radio.value;

  // Replace old feedback form with new one
  area.innerHTML = `
    <div class="subject-box">
      <h3>${subject}</h3>

      <p><strong>Difficult Topics</strong></p>
      ${topics[subject].map(t => `<label><input type="checkbox"> ${t}</label>`).join("")}

      <p><strong>Difficulty Level</strong></p>
      <label><input type="radio" name="difficulty"> Easy</label>
      <label><input type="radio" name="difficulty"> Medium</label>
      <label><input type="radio" name="difficulty"> Hard</label>

      <textarea placeholder="Comment (optional)"></textarea>
    </div>
  `;
}

// Submit the feedback
function submitForm() {
  const name = document.getElementById("name").value.trim();
  const cls = document.getElementById("class").value.trim();
  const year = document.getElementById("year").value.trim();
  const date = document.getElementById("date").value;
  const subjectRadio = document.querySelector("input[name='subject']:checked");

  if (!name || !cls || !year || !date || !subjectRadio) {
    alert("Please fill all fields and select a subject");
    return;
  }

  const box = document.querySelector(".subject-box");
  if (!box) {
    alert("Please give feedback for the selected subject");
    return;
  }

  // Get selected topics
  const selectedTopics = [];
  box.querySelectorAll("input[type='checkbox']:checked").forEach(t => {
    selectedTopics.push(t.parentElement.innerText.trim());
  });

  // Get difficulty
  const diffInput = box.querySelector("input[name='difficulty']:checked");
  if (selectedTopics.length === 0 || !diffInput) {
    alert("Please complete subject feedback");
    return;
  }

  const comment = box.querySelector("textarea").value;

  // Save feedback in localStorage
  const stored = JSON.parse(localStorage.getItem("studentFeedback")) || [];
  stored.push({
    name,
    class: cls,
    year,
    date,
    subject: subjectRadio.value,
    topics: selectedTopics,
    difficulty: diffInput.parentElement.innerText.trim(),
    comment
  });
  localStorage.setItem("studentFeedback", JSON.stringify(stored));

  alert("Thank you! Your feedback has been saved ✅");

  // Clear form for next input
  document.getElementById("feedbackArea").innerHTML = "";
  document.querySelectorAll("input").forEach(i => i.checked = false);
  document.getElementById("name").value = "";
  document.getElementById("class").value = "";
  document.getElementById("year").value = "";
  document.getElementById("date").value = "";
}
