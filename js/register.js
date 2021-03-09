const form = document.querySelector(".signup form"),
  submitBtn = document.querySelector(".signup .button input"),
  errorMessage = document.querySelector(".error-text");
const firstName = document.querySelector("#first-name"),
  lastName = document.querySelector("#last-name"),
  email = document.querySelector("#email"),
  password = document.querySelector("#password"),
  photo = document.querySelector("input[type='file']"),
  confirmPassword = document.querySelector("#confirm-password"),
  submit = document.querySelector("#submit");

// Form data
let data = new FormData(form);
const loadFormData = (inputs) => {
  for (const name in inputs) {
    data.append(`${name}`, inputs[name].value);
  }
  data.append("photo", photo.files[0]);
};

// send form data
const sendFormData = (e) => {
  loadFormData({
    firstName,
    lastName,
    email,
    password,
    confirmPassword,
    submit,
  });

  fetch("php/register.php", {
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
