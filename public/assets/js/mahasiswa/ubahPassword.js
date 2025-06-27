function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = passwordField.nextElementSibling;

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

function checkPasswordStrength() {
    const password = document.getElementById("new_password").value;
    const strengthBar = document.getElementById("strengthBar");
    const strengthText = document.getElementById("strengthText");

    let strength = 0;
    let strengthLabel = "";

    // Check password length
    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;

    // Check for lowercase letters
    if (/[a-z]/.test(password)) strength++;

    // Check for uppercase letters
    if (/[A-Z]/.test(password)) strength++;

    // Check for numbers
    if (/[0-9]/.test(password)) strength++;

    // Check for special characters
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    // Remove all strength classes
    strengthBar.className = "strength-bar";

    if (password.length === 0) {
        strengthLabel = "";
    } else if (strength <= 2) {
        strengthBar.classList.add("strength-weak");
        strengthLabel = "Lemah";
        strengthText.style.color = "#dc3545";
    } else if (strength <= 3) {
        strengthBar.classList.add("strength-fair");
        strengthLabel = "Cukup";
        strengthText.style.color = "#fd7e14";
    } else if (strength <= 4) {
        strengthBar.classList.add("strength-good");
        strengthLabel = "Baik";
        strengthText.style.color = "#ffc107";
    } else {
        strengthBar.classList.add("strength-strong");
        strengthLabel = "Kuat";
        strengthText.style.color = "#28a745";
    }

    strengthText.textContent = strengthLabel;
}
