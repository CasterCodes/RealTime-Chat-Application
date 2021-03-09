const passwordField = document.querySelector(".password");
const confirmPasswordField = document.querySelector(".confirm-password");

const handlePassBtn = document.querySelector(".form form .pass-icon");
const handleConfirmPassBtn = document.querySelector(
  ".form form  .confirm-pass-icon"
);

const handlePasswordType = (input) => {
  input.type === "password" ? (input.type = "text") : (input.type = "password");
};

// Event listeners
handlePassBtn.addEventListener("click", (e) => {
  handlePassBtn.classList.toggle("active");
  handlePasswordType(passwordField);
});

if (document.location.href.split("/").slice(-1).join("") === "index.php") {
  handleConfirmPassBtn.addEventListener("click", (e) => {
    handleConfirmPassBtn.classList.toggle("active");
    handlePasswordType(confirmPasswordField);
  });
}
