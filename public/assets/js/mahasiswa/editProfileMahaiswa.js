// Function untuk preview image
function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function () {
        const preview = document.getElementById('profileImage');
        preview.src = reader.result;
        
        // Show delete button when new image is selected
        document.getElementById('deletePhotoBtn').style.display = 'inline-block';
    };
    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

// Function untuk delete foto secara real-time
function deletePhotoProfile() {
    // Gunakan SweetAlert untuk konfirmasi
    Swal.fire({
        title: 'Hapus Foto Profil?',
        text: 'Yakin ingin menghapus foto profil?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (!result.isConfirmed) {
            return;
        }
        
        performDeletePhoto();
    });
}


// Function terpisah untuk melakukan delete
function performDeletePhoto() {
    
    const form = document.getElementById('profile-form');
    const deleteBtn = document.getElementById('deletePhotoBtn');
    const originalText = deleteBtn.innerHTML;
    
    // Get data dari form attributes
    const deleteUrl = form.getAttribute('data-delete-url');
    const csrfToken = form.getAttribute('data-csrf-token');
    const defaultImage = form.getAttribute('data-default-image');
    
    // Show loading state
    deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
    deleteBtn.disabled = true;
    
    // AJAX request
    fetch(deleteUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({})
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Reset preview image ke default
            const preview = document.getElementById('profileImage');
            preview.src = defaultImage;
            
            // Clear file input
            document.getElementById('photoInputMahasiswa').value = '';
            
            // Hide delete button
            deleteBtn.style.display = 'none';
            
            // Show success message dengan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Foto profil berhasil dihapus!',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menghapus foto: ' + (data.message || 'Unknown error'),
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan saat menghapus foto',
            confirmButtonText: 'OK'
        });
    })
    .finally(() => {
        // Reset button state
        deleteBtn.innerHTML = originalText;
        deleteBtn.disabled = false;
    });
}
