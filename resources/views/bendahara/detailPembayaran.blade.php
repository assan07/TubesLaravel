@extends('layouts.bendahara.app')

@section('title', 'Detail Pembayaran - Sistem Asrama Unidayan')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/bendahara/detailPembayaran.js') }}">

@section('main-content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0 text-gray-800">Detail Pembayaran</h2>
                <p class="text-muted mb-0">Informasi lengkap pembayaran kamar asrama</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('bendahara.pembayaran.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-1"></i>
                    Kembali
                </a>
                <button class="btn btn-outline-primary" onclick="printReceipt()">
                    <i class="ti ti-printer me-1"></i>
                    Cetak Struk
                </button>
                <a href="{{ route('bendahara.pembayaran.edit', 1) }}" class="btn btn-warning">
                    <i class="ti ti-edit me-1"></i>
                    Edit
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Main Payment Details -->
            <div class="col-lg-8">
                <!-- Payment Status Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="avatar-lg bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="ti ti-check" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Pembayaran Berhasil</h5>
                                        <p class="text-muted mb-0">ID Transaksi: #PAY-2025-001</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <h3 class="text-success mb-0">Rp 250.000</h3>
                                <span class="badge bg-success fs-6">LUNAS</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="text-muted">Periode Pembayaran:</td>
                                        <td class="fw-medium">Januari 2025</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tanggal Pembayaran:</td>
                                        <td class="fw-medium">12 Januari 2025</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Waktu Pembayaran:</td>
                                        <td class="fw-medium">14:30 WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Metode Pembayaran:</td>
                                        <td>
                                            <span class="badge bg-primary">Transfer Bank</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="text-muted">Bank Tujuan:</td>
                                        <td class="fw-medium">Bank BRI</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">No. Rekening:</td>
                                        <td class="fw-medium">1234-5678-9012-3456</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Status Verifikasi:</td>
                                        <td>
                                            <span class="badge bg-success">
                                                <i class="ti ti-check me-1"></i>Terverifikasi
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Diverifikasi oleh:</td>
                                        <td class="fw-medium">Bendahara Utama</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penghuni & Kamar Information -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Penghuni & Kamar</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div
                                        class="avatar-md bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                        H
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Hasan</h6>
                                        <p class="text-muted mb-0">ID: HSN001</p>
                                    </div>
                                </div>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td class="text-muted">NIM:</td>
                                        <td class="fw-medium">2021001234</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Jurusan:</td>
                                        <td class="fw-medium">Teknik Informatika</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">No. HP:</td>
                                        <td class="fw-medium">+62 812-3456-7890</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Email:</td>
                                        <td class="fw-medium">hasan@student.unidayan.ac.id</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="ti ti-home me-2"></i>Kamar-A1_L
                                        </h6>
                                        <div class="mb-2">
                                            <small class="text-muted">Lokasi:</small>
                                            <span class="badge bg-secondary ms-1">L1-Sayap kiri</span>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">Kapasitas:</small>
                                            <span class="fw-medium">2 orang</span>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">Tarif Bulanan:</small>
                                            <span class="fw-medium text-success">Rp 250.000</span>
                                        </div>
                                        <div>
                                            <small class="text-muted">Status Kamar:</small>
                                            <span class="badge bg-success">Aktif</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Breakdown -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Rincian Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Tarif Kamar (Januari 2025)</td>
                                        <td class="text-end">Rp 250.000</td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Listrik</td>
                                        <td class="text-end">Rp 0</td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Air</td>
                                        <td class="text-end">Rp 0</td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Maintenance</td>
                                        <td class="text-end">Rp 0</td>
                                    </tr>
                                    <tr>
                                        <td>Diskon</td>
                                        <td class="text-end text-success">- Rp 0</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="fw-bold">Total Pembayaran</td>
                                        <td class="text-end fw-bold text-success">Rp 250.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Bukti Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="border rounded p-3 text-center">
                                    <img src="https://via.placeholder.com/300x200/f8f9fa/6c757d?text=Bukti+Transfer"
                                        class="img-fluid rounded" alt="Bukti Transfer">
                                    <div class="mt-2">
                                        <small class="text-muted">bukti_transfer_hasan_jan2025.jpg</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi File</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td class="text-muted">Nama File:</td>
                                        <td>bukti_transfer_hasan_jan2025.jpg</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Ukuran File:</td>
                                        <td>1.2 MB</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Diupload:</td>
                                        <td>12 Jan 2025, 14:32 WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Format:</td>
                                        <td>JPEG</td>
                                    </tr>
                                </table>
                                <div class="mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="ti ti-download me-1"></i>Download
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="viewFullImage()">
                                        <i class="ti ti-eye me-1"></i>Lihat Penuh
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Keterangan</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">Pembayaran sewa kamar bulan Januari 2025. Transfer berhasil diverifikasi dan
                            sesuai dengan nominal yang tertera.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar Information -->
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="printReceipt()">
                                <i class="ti ti-printer me-2"></i>Cetak Struk Pembayaran
                            </button>
                            <button class="btn btn-outline-primary" onclick="sendReceipt()">
                                <i class="ti ti-mail me-2"></i>Kirim ke Email
                            </button>
                            <button class="btn btn-outline-success" onclick="sendWhatsApp()">
                                <i class="ti ti-brand-whatsapp me-2"></i>Kirim ke WhatsApp
                            </button>
                            <a href="{{ route('bendahara.pembayaran.edit', 1) }}" class="btn btn-outline-warning">
                                <i class="ti ti-edit me-2"></i>Edit Pembayaran
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Timeline Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">Pembayaran Lunas</h6>
                                    <p class="timeline-text">Pembayaran telah diverifikasi dan dinyatakan lunas</p>
                                    <small class="text-muted">12 Jan 2025, 15:00 WIB</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">Verifikasi Bukti</h6>
                                    <p class="timeline-text">Bukti transfer sedang diverifikasi oleh bendahara</p>
                                    <small class="text-muted">12 Jan 2025, 14:45 WIB</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">Upload Bukti</h6>
                                    <p class="timeline-text">Penghuni mengupload bukti pembayaran</p>
                                    <small class="text-muted">12 Jan 2025, 14:32 WIB</small>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">Transfer Bank</h6>
                                    <p class="timeline-text">Pembayaran dilakukan via transfer bank</p>
                                    <small class="text-muted">12 Jan 2025, 14:30 WIB</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Payments -->
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Pembayaran</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-medium">Desember 2024</div>
                                    <small class="text-success">Lunas</small>
                                </div>
                                <span class="text-success">Rp 250.000</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-medium">November 2024</div>
                                    <small class="text-success">Lunas</small>
                                </div>
                                <span class="text-success">Rp 250.000</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-medium">Oktober 2024</div>
                                    <small class="text-success">Lunas</small>
                                </div>
                                <span class="text-success">Rp 250.000</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-sm btn-outline-primary w-100">
                                Lihat Semua Riwayat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Full Image View -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="https://via.placeholder.com/600x400/f8f9fa/6c757d?text=Bukti+Transfer+Full+Size"
                        class="img-fluid" alt="Bukti Transfer">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ assets('assets/js/bendahara/detailPembayaran.js') }}"></script>
    @endpush

@endsection
