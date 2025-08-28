@extends('company.layout-profil')

@section('title', 'Edit Company Profile')

@section('content')
<div x-data="companyForm()" class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-md shadow-sm">

    {{-- Header --}}
    <div class="border-b px-6 py-3">
        <h2 class="text-base font-semibold text-gray-800">Edit Profil Perusahaan</h2>
    </div>

    {{-- Body --}}
    <div class="p-6">
        <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Logo Upload --}}
            <div class="flex items-center space-x-4">
                <label class="w-24 h-24 flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <span class="text-lg text-gray-500 font-bold">+</span>
                    <span class="text-xs text-gray-600">Unggah</span>
                    <input type="file" name="logo" id="logo-input" class="hidden" accept=".jpg,.jpeg,.png">
                </label>
                <div id="logo-preview" class="w-20 h-20">
                    @if($company->logo)
                        <img src="{{ asset('storage/'.$company->logo) }}" class="w-20 h-20 object-cover rounded-md border" id="current-logo">
                    @else
                        <div class="w-20 h-20 bg-gray-100 rounded-md border flex items-center justify-center" id="no-logo">
                            <span class="text-xs text-gray-400">No Logo</span>
                        </div>
                    @endif
                </div>
                <span class="text-sm text-gray-700">Logo Perusahaan</span>
            </div>

            {{-- Nama Legal Perusahaan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Legal Perusahaan<span class="text-red-500">*</span>
                </label>
                <input type="text" name="name"
                       class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                       value="{{ old('name', $company->name) }}" required>
            </div>

            {{-- Deskripsi Perusahaan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi Perusahaan<span class="text-red-500">*</span>
                </label>
                <textarea name="description" rows="3"
                          class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2" required>{{ old('description', $company->description) }}</textarea>
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
                <select name="industry"
                        class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2" required>
                    <option value="">Belum dipilih</option>
                    <option value="IT" @selected(old('industry', $company->industry) == 'IT')>Teknologi Informasi</option>
                    <option value="Finance" @selected(old('industry', $company->industry) == 'Finance')>Keuangan</option>
                    <option value="Manufacture" @selected(old('industry', $company->industry) == 'Manufacture')>Manufaktur</option>
                    <option value="Other" @selected(old('industry', $company->industry) == 'Other')>Lainnya</option>
                </select>
            </div>

            {{-- Lokasi --}}
            <div class="space-y-4">
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
                              class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2" required>{{ old('address', $company->address) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos<span class="text-red-500">*</span></label>
                    <input type="text" name="postal_code"
                           class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                           value="{{ old('postal_code', $company->postal_code) }}" required>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon<span class="text-red-500">*</span></label>
                    <input type="text" name="phone"
                           class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                           value="{{ old('phone', $company->phone) }}" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Website (Opsional)</label>
                    <input type="url" name="website"
                           class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                           value="{{ old('website', $company->website) }}" placeholder="https://">
                </div>
            </div>

            {{-- Button --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2.5 rounded-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoInput = document.getElementById('logo-input');
    const logoPreview = document.getElementById('logo-preview');
    
    logoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                alert('Hanya file JPG, JPEG, dan PNG yang diizinkan.');
                logoInput.value = '';
                return;
            }
            
            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB.');
                logoInput.value = '';
                return;
            }
            
            // Buat preview
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.innerHTML = `<img src="${e.target.result}" class="w-20 h-20 object-cover rounded-md border" id="preview-logo">`;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>

@endsection
