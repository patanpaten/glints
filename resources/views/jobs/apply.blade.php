@extends('layouts.app')

@section('title', 'Lamar Pekerjaan: ' . $job->title . ' - ' . $job->company->name . ' | Glints')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('jobs.show', $job->slug) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke detail pekerjaan
            </a>
        </div>
        
        <!-- Application Form Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b">
                <div class="flex items-center">
                    @if($job->company->logo)
                        <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-16 h-16 object-contain mr-4">
                    @else
                        <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-md mr-4">
                            <span class="text-gray-500 text-xl font-bold">{{ substr($job->company->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Lamar Pekerjaan</h1>
                        <p class="text-gray-600">{{ $job->title }} - {{ $job->company->name }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Form -->
            <form action="{{ route('jobs.submit-application', $job->slug) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                
                <!-- Profile Information -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Profil</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ $jobSeeker->user->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" readonly>
                            <p class="text-xs text-gray-500 mt-1">Nama dari profil kamu</p>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ $jobSeeker->user->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" readonly>
                            <p class="text-xs text-gray-500 mt-1">Email dari profil kamu</p>
                        </div>
                        <div>
                            <label for="phone" class="block text-gray-700 text-sm font-medium mb-2">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" value="{{ $jobSeeker->phone }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" readonly>
                            <p class="text-xs text-gray-500 mt-1">Nomor telepon dari profil kamu</p>
                        </div>
                    </div>
                </div>
                
                <!-- Application Details -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Lamaran</h2>
                    
                    <!-- Cover Letter -->
                    <div class="mb-6">
                        <label for="cover_letter" class="block text-gray-700 text-sm font-medium mb-2">Surat Lamaran <span class="text-red-500">*</span></label>
                        <textarea id="cover_letter" name="cover_letter" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('cover_letter') border-red-500 @enderror" placeholder="Jelaskan mengapa kamu tertarik dengan posisi ini dan mengapa kamu adalah kandidat yang tepat...">{{ old('cover_letter') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Tulis surat lamaran yang menarik untuk meningkatkan peluang kamu diterima</p>
                        @error('cover_letter')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Resume Upload -->
                    <div class="mb-6">
                        <label for="resume" class="block text-gray-700 text-sm font-medium mb-2">Upload CV <span class="text-red-500">*</span></label>
                        <div class="flex items-center justify-center w-full">
                            <label for="resume" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-gray-500 text-2xl mb-2"></i>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-500">PDF, DOC, atau DOCX (Maks. 5MB)</p>
                                </div>
                                <input id="resume" name="resume" type="file" class="hidden" accept=".pdf,.doc,.docx" />
                            </label>
                        </div>
                        <div id="file-name" class="mt-2 text-sm text-gray-600 hidden">
                            <span class="font-medium">File terpilih:</span> <span id="selected-file"></span>
                        </div>
                        @error('resume')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Expected Salary -->
                    <div class="mb-6">
                        <label for="expected_salary" class="block text-gray-700 text-sm font-medium mb-2">Ekspektasi Gaji (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" id="expected_salary" name="expected_salary" value="{{ old('expected_salary') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('expected_salary') border-red-500 @enderror" placeholder="Contoh: 8000000">
                        <p class="text-xs text-gray-500 mt-1">Masukkan ekspektasi gaji bulanan dalam Rupiah (tanpa titik atau koma)</p>
                        @error('expected_salary')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Notice Period -->
                    <div class="mb-6">
                        <label for="notice_period" class="block text-gray-700 text-sm font-medium mb-2">Periode Pemberitahuan</label>
                        <select id="notice_period" name="notice_period" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="immediate">Bisa mulai segera</option>
                            <option value="1_week">1 minggu</option>
                            <option value="2_weeks">2 minggu</option>
                            <option value="1_month">1 bulan</option>
                            <option value="more_than_1_month">Lebih dari 1 bulan</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Berapa lama waktu yang kamu butuhkan sebelum bisa mulai bekerja</p>
                    </div>
                </div>
                
                <!-- Additional Questions -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Pertanyaan Tambahan</h2>
                    
                    <!-- Why Join -->
                    <div class="mb-6">
                        <label for="why_join" class="block text-gray-700 text-sm font-medium mb-2">Mengapa kamu ingin bergabung dengan {{ $job->company->name }}? <span class="text-red-500">*</span></label>
                        <textarea id="why_join" name="why_join" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('why_join') border-red-500 @enderror" placeholder="Jelaskan alasan kamu ingin bergabung dengan perusahaan ini...">{{ old('why_join') }}</textarea>
                        @error('why_join')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Relevant Experience -->
                    <div class="mb-6">
                        <label for="relevant_experience" class="block text-gray-700 text-sm font-medium mb-2">Ceritakan pengalaman relevan yang kamu miliki untuk posisi ini <span class="text-red-500">*</span></label>
                        <textarea id="relevant_experience" name="relevant_experience" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('relevant_experience') border-red-500 @enderror" placeholder="Jelaskan pengalaman relevan yang kamu miliki...">{{ old('relevant_experience') }}</textarea>
                        @error('relevant_experience')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Terms and Submit -->
                <div>
                    <div class="mb-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500 @error('terms') border-red-500 @enderror" required>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700">Saya menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat dan Ketentuan</a> serta <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> Glints</label>
                                @error('terms')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-md transition duration-200">Kirim Lamaran</button>
                    <p class="text-sm text-gray-500 text-center mt-4">Dengan mengirim lamaran, kamu mengizinkan {{ $job->company->name }} untuk melihat profil dan CV kamu</p>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('resume').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        document.getElementById('selected-file').textContent = fileName;
        document.getElementById('file-name').classList.remove('hidden');
    });
</script>
@endpush
@endsection