const form = document.querySelector(".login form"),
  submitBtn = document.querySelector(".login .button input"),
  errorMessage = document.querySelector(".error-text");
const email = document.querySelector("#email"),
  password = document.querySelector("#password"),
  submit = document.querySelector("#submit");

console.log();

// Form data
let data = new FormData(form);
const loadFormData = (inputs) => {
  for (const name in inputs) {
    data.append(`${name}`, inputs[name].value);
  }
};

// send form data
const sendFormData = (e) => {
  loadFormData({
    email,
    password,
    submit,
  });

  fetch("php/login.php", {
    method: "POST",
    header: {
      "Content-Type": "multipart/form-data",
    },
    body: data,
  })
    .then((data) => data.text())
    .then((data) => {
      if (data === "success") {
        location.href = "users.php";
      } else {
        console.log(data);
        errorMessage.style.display = "block";
        errorMessage.innerHTML = data;
      }
    });
};

// event listeners
form.addEventListener("submit", (e) => e.preventDefault());
submitBtn.addEventListener("click", sendFormData);
