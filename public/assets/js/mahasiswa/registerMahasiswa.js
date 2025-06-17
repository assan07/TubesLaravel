document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registerForm");
    const submitBtn = document.getElementById("submitBtn");
    const spinner = submitBtn.querySelector(".spinner-border");
    const btnText = submitBtn.querySelector(".btn-text");

    form.addEventListener("submit", function (e) {
        if (!isValid) {
            e.preventDefault(); // Hanya cegah submit kalau tidak valid
        }
        clearValidation();

        let isValid = true;
        const nama = document.getElementById("nama").value.trim();
        const nim = document.getElementById("nim").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const passwordConfirmation = document.getElementById(
            "password_confirmation"
        ).value;
        const terms = document.getElementById("terms").checked;

        if (nama.length < 3) {
            showError("nama", "Nama harus minimal 3 karakter");
            isValid = false;
        }

        if (!/^\d{8,}$/.test(nim)) {
            showError("nim", "NIM harus 8 digit angka");
            isValid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showError("email", "Format email tidak valid");
            isValid = false;
        }

        if (
            password.length < 8 ||
            !/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)
        ) {
            showError(
                "password",
                "Password min 8 karakter, mengandung huruf besar, kecil, & angka"
            );
            isValid = false;
        }

        if (password !== passwordConfirmation) {
            showError(
                "password_confirmation",
                "Konfirmasi password tidak sesuai"
            );
            isValid = false;
        }

        if (!terms) {
            alert("Anda harus setuju dengan syarat dan ketentuan");
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

            console.log("Validasi lolos, akan submit form...");
            document.getElementById("registerForm").submit();
        }
    });

    // Toggle password
    window.togglePassword = function (fieldId) {
        const fld = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + "-icon");
        const isPwd = fld.type === "password";
        fld.type = isPwd ? "text" : "password";
        icon.classList.toggle("fa-eye-slash", isPwd);
        icon.classList.toggle("fa-eye", !isPwd);
    };

    // Error helpers
    function showError(id, msg) {
        const f = document.getElementById(id);
        f.classList.add("is-invalid");
        document.getElementById(id + "-error").textContent = msg;
    }

    function clearValidation() {
        ["nama", "nim", "email", "password", "password_confirmation"].forEach(
            (id) => {
                const f = document.getElementById(id);
                if (!f) return;
                f.classList.remove("is-invalid");
                const e = document.getElementById(id + "-error");
                if (e) e.textContent = "";
            }
        );
    }
});
