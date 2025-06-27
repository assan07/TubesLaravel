@extends('layouts.mahasiswa.app')

@section('title', 'Pembayaran Kamar - Midtrans')

@section('main-content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-5 text-center">
                        <!-- Ikon atau Logo -->
                        <div class="mb-4">
                            <img src="{{ asset('assets/images/logos/logo-payment.png') }}" alt="Midtrans" width="100"
                                class="img-fluid">
                        </div>

                        <h3 class="fw-bold mb-4">Lanjutkan Pembayaran</h3>

                        <p class="text-muted mb-4">Silakan klik tombol di bawah untuk membayar tagihan kamar Anda melalui
                            Midtrans.</p>

                        <!-- Tombol Bayar -->
                        <button id="pay-button" class="btn btn-dark btn-lg px-5 py-3 fw-semibold">
                            <i class="bi bi-wallet2 me-2"></i>Bayar Sekarang
                        </button>

                        <!-- Info Tambahan -->
                        <div class="mt-4 text-start">
                            <small class="text-muted">
                                * Pastikan koneksi internet stabil saat melakukan pembayaran.<br>
                                * Anda akan dialihkan ke halaman pembayaran Midtrans.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Notifikasi --}}
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-transparent border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="modal-icon" class="mb-3"></div>
                    <h5 id="modal-title" class="fw-bold mb-3"></h5>
                    <p id="modal-message" class="text-muted"></p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-primary" id="redirectButton">OK</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        {{-- Midtrans Snap.js --}}
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>


        {{-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script> --}}


        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        // Kirim data ke backend
                        fetch("{{ url('/pembayaran-kamar/success') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    midtrans_result: result,
                                    bulan: "{{ $bulan }}",
                                    room_id: "{{ $room_id }}"
                                })
                            })
                            .then(async response => {
                                const data = await response.json();
                                if (!response.ok) {
                                    throw new Error(data.message || 'Gagal menyimpan data pembayaran.');
                                }

                                // Tampilkan notifikasi sukses
                                showPaymentModal(
                                    'success',
                                    '<i class="bi bi-check-circle-fill text-success fs-3"></i>',
                                    'Pembayaran Berhasil!',
                                    'Tagihan kamar Anda telah berhasil dibayar.'
                                );

                                // Redirect setelah pengguna menekan tombol OK
                                document.getElementById('redirectButton').addEventListener('click',
                                    function() {
                                        window.location.href = "{{ url('/pembayaran-kamar') }}";
                                    });
                            })
                            .catch(error => {
                                alert("Gagal menyimpan data pembayaran.");
                                console.error('ERROR:', error.message);
                            });
                    },
                    onPending: function(result) {
                        showPaymentModal(
                            'warning',
                            '<i class="bi bi-exclamation-triangle-fill text-warning fs-3"></i>',
                            'Pembayaran Pending',
                            'Pembayaran belum selesai. Silakan cek status transaksi.'
                        );
                    },
                    onError: function(result) {
                        showPaymentModal(
                            'danger',
                            '<i class="bi bi-x-circle-fill text-danger fs-3"></i>',
                            'Pembayaran Gagal',
                            'Terjadi kesalahan saat memproses pembayaran.'
                        );
                    }
                });
            };

            // Fungsi untuk menampilkan modal notifikasi
            function showPaymentModal(status, iconHtml, title, message) {
                const modalIcon = document.getElementById('modal-icon');
                const modalTitle = document.getElementById('modal-title');
                const modalMessage = document.getElementById('modal-message');

                modalIcon.innerHTML = iconHtml;
                modalTitle.textContent = title;
                modalMessage.textContent = message;

                const paymentModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('paymentModal'));
                paymentModal.show();
            }
        </script>
    @endpush
@endsection
