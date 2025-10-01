@extends('company.app')

@section('title', 'Company Dashboard')

@section('content')

<!-- HEADER PERUSAHAAN -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="position-relative">
                    @if(Auth::guard('company')->user()->logo)
                        <img src="{{ asset('storage/' . Auth::guard('company')->user()->logo) }}"
                             alt="{{ Auth::guard('company')->user()->name }}"
                             class="rounded"
                             style="width: 60px; height: 60px; object-fit: cover;">
                    @else
                        <div class="bg-primary rounded d-flex align-items-center justify-content-center text-white fw-bold" style="width: 60px; height: 60px; font-size: 24px;">
                            {{ Auth::guard('company')->user()->initials }}
                        </div>
                    @endif
                </div>
                <div>
                    <h2 class="fw-bold fs-5 mb-0">{{ Auth::guard('company')->user()->name }}</h2>
                    <div class="d-flex align-items-center gap-2">
                    @if(Auth::guard('company')->user()->is_verified)
                        <span class="badge bg-success-subtle text-success">
                            <i class="fas fa-check-circle"></i> Terverifikasi
                        </span>
                    @else
                    <svg viewBox="0 0 12 15" xmlns="http://www.w3.org/2000/svg"
                            fill="#D4D5D8" height="20" width="20">
                            <path d="m6 .167 5.478 1.217a.667.667 0 0 1 .522.65v6.659a4 4 0 0 1-1.781 3.328L6 14.833l-4.219-2.812A4 4 0 0 1 0 8.693V2.035c0-.313.217-.583.522-.651L6 .167ZM8.968 4.98l-3.3 3.3-1.885-1.886-.943.943 2.828 2.829 4.243-4.243-.943-.943Z"></path>
                        </svg>
                        <span class="text-muted fw-semibold">
                            Belum Diverifikasi
                        </span>
                        <span class="fw-semibold">
                            -
                        </span>
                        <!-- Tombol / Link -->
                        <a href="#"
                        style="letter-spacing: 1px;"
                        class="text-primary fw-semibold text-decoration-none"
                        data-bs-toggle="modal"
                        data-bs-target="#verificationModal">
                        Verifikasi Perusahaan
                        </a>

                        <!-- Modal Verifikasi Perusahaan -->
                        <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 1100px;">
                            <div class="modal-content rounded-3 shadow" style="min-height: 550px; max-height: 90vh;">

                            <!-- Header -->
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-semibold" style="letter-spacing: 1px;" id="verificationModalLabel">Verifikasi Perusahaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="border-top"></div>

                            <!-- Form Wrapper -->
                            <form id="verificationForm">
                                <!-- Body -->
                                <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">

                                <p class="mb-3">Silakan pilih metode verifikasi untuk melanjutkan.</p>

                                <!-- Pilihan Metode -->
                                <div class="row g-3 mb-4">
                                    <!-- Opsi Dokumen Legal -->
                                    <div class="col-md-6">
                                    <div class="card border shadow-sm h-100 pilih-metode" data-metode="legal" style="cursor:pointer;">
                                        <div class="card-body position-relative">
                                        <!-- Direkomendasikan -->
                                        <span class="badge position-absolute px-2 py-1 rounded-3"
                                                style="background-color:#ff8000; color:#fff; top:-10px; left:15px; z-index:1; letter-spacing: 2px;">
                                            Direkomendasikan
                                        </span>

                                        <!-- Judul + Icon -->
                                        <div class="d-flex align-items-start mb-2">
                                    <img src="{{ asset('images/verify-with-legal-documents-icon.svg') }}"
                                        alt="Verifikasi Legal"
                                        class="me-2" width="40" height="40">
                                    <div>
                                        <h6 class="fw-semibold mb-1">Verifikasi dengan Dokumen Legal</h6>
                                        <p class="mb-0 text-muted">Untuk bisnis yang terdaftar legal sebagai PT atau CV</p>
                                    </div>
                                    </div>

                            <hr class="my-2">

                            <!-- Subjudul -->
                            <p class="small mb-2 text-muted fw-semibold">Anda akan mendapatkan:</p>

                            <!-- 3 Item Sejajar -->
                            <div class="d-flex justify-content-between text-center">
                                <!-- Item 1 -->
                                <div class="flex-fill text-start">
                                <div class="fw-bold fs-6">5</div>
                                <div class="small text-muted">Loker aktif (Paket Standard)</div>
                                </div>
                                <!-- Item 2 -->
                                <div class="flex-fill text-start">
                                <img src="{{ asset('images/company-verified-badge.svg') }}"
                                    alt="Badge Terverifikasi"
                                    width="25" height="25">
                                <div class="small text-muted">Badge terverifikasi</div>
                                </div>

                                <!-- Item 3 -->
                                <div class="flex-fill text-start">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="#666666" width="25" height="25">
                                    <path d="M4.005 16V4h-2V2h3a1 1 0 0 1
                                            1 1v12h12.438l2-8H8.005V5h13.72a1
                                            1 0 0 1 .97 1.243l-2.5 10a1 1 0 0 1-.97.757H5.004a1
                                            1 0 0 1-1-1Zm2 7a2 2 0 1 1
                                            0-4 2 2 0 0 1 0 4Zm12 0a2 2 0 1 1
                                            0-4 2 2 0 0 1 0 4Z"></path>
                                </svg>
                                <div class="small text-muted">Fitur berbayar</div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>


                    <!-- Opsi Bukti Kepemilikan -->
                    <div class="col-md-6">
                    <div class="card border shadow-sm h-100 pilih-metode" data-metode="ownership" style="cursor:pointer;">
                        <div class="card-body position-relative">
                        <!-- Judul + Icon -->
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('images/verify-with-proof-of-ownership-icon.svg') }}"
                                class="me-2" width="40" height="40" />
                                <div>
                                    <h6 class="fw-semibold mb-0">Verifikasi dengan Bukti Kepemilikan</h6>
                                    <p>Untuk bisnis perorangan atau usaha perseorangan</p>
                                </div>

                        </div>
                        <hr class="my-2">
                        <!-- Subjudul -->
                        <p class="small mb-2 text-muted fw-semibold">Anda akan mendapatkan:</p>
                        <!-- 2 Item Sejajar -->
                        <div class="d-flex justify-content-between text-center">
                            <!-- Item 1 -->
                            <div class="flex-fill text-start">
                            <div class="fw-bold fs-6">3</div>
                            <div class="small text-muted">Loker aktif (Paket Standard)</div>
                            </div>
                            <div class="flex-fill text-start">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="#666666" width="25" height="25">
                                <path d="M4.005 16V4h-2V2h3a1 1 0 0 1
                                        1 1v12h12.438l2-8H8.005V5h13.72a1
                                        1 0 0 1 .97 1.243l-2.5 10a1 1 0 0 1-.97.757H5.004a1
                                        1 0 0 1-1-1Zm2 7a2 2 0 1 1
                                        0-4 2 2 0 0 1 0 4Zm12 0a2 2 0 1 1
                                        0-4 2 2 0 0 1 0 4Z"></path>
                            </svg>
                            <div class="small text-muted">Fitur berbayar</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- FORM DOKUMEN LEGAL -->
                <div id="formLegal" class="d-none">
                    <div class="row g-3">

                    <!-- Form kanan -->
                    <div class="col-md-8">
                        <div class="card border shadow-sm">
                        <div class="card-body">
                            <!-- NPWP -->
                            <div class="mb-3">
                            <label class="form-label fw-semibold">Upload NPWP Perusahaan <span class="text-danger">*</span></label><br>
                            <input type="file" id="uploadNPWP" accept=".pdf,.jpg,.jpeg,.png" hidden>
                            <label for="uploadNPWP" class="btn btn-outline-secondary d-inline-flex align-items-center">
                                <i class="bi bi-upload me-2"></i>Pilih File
                            </label>
                            <small class="text-muted d-block mt-2">
                                <span class="fw-semibold">Format yang dapat diterima:</span> pdf, jpg, jpeg, png | <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                            </small>
                            </div>

                            <!-- Nomor NPWP -->
                            <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor NPWP Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" style="width: 500px;">
                            </div>

                            <!-- NIB -->
                            <div class="mb-3">
                            <label class="form-label fw-semibold">13 Digit NIB Perusahaan - <span class="text-muted">Opsional</span></label>
                            <input type="text" class="form-control" style="width: 500px;">
                            <small class="text-muted d-block mt-1">Melampirkan NIB anda akan mempercepat verifikasi</small>
                            </div>

                            <!-- Dokumen Tambahan -->
                            <div class="mb-3">
                            <label class="form-label fw-semibold">Dokumen Tambahan</label><br>
                            <input type="file" id="extraDocsLegal" accept=".pdf,.jpg,.jpeg,.png" hidden>
                            <label for="extraDocsLegal" class="btn btn-outline-secondary d-inline-flex align-items-center">
                                <i class="bi bi-upload me-2"></i>Pilih File (Maks: 5)
                            </label>
                            <small class="text-muted d-block mt-2">
                                <span class="fw-semibold">Format yang dapat diterima:</span> pdf, jpg, jpeg, png | <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                            </small>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Sidebar Kiri (versi baru dengan ikon dari inspeksi) -->
                    <div class="col-md-4">
                    <div class="card border shadow-sm">
                        <div class="card-body">

                        <!-- Card Tutorial -->
                        <div class="card border-1 mb-3" style="border-radius: 5px; background-color:#f5f5f5;">
                        <div class="card-body d-flex align-items-start">
                            <!-- Gambar -->
                            <img src="{{ asset('images/tutorial-card-image.jpg') }}" alt="Tutorial"
                                width="48" height="48" class="me-3">

                            <!-- Konten -->
                            <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <p class="fw-semibold mb-0">Lihat Tutorial</p>
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" fill="#666666">
                                <path d="m13.172 12-4.95-4.95 1.414-1.414L16 12l-6.364
                                        6.364-1.414-1.414 4.95-4.95Z"></path>
                                </svg>
                            </div>
                            <p class="text-muted small mb-0">
                                Pelajari cara mengunduh PDF NPWP yang resmi dari situs pemerintah.
                            </p>
                            <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                        </div>

                    <!-- Persyaratan NPWP -->
                    <h6 class="fw-semibold mb-3">Persyaratan NPWP Perusahaan</h6>

                    <!-- Checklist hijau -->
                    <div class="d-flex align-items-start mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="#198754" class="me-2 flex-shrink-0">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2
                                12 2s10 4.477 10 10-4.477 10-10
                                10Zm0-2a8 8 0 1 0 0-16 8 8 0 0
                                0 0 16Zm-.997-4L6.76 11.757l1.414-1.414
                                2.829 2.829 5.657-5.657 1.414
                                1.414L11.003 16Z"></path>
                        </svg>
                        <p class="text-muted small mb-0">
                        Hanya file PDF asli yang diunduh dari
                        <a href="https://djponline.pajak.go.id" class="text-decoration-none" target="_blank">DJP Online</a>
                        atau <a href="https://coretaxdjp.pajak.go.id" class="text-decoration-none" target="_blank">Coretax</a>
                        yang diterima.
                        </p>
                    </div>
                <hr>
                    <!-- Silang kuning -->
                    <div class="d-flex align-items-start mb-2">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#F5A623" class="me-2 flex-shrink-0">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477
                                2 12 2s10 4.477 10 10-4.477
                                10-10 10Zm0-2a8 8 0 1 0 0-16.001A8
                                8 0 0 0 12 20Zm0-9.414 2.828-2.829
                                1.415 1.415L13.414 12l2.829
                                2.828-1.415 1.415L12 13.414l-2.828
                                2.829-1.415-1.415L10.586 12
                                7.757 9.172l1.415-1.415L12
                                10.586Z"></path>
                        </svg>
                        <p class="text-muted small mb-0">
                        File NPWP hasil scan atau foto tidak akan diterima.
                        </p>
                    </div>
                    <hr>
                    <div class="d-flex align-items-start mb-2">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#F5A623" class="me-2 flex-shrink-0">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477
                                2 12 2s10 4.477 10 10-4.477
                                10-10 10Zm0-2a8 8 0 1 0 0-16.001A8
                                8 0 0 0 12 20Zm0-9.414 2.828-2.829
                                1.415 1.415L13.414 12l2.829
                                2.828-1.415 1.415L12 13.414l-2.828
                                2.829-1.415-1.415L10.586 12
                                7.757 9.172l1.415-1.415L12
                                10.586Z"></path>
                        </svg>
                        <p class="text-muted small mb-0">
                        Untuk melakukan verifikasi dengan NPWP Pribadi atau NPWP Perseroan Perorangan, gunakan metode <a href="#" class="text-decoration-none" target="_blank">Bukti Kepemilikan</a>
                        </p>
                    </div>
                    <hr>
                    <div class="d-flex align-items-start mb-2">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    width="20" height="20" fill="#F5A623" class="me-2 flex-shrink-0">
                    <path d="M12 22C6.477 22 2 17.523 2 12S6.477
                            2 12 2s10 4.477 10 10-4.477
                            10-10 10Zm0-2a8 8 0 1 0 0-16.001A8
                            8 0 0 0 12 20Zm0-9.414 2.828-2.829
                            1.415 1.415L13.414 12l2.829
                            2.828-1.415 1.415L12 13.414l-2.828
                            2.829-1.415-1.415L10.586 12
                            7.757 9.172l1.415-1.415L12
                            10.586Z"></path>
                </svg>
                <p class="text-muted mb-0" style="font-size: 14px;">
                    Jika akun perusahaan Anda menggunakan nama brand, unggah Dashboard Social Media Manager atau sertifikat HAKI (Hak Cipta) untuk memverifikasi kepemilikan.
                </p>
                </div>

                </div>
            </div>
            </div>


            </div>
          </div>

          <!-- FORM BUKTI KEPEMILIKAN -->
          <div id="formOwnership" class="d-none">
            <div class="row g-3">

              <!-- Form Kiri -->
              <div class="col-md-9">
                <div class="card border shadow-sm">
                  <div class="card-body">
                    <!-- WA -->
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Verifikasi WhatsApp <span class="text-danger">*</span></label>
                      <div class="alert alert-light border d-flex align-items-center p-2 mb-0">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        <span>Status Verifikasi: <strong class="text-success"><br>Terverifikasi</strong></span>
                      </div>
                    </div>

                    <!-- Pilih Salah Satu -->
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Pilih Salah Satu <span class="text-danger">*</span></label>
                      <div class="d-flex gap-3">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="identityType" id="npwp" checked>
                          <label class="form-check-label" for="npwp">NPWP Pribadi</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="identityType" id="ktp">
                          <label class="form-check-label" for="ktp">KTP Pribadi</label>
                        </div>
                      </div>
                    </div>

                    <!-- Upload NPWP/KTP -->
                    <div class="mb-3">
                      <input type="file" id="uploadIdentity" accept=".pdf,.jpg,.jpeg,.png" hidden>
                      <label for="uploadIdentity" class="btn btn-outline-secondary d-inline-flex align-items-center">
                        <i class="bi bi-upload me-2"></i>Pilih File
                      </label>
                      <small class="text-muted d-block mt-2">
                        <span class="fw-semibold">Format yang dapat diterima:</span> pdf, jpg, jpeg, png | <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                      </small>
                    </div>

                    <!-- Nomor NPWP -->
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Nomor NPWP Pribadi <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" style="width: 500px;">
                    </div>

                    <!-- NIB -->
                    <div class="mb-3">
                      <label class="form-label fw-semibold">NIB Pribadi</label>
                      <input type="text" class="form-control" style="width: 500px;">
                      <small class="text-muted d-block mt-1">Melampirkan NIB anda akan mempercepat verifikasi</small>
                    </div>

                    <!-- Aktivitas Bisnis -->
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Pilih Salah Satu <span class="text-danger">*</span></label>
                      <div class="d-flex gap-3">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="businessProof" id="online" checked>
                          <label class="form-check-label" for="online">Foto Aktivitas Bisnis Online (Min 2)</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="businessProof" id="offline">
                          <label class="form-check-label" for="offline">Foto Aktivitas Bisnis Offline (Min 2)</label>
                        </div>
                      </div>
                    </div>

                    <!-- Upload Foto Aktivitas -->
                    <div class="mb-3">
                      <div class="d-flex gap-2 flex-wrap">
                        <label class="border d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                          <i class="bi bi-plus-lg fs-4 fw-semibold"></i>
                          <span class="small fw-semibold">Unggah</span>
                          <input type="file" accept=".jpg,.jpeg,.png" hidden>
                        </label>
                        <label class="border d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                          <i class="bi bi-plus-lg fs-4 fw-semibold"></i>
                          <span class="small fw-semibold">Unggah</span>
                          <input type="file" accept=".jpg,.jpeg,.png" hidden>
                        </label>
                        <label class="border d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                          <i class="bi bi-plus-lg fs-4 fw-semibold"></i>
                          <span class="small fw-semibold">Unggah</span>
                          <input type="file" accept=".jpg,.jpeg,.png" hidden>
                        </label>
                        <label class="border d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                          <i class="bi bi-plus-lg fs-4 fw-semibold"></i>
                          <span class="small fw-semibold">Unggah</span>
                          <input type="file" accept=".jpg,.jpeg,.png" hidden>
                        </label>
                        <label class="border d-flex flex-column justify-content-center align-items-center p-4 flex-fill text-muted" style="min-width:100px; cursor:pointer;">
                          <i class="bi bi-plus-lg fs-4 fw-semibold"></i>
                          <span class="small fw-semibold">Unggah</span>
                          <input type="file" accept=".jpg,.jpeg,.png" hidden>
                        </label>
                      </div>
                      <small class="text-muted d-block mt-2">
                        <span class="fw-semibold">Format yang dapat diterima:</span> jpg, jpeg, png | <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                      </small>
                    </div>

                    <!-- Dokumen Tambahan -->
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Dokumen Tambahan</label><br>
                      <input type="file" id="extraDocsOwnership" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                      <label for="extraDocsOwnership" class="btn btn-outline-secondary d-inline-flex align-items-center">
                        <i class="bi bi-upload me-2"></i>Pilih File (Maks: 5)
                      </label>
                      <small class="text-muted d-block mt-2">
                        <span class="fw-semibold">Format yang dapat diterima:</span> pdf, jpg, jpeg, png | <span class="fw-semibold">Ukuran maksimum:</span> 10MB
                      </small>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Sidebar Kanan -->
              <div class="col-md-3">
                <div class="card border shadow-sm">
                  <div class="card-body">
                    <h6 class="fw-semibold mb-3">Dibutuhkan</h6>
                    <ul class="list-unstyled small mb-0 text-muted fs-7">
                      <li>Verifikasi WhatsApp</li>
                      <li>KTP/NPWP Pribadi</li>
                      <li>Nomor KTP/NPWP Pribadi</li>
                      <li>NIB Pribadi (Opsional)</li>
                      <li>Foto Aktivitas Bisnis Online/Offline</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div><!-- /modal-body -->

        <!-- Footer -->
        <div class="modal-footer border-top">
          <button type="button" class="btn btn-outline-dark fw-semibold" style="letter-spacing: 1px;" data-bs-dismiss="modal">Batalkan</button>
          <button type="submit" class="btn btn-secondary fw-semibold" id="btnSubmit" style="letter-spacing: 1px;" disabled>Kirim</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
    .card-active {
  border: 1px solid #0d6efd !important;  /* biru Bootstrap */
  background-color: #e7f1ff !important;  /* biru muda */
  transition: all 0.2s ease-in-out;
}

</style>

<script>
  const metodeCards = document.querySelectorAll('.pilih-metode');
  const formLegal = document.getElementById('formLegal');
  const formOwnership = document.getElementById('formOwnership');
  const btnSubmit = document.getElementById('btnSubmit');

  // fungsi pilih metode
  function pilihMetode(metode) {
    // reset semua card
    metodeCards.forEach(c => c.classList.remove('card-active'));

    // sembunyikan semua form
    formLegal.classList.add('d-none');
    formOwnership.classList.add('d-none');

    // tampilkan sesuai pilihan
    if (metode === 'legal') {
      document.querySelector('[data-metode="legal"]').classList.add('card-active');
      formLegal.classList.remove('d-none');
    } else if (metode === 'ownership') {
      document.querySelector('[data-metode="ownership"]').classList.add('card-active');
      formOwnership.classList.remove('d-none');
    }

    // aktifkan tombol submit
    btnSubmit.removeAttribute('disabled');
  }

  // event listener klik
  metodeCards.forEach(card => {
    card.addEventListener('click', function() {
      pilihMetode(this.getAttribute('data-metode'));
    });
  });

  // default: tampilkan form legal saat load
  window.addEventListener('DOMContentLoaded', () => {
    pilihMetode('legal');
  });
</script>




                    @endif
                </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('company.profile.edit2') }}" class="btn btn-outline-dark d-flex align-items-center gap-2 fw-semibold" style="letter-spacing: 1px;">
                <svg viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="currentColor">
                    <path d="M10.345 4.667H17.5a.833.833 0 0 1 .833.833v11.667A.833.833 0 0 1 17.5 18h-15a.833.833 0 0 1-.833-.833V3.833A.833.833 0 0 1 2.5 3h6.178l1.667 1.667ZM10 11.333a2.083 2.083 0 1 0 0-4.166 2.083 2.083 0 0 0 0 4.166ZM6.667 15.5h6.666a3.333 3.333 0 1 0-6.666 0Z"></path>
                </svg>
                Edit Profil Perusahaan
                </a>

                <a href="{{ route('company.premium-features.index') }}" class="btn btn-outline-dark fw-semibold" style="letter-spacing: 1px;">
                <svg viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="currentColor">
                    <path d="M15.833 18.833H4.167a2.5 2.5 0 0 1-2.5-2.5V3a.833.833 0 0 1 .833-.833h11.667A.833.833 0 0 1 15 3v10h3.333v3.333a2.5 2.5 0 0 1-2.5 2.5ZM15 14.667v1.666a.834.834 0 0 0 1.667 0v-1.666H15ZM5 6.333V8h6.667V6.333H5Zm0 3.334v1.666h6.667V9.667H5ZM5 13v1.667h4.167V13H5Z"></path>
                </svg>
                Lihat Paket Berlangganan Saya
                </a>

            </div>
        </div>
    </div>

<div class="container-fluid py-2">
    <!-- BODY -->
    <div class="row">

        <!-- LOWONGAN (kiri) -->
        <div class="col-md-8">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <p class="fw-bold mb-0" style="color: #2D2D2D; letter-spacing: 1px;">Daftar Lowongan Kerja</p>
                </div>
                <div class="card-body">
                    <!-- FILTER -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="position-relative w-50">
                            <input type="text" placeholder="Cari nama loker atau kata kunci"
                                class="form-control"
                                style="height: 38px; border-radius: 6px; padding-left: 40px;">
                            <i class="fas fa-search position-absolute"
                            style="top: 50%; left: 12px; transform: translateY(-50%); color: #666;"></i>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-outline-secondary d-flex align-items-center" style="height: 38px; border-radius: 6px;">
                                <i class="fas fa-sort me-2"></i>
                                <span class="text-muted fw-bold me-2">Urutkan:</span>
                                <span>Tanggal Diupdate</span>
                            </button>
                        </div>
                    </div>

                    <!-- TAB -->
                    <ul class="nav nav-tabs mb-4" role="tablist" style="border-bottom: none;">
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link active d-flex align-items-center justify-content-between"
                            style="color: #666;" role="tab">
                                Semua Loker
                                <span class="badge rounded-pill" style="background-color: #d3d3d3; color: #363636; margin-left: 6px;">{{ $totalJobs }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-between" style="color: #666;" role="tab">
                                Aktif
                                <span class="badge rounded-pill" style="background-color:  #d3d3d3; color: #363636; margin-left: 6px;">{{ $activeJobs }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-between" style="color: #666;" role="tab">
                                Nonaktif
                                <span class="badge rounded-pill" style="background-color:  #d3d3d3; color: #363636; margin-left: 6px;">{{ $totalJobs - $activeJobs }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-between" style="color: #017EB7;" role="tab">
                                Dalam Review
                                <span class="badge rounded-pill" style="background-color: #d3d3d3; color:#017EB7; margin-left: 6px;">0</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-between" style="color: #666;" role="tab">
                                Draft
                                <span class="badge rounded-pill" style="background-color:  #d3d3d3; color: #363636; margin-left: 6px;">0</span>
                            </a>
                        </li>
                    </ul>

                    {{-- DAFTAR LOWONGAN DINAMIS --}}
                    @if($recentJobs && $recentJobs->count() > 0)
                        @foreach($recentJobs as $job)
                            <div class="card mb-3 border shadow-sm rounded-3 position-relative">
                                {{-- Status di pojok kanan atas --}}
                                <div class="position-absolute top-0 end-0 m-3 d-flex align-items-center gap-1">
                                    <span class="badge bg-light text-dark border px-2 py-1 d-flex align-items-center gap-2">
                                        <span class="fw-semibold">{{ $job->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                        <span class="d-inline-block rounded-circle"
                                            style="width:12px; height:12px; background-color: {{ $job->is_active ? '#28a745' : '#6c757d' }};">
                                        </span>
                                    </span>
                                </div>

                                <div class="card-body p-3">
                                    {{-- Header + Statistik sejajar --}}
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        {{-- Kiri: Judul + Detail --}}
                                        <div class="me-3" style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                                            <h5 class="fw-semibold mb-2 text-wrap">{{ $job->title }}</h5>
                                            <div class="d-flex flex-column text-muted small gap-1 mt-4">
                                                <span class="text-wrap">
                                                    <i class="fas fa-clock me-1"></i> {{ $job->employment_type }}
                                                </span>
                                                <span class="text-wrap mt-2">
                                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $job->office_address }}
                                                </span>
                                                <span class="text-wrap mt-3">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    Aktif hingga: {{ $job->created_at->addDays(30)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Kanan: Statistik --}}
                                        <div class="row text-center border rounded-2 py-2 mt-5" style="min-width: 550px; margin-right: 5px; me-10">
                                            <div class="col-4 border-end">
                                                <p class="fw-bold mb-0">{{ $job->chat_count ?? 0 }}</p>
                                                <p class="text-muted small mb-1" style="letter-spacing: 1px;">Chat Dimulai</p>
                                                <a href="{{ route('company.applications.index', ['job' => $job->id, 'status' => 'interview']) }}"
                                                class="text-primary small fw-bold text-decoration-none">Lihat</a>
                                            </div>
                                            <div class="col-4 border-end">
                                                <p class="fw-bold mb-0">{{ $job->applications_count ?? 0 }}</p>
                                                <p class="text-muted small mb-1" style="letter-spacing: 1px;">Terhubung</p>
                                                <a href="{{ route('company.applications.index', ['job' => $job->id]) }}"
                                                class="text-primary small fw-bold text-decoration-none">Lihat</a>
                                            </div>
                                            <div class="col-4">
                                                <p class="fw-bold mb-0">{{ $job->rejected_count ?? 0 }}</p>
                                                <p class="text-muted small mb-1" style="letter-spacing: 1px;">Belum Sesuai</p>
                                                <a href="{{ route('company.applications.index', ['job' => $job->id, 'status' => 'rejected']) }}"
                                                class="text-primary small fw-bold text-decoration-none">Lihat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- FOOTER: Action Buttons --}}
                                <div class="card-footer bg-light border-top d-flex justify-content-between align-items-center py-2">

                                    {{-- Kiri: Boost --}}
                                    <div>
                                        <button class="btn btn-outline-warning btn-sm fw-semibold" style="letter-spacing: 1px;">
                                            <i class="fas fa-bolt me-1"></i> Boost Lowongan
                                        </button>
                                    </div>

                                    {{-- Kanan: tombol lain --}}
                                    <div class="d-flex align-items-center gap-2" style="letter-spacing: 1px;">
                                        <a href="{{ route('company.applications.index', ['job' => $job->id]) }}"
                                        class="btn btn-primary btn-sm fw-semibold">
                                            Kelola Kandidat
                                        </a>
                                        <button class="btn btn-outline-secondary btn-sm fw-semibold" style="letter-spacing: 1px;">
                                            Recommended Talents
                                        </button>

                                        {{-- Dropdown kanan --}}
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border d-flex align-items-center justify-content-center"
                                                    type="button" data-bs-toggle="dropdown"
                                                    style="width:40px; height:30px;">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('company.jobs.edit', $job->id) }}">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">Bagikan</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">Duplikat</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">Ekspor CSV</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <h5 class="text-muted mt-3">Belum memiliki item</h5>
                        </div>
                    @endif

                    <!-- PAGINATION -->
                    <div class="d-flex justify-content-center mt-4">
{{-- ini cuman tampil ketika ada loker, kalo gak ada loker yang tampil hanya yang atas --}}
                        <p>Anda telah mencapai batas maksimal</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIDEBAR (kanan) -->
        <div class="col-md-4">
            <!-- NOTIFIKASI -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <span>Notifikasi (1)</span>
                </div>
                <div class="card-body p-0">
                    <!-- Notifikasi 1: Verifikasi -->
                    <div class="p-3">
                        <div class="d-flex align-items-start gap-3 mb-2">
                            <div class="bg-light p-2 rounded">
                                <i class="fas fa-shield-alt text-secondary" style="font-size:20px;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">Verifikasi Diperlukan</h6>
                                <p class="text-muted small mb-2">Verifikasi perusahaan Anda untuk posting lowongan pekerjaan dan dapatkan akses ke banyak fitur.</p>
                                <a href="#"
                                class="btn btn-outline-primary btn-sm"
                                style="letter-spacing: 1px;"
                                data-bs-toggle="modal"
                                data-bs-target="#verificationModal">
                                Verifikasi Perusahaan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VIP CARD -->
            <div class="card border-0 shadow-sm mb-3 text-white"
                style="background: linear-gradient(to bottom, #4b4b4b, #fbbf24); border-radius: 8px;">
            <div class="card-body d-flex align-items-center p-3">
                <!-- Logo -->
                <img src="{{ asset('images/glints-vip-icon.svg') }}"
                    alt="Glints VIP Icon" style="width:150px; height:150px;" class="me-4  " />
                <!-- Konten -->
                <div>
                <h6 class="fw-bold mb-2">Fitur baru: Glints VIP!</h6>
                <p class="small mb-3">Dapatkan fitur eksklusif untuk proses rekrutmen yang lebih cepat!</p>
                <button class="btn btn-outline-light btn-sm fw-semibold px-3"
                        style="letter-spacing: 1px;"
                        data-bs-toggle="modal"
                        data-bs-target="#verifikasiModal">
                    Upgrade ke VIP
                </button>

                </div>
            </div>
            </div>

            <!-- Modal Verifikasi Perusahaan -->
            <div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
                <div class="modal-content rounded-3 shadow border-0">

                <!-- Header -->
                <div class="modal-header" style="border-top: 1px solid #dee2e6;">
                    <h5 class="modal-title fw-bold" id="verifikasiLabel" style="letter-spacing: 1px;">Verifikasi Perusahaan Diperlukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body text-start px-4">
                    <!-- Progress Icon -->
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                    <img src="{{ asset('images/company-unverified-badge.svg') }}"
                        alt="Belum Diverifikasi"
                        style="width: 76px; height: 76px;">
                    <img src="{{ asset('images/company-verification-arrow.svg') }}"
                        alt="Arrow"
                        style="width: 60px; height: 60px;">
                    <img src="{{ asset('images/company-verified-badge.svg') }}"
                        alt="Sudah Diverifikasi"
                        style="width: 76px; height: 76px;">
                    </div>

                    <p class="mb-3">
                    Perusahaan Anda perlu diverifikasi agar dapat membeli fitur premium ini.
                    </p>
                    <p class="mb-0">
                    Harap pastikan anda mengunggah dokumen yang diperlukan; jika memiliki pertanyaan,
                    hubungi tim support kami melalui
                    <a href="mailto:hello@glints.com" class="text-primary text-decoration-none">hello@glints.com</a>
                    </p>
                </div>

                <!-- Footer -->
                <div class="modal-footer" style="border-top: 1px solid #dee2e6;">
                    <button type="button" class="btn btn-outline-secondary fw-semibold" style="letter-spacing: 1px;" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('company.account-settings.index') }}" class="btn btn-primary fw-semibold" style="letter-spacing: 1px;">Verifikasi Perusahaan</a>
                </div>

                </div>
            </div>
            </div>


            <!-- APP QR CODE CARD -->
            <div class="card border-0 shadow-sm mb-3 text-white"
                style="background: linear-gradient(135deg, #1eb2ff, #007bff); border-radius: 8px;">
            <div class="card-body p-3">

                <div class="d-flex align-items-center gap-3">

                <!-- Bagian QR + label -->
                <div class="text-center">
                    <!-- Label bubble -->
                    <div class="d-inline-block position-relative bg-white text-primary fw-bold px-2 py-1 rounded mb-2"
                        style="font-size: 0.7rem;">
                    SCAN UNTUK DOWNLOAD
                    <!-- segitiga bawah -->
                    <div style="
                        position: absolute;
                        bottom: -6px; left: 50%;
                        transform: translateX(-50%);
                        width: 0; height: 0;
                        border-left: 6px solid transparent;
                        border-right: 6px solid transparent;
                        border-top: 6px solid white;">
                    </div>
                    </div>

                    <!-- QR Code box -->
                    <div class="bg-white rounded p-2 d-inline-block">
                    <img src="{{ asset('images/glints-web2-app-qr.png') }}"
                        alt="Employers App QR" width="120" height="120" class="p-2" />
                    </div>
                </div>

                <!-- Bagian Teks -->
                <div>
                    <h6 class="fw-bold mb-1">Lebih Mudah di Aplikasi</h6>
                    <p class="small mb-3">Tingkatin pengalaman rekrutmenmu dengan Aplikasi Glints!</p>
                    <a href="https://help.glints.com/hc/id-id/sections/29365279475993-Glints-App-for-Employers-FAQs"
                    target="_blank" class="btn btn-outline-light btn-sm fw-semibold px-3" style="letter-spacing: 1px;">
                    Cara Menggunakan
                    </a>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
