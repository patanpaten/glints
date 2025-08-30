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

.form-control[rows] {
    height: auto !important;
    min-height: 76px !important;
}

.btn-upload {
  position: relative;
  display: inline-block;
  padding: 12px 30px;
  font-weight: bold;
  border: 2px solid #0d81b9;
  border-radius: 4px;
  background: #fff;
  color: #0d81b9;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 1; /* tombol di atas strip */
}

/* strip bayangan */
.btn-upload::after {
  content: "";
  position: absolute;
  top: 6px;   /* geser ke bawah */
  left: 6px;  /* geser ke kanan */
  width: 100%;
  height: 100%;
  background: repeating-linear-gradient(
    -45deg,
    #333 0,
    #333 2px,
    transparent 2px,
    transparent 6px
  );
  border-radius: 4px;
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: -1;   /* ini akan ada di belakang tombol */
}

/* efek hover */
.btn-upload:hover {
  background: #0d81b9;
  color: #fff;
}

.btn-upload:hover::after {
  opacity: 1;
}




</style>
<div class="container-fluid py-4" style="min-height: 100vh; background-color: #f8f9fa;">
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
                <div class="card shadow-sm sticky-sidebar">
                    <div class="card-body">
                        <h5 class="fw-semibold text-dark mb-3">Menu Profil</h5>
                        <nav class="nav flex-column">
                            <a href="#informasi-dasar" class="nav-link active px-3 py-2 mb-1 text-primary bg-light rounded">Informasi Dasar</a>
                            <a href="#tautan-web" class="nav-link px-3 py-2 mb-1 text-dark rounded">Tautan Web</a>
                            <a href="#deskripsi-perusahaan" class="nav-link px-3 py-2 mb-1 text-dark rounded">Deskripsi Perusahaan</a>
                            <a href="#foto" class="nav-link px-3 py-2 mb-1 text-dark rounded">Foto</a>
                        </nav>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9">
        <!-- Form -->
        <form action="{{ route('company.profile.update2') }}" method="POST" enctype="multipart/form-data" id="editForm">
            @csrf
            @method('PUT')
            
            <!-- Logo and Actions Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <p class="text-danger small mb-3">* Wajib diisi</p>
                    
                    <div class="row align-items-start">
                        <!-- Logo Upload -->
                        <div class="col-auto">
                            <div class="border border-2 border-dashed border-secondary rounded d-flex align-items-center justify-content-center position-relative overflow-hidden" style="width: 96px; height: 96px;">
                                <div id="logo-preview" class="d-none position-absolute top-0 start-0 w-100 h-100">
                                    <img id="logo-img" src="" alt="Logo Preview" class="w-100 h-100" style="object-fit: cover;">
                                </div>
                                <i class="fas fa-plus text-muted" style="font-size: 2rem;"></i>
                            </div>
                            <label for="logo" class="btn btn-link p-0 mt-2 small fw-medium" style="cursor: pointer;">Unggah</label>
                            <input id="logo" name="logo" type="file" class="d-none" accept="image/*">
                            <p class="text-muted small mt-1">PNG, JPG max 2MB</p>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="col d-flex flex-column align-items-end gap-2">
                            <button type="submit" id="saveButton" disabled class="btn btn-primary" style="width: 160px;">
                                Simpan Perubahan
                            </button>
                            <button type="button" onclick="window.history.back()" class="btn btn-secondary" style="width: 160px;">
                                Batalkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Dasar Section -->
            <div id="informasi-dasar" class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="fw-semibold text-dark mb-4">Informasi Dasar</h4>
                    
                    <!-- Company Name (Read-only) -->
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Nama Perusahaan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" value="{{ $company->name ?? 'PT. Contoh Perusahaan' }}" class="form-control bg-light" readonly>
                        </div>
                    </div>
                    
                    <!-- Short Description -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Deskripsi Singkat</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="short_description" rows="2" class="form-control" placeholder="Deskripsi singkat tentang perusahaan..." required>{{ $company->short_description ?? '' }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Office Address -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Alamat Kantor</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="office_address" rows="2" class="form-control" placeholder="Alamat lengkap kantor..." required>{{ $company->office_address ?? '' }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Location (Read-only) -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Lokasi</label>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-2">
                                <input type="text" value="{{ $company->province ?? 'DKI Jakarta' }}" class="form-control bg-light" placeholder="Provinsi" readonly>
                            </div>
                            <div class="mb-2">
                                <input type="text" value="{{ $company->city ?? 'Jakarta Selatan' }}" class="form-control bg-light" placeholder="Kota" readonly>
                            </div>
                            <textarea rows="2" class="form-control bg-light" placeholder="Alamat" readonly>{{ $company->address ?? 'Jl. Contoh No. 123, Jakarta Selatan' }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Employee Count (Read-only) -->
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Jumlah Karyawan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" value="{{ $company->employee_count ?? '50-100' }}" class="form-control bg-light" readonly>
                        </div>
                    </div>
                    
                    <!-- Industry -->
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Industri</label>
                        </div>
                        <div class="col-md-9">
                            <select name="industry" class="form-select" required>
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
            </div>

            <!-- Tautan Web Section -->
            <div id="tautan-web" class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="fw-semibold text-dark mb-4">Tautan Web</h4>
                    
                    <!-- Website -->
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Website Perusahaan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="url" name="website" value="{{ $company->website ?? '' }}" class="form-control" placeholder="https://www.perusahaan.com">
                        </div>
                    </div>
                    
                    <!-- Instagram -->
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Instagram</label>
                        </div>
                        <div class="col-md-9">
                            <input type="url" name="instagram" value="{{ $company->instagram ?? '' }}" class="form-control" placeholder="https://instagram.com/perusahaan">
                        </div>
                    </div>
                    
                    <!-- Facebook -->
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Facebook</label>
                        </div>
                        <div class="col-md-9">
                            <input type="url" name="facebook" value="{{ $company->facebook ?? '' }}" class="form-control" placeholder="https://facebook.com/perusahaan">
                        </div>
                    </div>
                    
                    <!-- LinkedIn -->
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">LinkedIn</label>
                        </div>
                        <div class="col-md-9">
                            <input type="url" name="linkedin" value="{{ $company->linkedin ?? '' }}" class="form-control" placeholder="https://linkedin.com/company/perusahaan">
                        </div>
                    </div>
                    
                    <!-- Twitter -->
                    <div class="row align-items-center mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Twitter</label>
                        </div>
                        <div class="col-md-9">
                            <input type="url" name="twitter" value="{{ $company->twitter ?? '' }}" class="form-control" placeholder="https://twitter.com/perusahaan">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Perusahaan Section -->
            <div id="deskripsi-perusahaan" class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="fw-semibold text-dark mb-4">Deskripsi Perusahaan</h4>
                    
                    <!-- Company Description -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Deskripsi Perusahaan</label>
                        <textarea name="description" rows="3" class="form-control" placeholder="Ceritakan tentang perusahaan Anda, visi, misi, dan nilai-nilai yang dianut..." required>{{ $company->description ?? '' }}</textarea>
                    </div>
                    
                    <!-- Company Culture -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Budaya Perusahaan</label>
                        <textarea name="culture" rows="3" class="form-control" placeholder="Jelaskan budaya kerja dan lingkungan kerja di perusahaan Anda...">{{ $company->culture ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            
            <!-- Foto Section -->
            <div id="foto" class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="fw-semibold text-dark mb-4">Foto</h4>
                    
                    <!-- Company Photo Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Foto Perusahaan</label>
                        <div class="border border-2 border-dashed border-secondary rounded p-4 text-center">
                            <div id="photo-preview" class="d-none mb-3">
                                <img id="photo-img" src="" alt="Photo Preview" class="img-fluid rounded" style="max-height: 128px;">
                            </div>
                            <i class="fas fa-image text-muted mb-3" style="font-size: 3rem;"></i>
                            <div>
                                <label for="photo" class="btn btn-outline-primary" style="cursor: pointer;">
                                    <span>Unggah Foto</span>
                                </label>
                                <input id="photo" name="photo" type="file" class="d-none" accept="image/*">
                                <p class="text-muted small mt-2 mb-0">PNG, JPG, GIF hingga 10MB</p>
                            </div>
                        </div>
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
