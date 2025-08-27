@extends('company.layout-profil')

@section('title', 'Create Company Profile')

@section('content')
<div x-data="companyForm()" class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-md shadow-sm">

    {{-- Header --}}
    <div class="border-b px-6 py-3">
        <h2 class="text-base font-semibold text-gray-800">Profil Perusahaan</h2>
    </div>

    {{-- Body --}}
    <div class="p-6">
        <form action="{{ route('company.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Logo Upload --}}
            <div class="flex items-center space-x-4">
                <label class="w-24 h-24 flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <span class="text-lg text-gray-500 font-bold">+</span>
                    <span class="text-xs text-gray-600">Unggah</span>
                    <input type="file" name="logo" class="hidden" accept=".jpg,.jpeg,.png" x-model="form.logo">
                </label>
                <span class="text-sm text-gray-700">Logo Perusahaan</span>
            </div>

            {{-- Nama Legal Perusahaan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Legal Perusahaan<span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" x-model="form.name"
                       @input="form.brandName = form.name"
                       class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                       placeholder="Masukkan nama legal perusahaan anda" required>
            </div>

            {{-- Nama Brand --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Brand</label>
                <input type="text" x-model="form.brandName" readonly
                       class="w-full bg-gray-100 cursor-not-allowed rounded-md border border-gray-300 text-sm px-3 py-2">
            </div>

            {{-- Jumlah Karyawan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Jumlah Karyawan<span class="text-red-500">*</span>
                </label>
                <select name="employees_count" x-model="form.employees_count"
                        class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2" required>
                    <option value="">Pilih jumlah karyawan</option>
                    <option value="1-10">1 - 10 karyawan</option>
                    <option value="11-50">11 - 50 karyawan</option>
                    <option value="51-200">51 - 200 karyawan</option>
                    <option value="200+">200+ karyawan</option>
                </select>
            </div>

            {{-- Industri --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Industri<span class="text-red-500">*</span>
                </label>
                <select name="industry" x-model="form.industry"
                        class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2" required>
                    <option value="">Belum dipilih</option>
                    <option value="IT">Teknologi Informasi</option>
                    <option value="Finance">Keuangan</option>
                    <option value="Manufacture">Manufaktur</option>
                    <option value="Other">Lainnya</option>
                </select>
            </div>

            {{-- Lokasi (muncul kalau industri sudah dipilih) --}}
            <template x-if="form.industry">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi<span class="text-red-500">*</span></label>
                        <input type="text" name="province" x-model="form.province"
                               class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                               placeholder="Masukkan provinsi">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kota<span class="text-red-500">*</span></label>
                        <input type="text" name="city" x-model="form.city"
                               class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                               placeholder="Masukkan kota">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap<span class="text-red-500">*</span></label>
                        <textarea name="address" rows="3" x-model="form.address"
                                  class="w-full rounded-md border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2"
                                  placeholder="Gedung & lantai, jalan, kelurahan, kecamatan, dst."></textarea>
                    </div>
                </div>
            </template>

            {{-- Button --}}
            <div class="flex justify-end">
                <button type="submit"
                        :disabled="!isFormValid"
                        class="px-6 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2.5 rounded-md disabled:bg-gray-400 disabled:cursor-not-allowed">
                    Buat Perusahaan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function companyForm() {
    return {
        form: {
            logo: null,
            name: '',
            brandName: '',
            employees_count: '',
            industry: '',
            province: '',
            city: '',
            address: ''
        },
        get isFormValid() {
            return this.form.name && this.form.brandName && this.form.employees_count &&
                   this.form.industry && this.form.province && this.form.city && this.form.address;
        }
    }
}
</script>
@endsection
