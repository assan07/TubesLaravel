document.addEventListener("DOMContentLoaded", function () {
    // Toggle Password Visibility
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    togglePassword.addEventListener("click", function () {
        const type =
            password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        if (type === "password") {
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        } else {
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        }
    });

    // Form Submission with Loading
    const loginForm = document.getElementById("loginForm");
    const loginBtn = document.getElementById("loginBtn");
    const btnText = loginBtn.querySelector(".btn-text");
    const btnLoading = loginBtn.querySelector(".btn-loading");

    loginForm.addEventListener("submit", function () {
        loginBtn.disabled = true;
        btnText.classList.add("d-none");
        btnLoading.classList.remove("d-none");
    });

    // Auto-focus on first input
    document.getElementById("nim").focus();

    // Add floating effect to form controls
    const formControls = document.querySelectorAll(".form-control");
    formControls.forEach((control) => {
        control.addEventListener("focus", function () {
            this.parentElement.classList.add("focused");
        });

        control.addEventListener("blur", function () {
            if (this.value === "") {
                this.parentElement.classList.remove("focused");
            }
        });
    });
});
