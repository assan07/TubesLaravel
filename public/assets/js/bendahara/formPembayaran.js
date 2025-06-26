document.addEventListener("DOMContentLoaded", function () {
    // Handle payment method selection
    const paymentMethods = document.querySelectorAll(".payment-method");

    paymentMethods.forEach((method) => {
        method.addEventListener("click", function () {
            paymentMethods.forEach((m) => m.classList.remove("selected"));
            this.classList.add("selected");

            // Show/hide transfer details
            const transferDetails = document.getElementById("transferDetails");
            if (this.dataset.method === "transfer") {
                transferDetails.style.display = "block";
            } else {
                transferDetails.style.display = "none";
            }
        });
    });

    // File upload handling
    const fileInput = document.querySelector('input[type="file"]');
    const uploadArea = fileInput.parentElement;

    uploadArea.addEventListener("click", () => fileInput.click());

    fileInput.addEventListener("change", function () {
        if (this.files.length > 0) {
            const fileName = this.files[0].name;
            uploadArea.innerHTML = `
                <i class="ti ti-file-check text-success" style="font-size: 3rem;"></i>
                <p class="mt-2">File terpilih: <strong>${fileName}</strong></p>
                <small class="text-muted">Klik untuk mengganti file</small>
            `;
        }
    });

    // Calculator
    function updateCalculation() {
        const tarif =
            parseInt(document.getElementById("tarifDasar").value) || 0;
        const tambahan =
            parseInt(document.getElementById("biayaTambahan").value) || 0;
        const diskon = parseInt(document.getElementById("diskon").value) || 0;
        const total = tarif + tambahan - diskon;

        document.getElementById("totalCalculated").textContent =
            "Rp " + total.toLocaleString("id-ID");
    }

    document
        .getElementById("tarifDasar")
        .addEventListener("input", updateCalculation);
    document
        .getElementById("biayaTambahan")
        .addEventListener("input", updateCalculation);
    document
        .getElementById("diskon")
        .addEventListener("input", updateCalculation);

    // Set current date
    document.querySelector('input[name="tanggal_pembayaran"]').valueAsDate =
        new Date();
});

function applyCalculation() {
    const total = document
        .getElementById("totalCalculated")
        .textContent.replace(/[^\d]/g, "");
    document.querySelector('input[name="total_pembayaran"]').value = total;
}

function submitAndPrint() {
    // Submit form and then print
    document.getElementById("paymentForm").submit();
    // Add print functionality here
}
