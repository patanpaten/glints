@extends('company.app')

@section('content')
<style>
/* Custom styles untuk bentuk kotak */
.form-control, .form-select, .btn, .card, .border {
    border-radius: 0 !important;
}
.rounded {
    border-radius: 0 !important;
}

/* Sticky positioning untuk menu profil */
.sticky-sidebar {
    position: sticky;
    top: 20px;
    z-index: 100;
}

/* Ukuran input teks yang lebih pendek */
.form-control {
    height: 38px !important;
    padding: 6px 12px !important;
    font-size: 14px !important;
}

textarea.form-control.custom-border {
    height: 120px !important;
}


.form-control[rows] {
    height: auto !important;
    min-height: 76px !important;
}

.btn-upload {
  position: relative;
  display: inline-block;
  padding: 12px 30px;
  font-weight: bold;
  border: 3px solid #0d81b9;
  border-radius: 4px;
  background: #fff;
  color: #0d81b9;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 1; /* tombol di atas strip */
}

.btn-upload1 {
  position: relative;
  display: inline-block;
  padding: 12px 30px;
  font-weight: bold;
  border: 3px solid #0d81b9;
  border-radius: 4px;
  background: #0d81b9;
  color:rgb(255, 255, 255);
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 1; /* tombol di atas strip */
}

.btn-upload1:hover {
  background: #0d81b9;
  color: #fff;
}
/* efek hover */
.btn-upload:hover {
  background: #0d81b9;
  color: #fff;
}

.btn-upload:hover::after {
  opacity: 1;
}

/* Sidebar menu */
.sidebar-menu {
    border-right: 2px solid #e0e0e0; /* garis pemisah */
    padding-right: 10px;
}

/* Sticky */
.sticky-sidebar {
    position: sticky;
    top: 20px;
    z-index: 100;
}

/* Link default */
.sidebar-menu .nav-link {
    font-size: 15px;
    font-weight: 500;
    color: #000;
    padding: 6px 0;
    margin-bottom: 10px;
    border-right: 2px solid transparent;
    transition: all 0.2s ease;
}

/* Link hover */
.sidebar-menu .nav-link:hover {
    color: #0d81b9;
}

/* Link active */
.sidebar-menu .nav-link.active {
    font-weight: 600;
    color: #000;
    border-right: 2px solid #0d81b9;
}

.form-control.custom-border {
    border: 2px solid #ccc; /* abu-abu */
    border-radius: 4px;
    padding: 10px;
    width: 65%;        /* panjang penuh container */
    height: 50px !important;
    font-size: 16px;    /* teks lebih besar agar seimbang */
}

.form-control.custom-border:focus {
    border-color: #0d6efd; /* biru */
    box-shadow: none;
}



</style>
<div class="container-fluid py-4" style="min-height: 100vh; background-color:rgb(255, 255, 255);">
    <div class="container">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="h2 fw-bold text-dark">Edit Profil Perusahaan</h1>
        </div>
        
        <!-- Banner Upload Section -->
        <div class="card shadow-sm mb-4">
            <div class="position-relative">
                <div class="position-relative overflow-hidden" style="height: 200px; background-color: #6c757d; border-radius: 0.375rem 0.375rem 0 0;">
                    <div id="banner-preview" class="d-none position-absolute top-0 start-0 w-100 h-100">
                        <img id="banner-img" src="" alt="Banner Preview" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="position-absolute bottom-0 end-0 p-3 btn-upload-wrapper">
                        <label for="banner" class="btn-upload">
                            <i class="bi bi-upload"></i> UNGGAH BANNER
                        </label>
                        <input id="banner" name="banner" type="file" class="d-none" accept="image/*">
                    </div>



                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Sidebar Menu -->
            <div class="col-md-3">
                <div class="sticky-sidebar sidebar-menu">
                    <nav class="nav flex-column">
                        <a href="#informasi-dasar" class="nav-link active">Informasi Dasar</a>
                        <a href="#tautan-web" class="nav-link">Tautan Web</a>
                        <a href="#deskripsi-perusahaan" class="nav-link">Deskripsi Perusahaan</a>
                        <a href="#foto" class="nav-link">Foto</a>
                    </nav>
                </div>
            </div>

            
            <!-- Main Content -->
            <div class="col-md-9">
        <!-- Form -->
        <form action="{{ route('company.profile.update2') }}" method="POST" enctype="multipart/form-data" id="editForm">
            @csrf
            @method('PUT')
            
            <!-- Logo and Actions Section -->
            <div class=" ">
                <div class="card-body">
                    <p class="text-dark small mb-3"><span class="text-primary">*</span> Wajib diisi</p>
                    
                    <div class="row align-items-start">
    
                    <!-- Logo Perusahaan -->
                    <div class="col-auto d-flex align-items-center">
                        <!-- Teks di kiri -->
                        <span class="me-2 fw-medium">Logo Perusahaan</span>

                        <!-- Kotak logo -->
                        <div class="border border-1 rounded overflow-hidden" style="width: 120px; height: 120px;">
                            <img id="logo-img" src="https://via.placeholder.com/120" alt="Logo Perusahaan" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                    </div>

                    <!-- Upload Form -->
                    <div class="col">
                        <!-- Tombol unggah -->
                        <label for="logo" class="btn btn-upload fw-bold px-4">
                            <i class="bi bi-upload me-1"></i> UNGGAH
                        </label>
                        <input id="logo" name="logo" type="file" class="d-none" accept="image/*">

                        <!-- Nama file -->
                        <div class="mt-1">
                            <i class="bi bi-paperclip"></i> <span id="file-name">logo-perusahaan</span>
                        </div>

                        <!-- Format & ukuran -->
                        <p class="text-muted small mt-1 mb-0">
                            Format yang diterima: <strong>.jpg, .jpeg, .png</strong><br>
                            Ukuran yang disarankan: <strong>120px x 120px</strong>
                        </p>
                    </div>

                    <!-- Tombol Simpan & Batal (pakai card) -->
                    <div class="col-auto">
                        <div class="card p-3 border-0 shadow-sm">
                            <div class="d-flex flex-column gap-2">
                                <button type="submit" class="btn btn-upload1 fw-bold">SIMPAN PERUBAHAN</button>
                                <button type="button" class="btn btn-upload fw-bold">BATALKAN</button>
                            </div>
                        </div>
                    </div>

                </div>

<br><br>

            <!-- Informasi Dasar Section -->
            <div id="informasi-dasar" class="mb-4">

                <!-- Company Name (Read-only) -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Nama Perusahaan</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" value="{{ $company->name ?? 'PT. Contoh Perusahaan' }}" class="form-control custom-border rounded-0 bg-light" readonly>
                    </div>
                </div>
                
                <!-- Short Description -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Deskripsi Singkat</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" 
                            name="short_description" 
                            class="form-control custom-border rounded-0" 
                            placeholder="Deskripsi singkat tentang perusahaan..." 
                            value="{{ $company->short_description ?? '' }}" 
                            required>
                    </div>
                </div>
                
                <!-- Office Address -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Alamat Kantor</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" 
                            name="office_address" 
                            class="form-control custom-border rounded-0" 
                            placeholder="Alamat lengkap kantor..." 
                            value="{{ $company->office_address ?? '' }}" 
                            required>
                    </div>
                </div>
                
                <!-- Location (Read-only) -->
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Lokasi</label>
                    </div>
                    <div class="col-md-9">
                        <div class="mb-2">
                            <input type="text" value="{{ $company->province ?? 'DKI Jakarta' }}" class="form-control custom-border rounded-0 bg-light" placeholder="Provinsi" readonly>
                        </div>
                        <div class="mb-2">
                            <input type="text" value="{{ $company->city ?? 'Jakarta Selatan' }}" class="form-control custom-border rounded-0 bg-light" placeholder="Kota" readonly>
                        </div>
                        <input type="text" 
                            class="form-control custom-border rounded-0 bg-light" 
                            placeholder="Alamat" 
                            value="{{ $company->address ?? 'Jl. Contoh No. 123, Jakarta Selatan' }}" 
                            readonly>
                    </div>
                </div>
                
                <!-- Employee Count (Read-only) -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Jumlah Karyawan</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" value="{{ $company->employee_count ?? '50-100' }}" class="form-control custom-border rounded-0 bg-light" readonly>
                    </div>
                </div>
                
                <!-- Industry -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Industri</label>
                    </div>
                    <div class="col-md-9">
                        <select name="industry" class="form-select form-control custom-border rounded-0" required>
                            <option value="">Pilih Industri</option>
                            <option value="teknologi" {{ ($company->industry ?? '') == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                            <option value="keuangan" {{ ($company->industry ?? '') == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                            <option value="kesehatan" {{ ($company->industry ?? '') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="pendidikan" {{ ($company->industry ?? '') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="manufaktur" {{ ($company->industry ?? '') == 'manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                            <option value="retail" {{ ($company->industry ?? '') == 'retail' ? 'selected' : '' }}>Retail</option>
                            <option value="lainnya" {{ ($company->industry ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                </div>

            </div>
<hr style="width: 65%; margin: 1rem 0; margin-left: 0; border: 1px solid #333;">





            <!-- Tautan Web Section -->
            <div id="tautan-web" class="mb-4">

                <!-- Website -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Website Perusahaan</label>
                    </div>
                    <div class="col-md-9">
                        <input type="url" name="website" value="{{ $company->website ?? '' }}" class="form-control custom-border rounded-0" placeholder="https://www.perusahaan.com">
                    </div>
                </div>
                
                <!-- Instagram -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Instagram</label>
                    </div>
                    <div class="col-md-9">
                        <input type="url" name="instagram" value="{{ $company->instagram ?? '' }}" class="form-control custom-border rounded-0" placeholder="https://instagram.com/perusahaan">
                    </div>
                </div>
                
                <!-- Facebook -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Facebook</label>
                    </div>
                    <div class="col-md-9">
                        <input type="url" name="facebook" value="{{ $company->facebook ?? '' }}" class="form-control custom-border rounded-0" placeholder="https://facebook.com/perusahaan">
                    </div>
                </div>
                
                <!-- LinkedIn -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">LinkedIn</label>
                    </div>
                    <div class="col-md-9">
                        <input type="url" name="linkedin" value="{{ $company->linkedin ?? '' }}" class="form-control custom-border rounded-0" placeholder="https://linkedin.com/company/perusahaan">
                    </div>
                </div>
                
                <!-- Twitter -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <label class="form-label fw-medium">Twitter</label>
                    </div>
                    <div class="col-md-9">
                        <input type="url" name="twitter" value="{{ $company->twitter ?? '' }}" class="form-control custom-border rounded-0" placeholder="https://twitter.com/perusahaan">
                    </div>
                </div>

            </div>

<hr style="width: 65%; margin: 1rem 0; margin-left: 0; border: 1px solid #333;">

            <!-- Deskripsi Perusahaan Section -->
            <div id="deskripsi-perusahaan" class="mb-4">
                <!-- Company Description -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Deskripsi Perusahaan <span class="text-danger">*</span></label>
                    <!-- Toolbar -->
                    <div class="d-flex gap-1 mb-1 border p-1" style="width: fit-content; border-radius: 4px;">
                        <button type="button" class="btn btn-light btn-sm border" style="min-width: 32px; padding: 2px 6px;">
                            <strong>B</strong>
                        </button>
                        <button type="button" class="btn btn-light btn-sm border" style="min-width: 32px; padding: 2px 6px;">
                            <em>I</em>
                        </button>
                        <button type="button" class="btn btn-light btn-sm border" style="min-width: 32px; padding: 2px 6px;">
                            &#8226; 
                        </button>
                        <button type="button" class="btn btn-light btn-sm border" style="min-width: 32px; padding: 2px 6px;">
                            1.
                        </button>
                    </div>

                    <!-- Textarea -->
                    <textarea name="description" rows="3" class="form-control custom-border rounded-0"
                        placeholder="Ceritakan tentang perusahaan Anda, visi, misi, dan nilai-nilai yang dianut..." required>{{ $company->description ?? '' }}</textarea>
                </div>

                <!-- Company Culture -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Budaya Perusahaan</label>
                    <!-- Toolbar -->
                    <div class="d-flex gap-1 mb-1 border p-1" style="width: fit-content; border-radius: 4px;">
                        <button type="button" class="btn btn-light btn-sm border" style="min-width: 32px; padding: 2px 6px;">
                            <strong>B</strong>
                        </button>
                        <button type="button" class="btn btn-light btn-sm border" style="min-width: 32px; padding: 2px 6px;">
                            <em>I</em>
                        </button>
                        <button type="button" class="btn btn-light btn-sm border" style="min-width: 32px; padding: 2px 6px;">
                            &#8226; 
                        </button>
                        <button type="button" class="btn btn-light btn-sm border" style="min-width: 32px; padding: 2px 6px;">
                            1.
                        </button>
                    </div>

                    <!-- Textarea -->
                    <textarea name="culture" rows="3" class="form-control custom-border rounded-0"
                        placeholder="Jelaskan budaya kerja dan lingkungan kerja di perusahaan Anda...">{{ $company->culture ?? '' }}</textarea>
                </div>
            </div>

<hr style="width: 65%; margin: 1rem 0; margin-left: 0; border: 1px solid #333;">

            
            <!-- Foto Section -->
            <div id="foto" class="mb-4">
            
                <!-- Company Photo Upload -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Foto</label>
                    <p class="text-muted mb-2">
                        Tampilkan & beri tahu tim, tunjangan, dan lingkungan kerja Anda kepada pelamar!
                    </p>

                    <div class="d-flex gap-2">
                        <!-- Kotak Foto yang sudah ada -->
                        <div class="border rounded d-flex align-items-center justify-content-center" 
                            style="width: 128px; height: 128px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0e/Lenovo_logo_2015.svg" 
                                alt="Foto Perusahaan" 
                                class="img-fluid" 
                                style="max-height: 80%; max-width: 80%;">
                        </div>

                        <!-- Kotak Tambah Foto -->
                        <label for="photo" 
                            class="border border-2 border-dashed rounded d-flex flex-column align-items-center justify-content-center" 
                            style="width: 128px; height: 128px; cursor: pointer;">
                            <i class="fas fa-upload mb-2" style="font-size: 1.5rem;"></i>
                            <span class="small">Tambahkan Foto</span>
                        </label>
                        <input id="photo" name="photo" type="file" class="d-none" accept="image/*">
                    </div>
                </div>

            </div>

            
            </div> <!-- End Main Content -->
        </div> <!-- End Flex Container -->
        </form>
    </div>
</div>

<script>
// Image preview functionality
function setupImagePreview(inputId, previewId, imageId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const image = document.getElementById(imageId);
    
    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
}

// Setup all image previews
setupImagePreview('banner', 'banner-preview', 'banner-img');
setupImagePreview('logo', 'logo-preview', 'logo-img');
setupImagePreview('photo', 'photo-preview', 'photo-img');

// Form validation
function validateForm() {
    const form = document.getElementById('editForm');
    const submitBtn = document.getElementById('saveButton');
    const requiredFields = form.querySelectorAll('[required]');
    
    let allValid = true;
    
    requiredFields.forEach(field => {
        if (field.type === 'file') {
            if (!field.files.length) {
                allValid = false;
            }
        } else if (field.tagName === 'SELECT') {
            if (!field.value || field.value === '') {
                allValid = false;
            }
        } else if (!field.value.trim()) {
            allValid = false;
        }
    });
    
    if (allValid) {
        submitBtn.disabled = false;
        submitBtn.classList.remove('btn-secondary');
        submitBtn.classList.add('btn-primary');
        submitBtn.style.opacity = '1';
    } else {
        submitBtn.disabled = true;
        submitBtn.classList.add('btn-secondary');
        submitBtn.classList.remove('btn-primary');
        submitBtn.style.opacity = '0.6';
    }
}

// Add event listeners to all form inputs
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editForm');
    const inputs = form.querySelectorAll('input, textarea, select');
    
    inputs.forEach(input => {
        input.addEventListener('input', validateForm);
        input.addEventListener('change', validateForm);
    });
    
    // Initial validation
    validateForm();
});
</script>
@endsection
