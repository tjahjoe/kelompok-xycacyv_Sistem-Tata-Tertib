document.addEventListener("DOMContentLoaded", () => {
  const togglePassword = document.querySelector(".toggle-password-icon");
  const passwordInput = document.getElementById("password");

  togglePassword.addEventListener("click", () => {
    // Toggle password visibility
    const isPasswordVisible = passwordInput.getAttribute("type") === "text";
    passwordInput.setAttribute("type", isPasswordVisible ? "password" : "text");

    // Toggle icon class
    togglePassword.classList.toggle("fa-eye", isPasswordVisible);
    togglePassword.classList.toggle("fa-eye-slash", !isPasswordVisible);
});
});