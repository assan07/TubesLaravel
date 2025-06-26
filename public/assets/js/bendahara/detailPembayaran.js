function printReceipt() {
    window.print();
}

function sendReceipt() {
    alert("Struk akan dikirim ke email penghuni");
}

function sendWhatsApp() {
    alert("Struk akan dikirim via WhatsApp");
}

function viewFullImage() {
    const modal = new bootstrap.Modal(document.getElementById("imageModal"));
    modal.show();
}
