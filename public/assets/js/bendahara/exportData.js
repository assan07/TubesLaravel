document.addEventListener("DOMContentLoaded", function () {
    // Handle export format selection
    const exportOptions = document.querySelectorAll(".export-option");

    exportOptions.forEach((option) => {
        option.addEventListener("click", function () {
            exportOptions.forEach((opt) => opt.classList.remove("selected"));
            this.classList.add("selected");
        });
    });

    // Set default selection
    exportOptions[0].classList.add("selected");
});
