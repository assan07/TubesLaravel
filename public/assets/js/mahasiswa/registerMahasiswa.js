// Toggle password visibility
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const passwordIcon = document.getElementById(fieldId + "-icon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordIcon.classList.remove("fa-eye");
        passwordIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        passwordIcon.classList.remove("fa-eye-slash");
        passwordIcon.classList.add("fa-eye");
    }
}

// Form validation
document
    .getElementById("registerForm")
    .addEventListener("submit", function (e) {
        e.preventDefault();

        // Reset previous validation
        clearValidation();

        let isValid = true;

        // Get form fields
        const nama = document.getElementById("nama").value.trim();
        const nim = document.getElementById("nim").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const passwordConfirmation = document.getElementById(
            "password_confirmation"
        ).value;
        const terms = document.getElementById("terms").checked;

        // Validate nama
        if (nama === "") {
            showError("nama", "Nama lengkap harus diisi");
            isValid = false;
        } else if (nama.length < 3) {
            showError("nama", "Nama harus minimal 3 karakter");
            isValid = false;
        }

        // Validate NIM
        if (nim === "") {
            showError("nim", "NIM harus diisi");
            isValid = false;
        } else if (!/^\d+$/.test(nim)) {
            showError("nim", "NIM hanya boleh berisi angka");
            isValid = false;
        } else if (nim.length < 8) {
            showError("nim", "NIM harus minimal 8 digit");
            isValid = false;
        }

        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
            showError("email", "Email harus diisi");
            isValid = false;
        } else if (!emailRegex.test(email)) {
            showError("email", "Format email tidak valid");
            isValid = false;
        }

        // Validate password
        if (password === "") {
            showError("password", "Password harus diisi");
            isValid = false;
        } else if (password.length < 8) {
            showError("password", "Password harus minimal 8 karakter");
            isValid = false;
        } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)) {
            showError(
                "password",
                "Password harus mengandung huruf besar, huruf kecil, dan angka"
            );
            isValid = false;
        }

        // Validate password confirmation
        if (passwordConfirmation === "") {
            showError(
                "password_confirmation",
                "Konfirmasi password harus diisi"
            );
            isValid = false;
        } else if (password !== passwordConfirmation) {
            showError(
                "password_confirmation",
                "Konfirmasi password tidak sesuai"
            );
            isValid = false;
        }

        // Validate terms
        if (!terms) {
            alert("Anda harus menyetujui syarat dan ketentuan");
            isValid = false;
        }

        if (isValid) {
            // Show loading state
            const submitBtn = document.getElementById("submitBtn");
            const btnText = submitBtn.querySelector(".btn-text");
            const spinner = submitBtn.querySelector(".spinner-border");

            btnText.textContent = "Mendaftar...";
            spinner.classList.remove("d-none");
            submitBtn.disabled = true;

            // Simulate form submission (replace with actual form submission)
            setTimeout(() => {
                alert(
                    "Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi."
                );

                // Reset form
                this.reset();

                // Reset button state
                btnText.textContent = "Daftar Sekarang";
                spinner.classList.add("d-none");
                submitBtn.disabled = false;
            }, 2000);
        }
    });

function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const feedback = field.parentNode.querySelector(".invalid-feedback");

    field.classList.add("is-invalid");
    feedback.textContent = message;
}

function clearValidation() {
    const fields = [
        "nama",
        "nim",
        "email",
        "password",
        "password_confirmation",
    ];
    fields.forEach((fieldId) => {
        const field = document.getElementById(fieldId);
        field.classList.remove("is-invalid", "is-valid");
        const feedback = field.parentNode.querySelector(".invalid-feedback");
        if (feedback) feedback.textContent = "";
    });
}

// Real-time validation
document.getElementById("nama").addEventListener("input", function () {
    if (this.value.trim().length >= 3) {
        this.classList.remove("is-invalid");
        this.classList.add("is-valid");
    }
});

document.getElementById("nim").addEventListener("input", function () {
    if (/^\d{8,}$/.test(this.value)) {
        this.classList.remove("is-invalid");
        this.classList.add("is-valid");
    }
});

document.getElementById("email").addEventListener("input", function () {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailRegex.test(this.value)) {
        this.classList.remove("is-invalid");
        this.classList.add("is-valid");
    }
});

document.getElementById("password").addEventListener("input", function () {
    if (
        this.value.length >= 8 &&
        /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(this.value)
    ) {
        this.classList.remove("is-invalid");
        this.classList.add("is-valid");
    }
});

document
    .getElementById("password_confirmation")
    .addEventListener("input", function () {
        const password = document.getElementById("password").value;
        if (this.value === password && password !== "") {
            this.classList.remove("is-invalid");
            this.classList.add("is-valid");
        }
    });
