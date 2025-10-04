@extends('company.layout-profil')

@section('title', 'Profil Perusahaan')

@section('content')
<div x-data="companyForm()" class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-md shadow-sm">

    {{-- Header --}}
    <div class="border-b px-6 py-3">
        <h2 class="text-base font-semibold text-gray-800">Profil Perusahaan</h2>
    </div>

    {{-- Body --}}
    <div class="p-6">
        <form id="company-form" action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Logo Upload --}}
            <div class="flex flex-col items-start space-y-2">
                <label class="w-24 h-24 flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100 relative overflow-hidden">
                    <span class="text-lg text-gray-500 font-bold" id="logo-placeholder">+</span>
                    <span class="text-xs text-gray-600">Unggah</span>
                    <input type="file" name="logo" id="logo-input" class="hidden" accept=".jpg,.jpeg,.png">
                    <img id="logo-preview" src="{{ $company->logo ? asset('storage/'.$company->logo) : '' }}"
                         class="absolute inset-0 w-full h-full object-cover rounded-md border {{ $company->logo ? '' : 'hidden' }}">
                </label>
                <span class="text-sm text-gray-700">Logo Perusahaan</span>
            </div>

            {{-- Nama Legal Perusahaan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Legal Perusahaan<span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="legal-name"
                       class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                       value="{{ old('name', $company->name) }}" required>
            </div>

            {{-- Nama Brand (otomatis terisi dari Nama Legal) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Brand<span class="text-red-500">*</span>
                </label>
                <input type="text" name="brand" id="brand-name"
                       class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2 bg-gray-50"
                       value="{{ old('brand', $company->description) }}" readonly required>
            </div>

            {{-- Jumlah Karyawan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Jumlah Karyawan<span class="text-red-500">*</span>
                </label>
                <select name="company_size"
                        class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2" required>
                    <option value="">Pilih jumlah karyawan</option>
                    <option value="1-10" @selected(old('company_size', $company->company_size) == '1-10')>1 - 10 karyawan</option>
                    <option value="11-50" @selected(old('company_size', $company->company_size) == '11-50')>11 - 50 karyawan</option>
                    <option value="51-200" @selected(old('company_size', $company->company_size) == '51-200')>51 - 200 karyawan</option>
                    <option value="201-500" @selected(old('company_size', $company->company_size) == '201-500')>201 - 500 karyawan</option>
                    <option value="500+" @selected(old('company_size', $company->company_size) == '500+')>500+ karyawan</option>
                </select>
            </div>

            {{-- Industri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Industri<span class="text-red-500">*</span>
                </label>
                <select id="industry" name="industry"
                        class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2" required>
                    <option value="">Belum dipilih</option>
                    <option value="IT" @selected(old('industry', $company->industry) == 'IT')>Teknologi Informasi</option>
                    <option value="Finance" @selected(old('industry', $company->industry) == 'Finance')>Keuangan</option>
                    <option value="Manufacture" @selected(old('industry', $company->industry) == 'Manufacture')>Manufaktur</option>
                    <option value="Other" @selected(old('industry', $company->industry) == 'Other')>Lainnya</option>
                </select>
            </div>

            {{-- Lokasi (muncul kalau industri dipilih) --}}
            <div id="location-section" class="space-y-4 hidden">
                <h3>Lokasi</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi<span class="text-red-500">*</span></label>
                    <input type="text" name="province"
                           class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                           value="{{ old('province', $company->province) }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota<span class="text-red-500">*</span></label>
                    <input type="text" name="city"
                           class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                           value="{{ old('city', $company->city) }}">
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap<span class="text-red-500">*</span></label>
                    <textarea id="address" name="address" rows="3"
                              class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2">{{ old('address', $company->address) }}</textarea>
                </div>
            </div>

            {{-- Button --}}
            <div class="flex justify-end">
                <button type="submit" id="submit-btn"
                        class="px-6 bg-blue-400 text-white text-sm font-medium py-2.5 rounded-md cursor-not-allowed" disabled>
                    Buat Perusahaan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoInput = document.getElementById('logo-input');
    const logoPreview = document.getElementById('logo-preview');
    const logoPlaceholder = document.getElementById('logo-placeholder');
    const industrySelect = document.getElementById('industry');
    const locationSection = document.getElementById('location-section');
    const legalNameInput = document.getElementById('legal-name');
    const brandNameInput = document.getElementById('brand-name');
    const form = document.getElementById('company-form');
    const submitBtn = document.getElementById('submit-btn');

    // Logo upload + preview
    logoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                alert('Hanya file JPG, JPEG, dan PNG yang diizinkan.');
                logoInput.value = '';
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB.');
                logoInput.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
                logoPreview.classList.remove('hidden');
                logoPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Nama Brand otomatis dari Nama Legal
    legalNameInput.addEventListener('input', function() {
        brandNameInput.value = legalNameInput.value;
    });

    // Show/hide lokasi sesuai industri
    industrySelect.addEventListener('change', function() {
        if (industrySelect.value) {
            locationSection.classList.remove('hidden');
        } else {
            locationSection.classList.add('hidden');
        }
    });
    if (industrySelect.value) locationSection.classList.remove('hidden');

    // Validasi form untuk tombol submit
    function checkFormValidity() {
        if (form.checkValidity()) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-blue-400', 'cursor-not-allowed');
            submitBtn.classList.add('bg-blue-600', 'hover:bg-blue-700', 'cursor-pointer');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-blue-400', 'cursor-not-allowed');
            submitBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'cursor-pointer');
        }
    }
    form.addEventListener('input', checkFormValidity);
    checkFormValidity();
});
</script>

@endsection
