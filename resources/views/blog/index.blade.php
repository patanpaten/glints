@extends('layouts.blog')

@section('title', 'Glints TapLoker Blog - Tips Karir & Lowongan Kerja')

@section('content')
<!-- Hero Section -->
<section class="bg-yellow-400" style="background-color: #FFD700;">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-8">Glints TapLoker Blog</h1>
            
            <!-- Search Bar -->
            <form action="{{ route('blog') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari artikel, tips karir, atau topik..."
                           class="w-full px-6 py-4 bg-white border-0 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 text-lg">
                    <button type="submit" class="absolute right-2 top-2 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition duration-200">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Rekomendasi Glints Section - Full Width -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Rekomendasi Glints</h2>
            <div class="overflow-x-auto">
                <div class="flex gap-6 pb-4" style="width: max-content;">
                    @foreach($articles->take(4) as $article)
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200 flex-shrink-0" style="width: 320px;">
                            <div class="aspect-w-16 aspect-h-9">
                                @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-2">{{ $article->category }}</span>
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                    <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-blue-600">{{ $article->title }}</a>
                                </h3>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($article->excerpt, 80) }}</p>
                                <p class="text-xs text-gray-500">{{ $article->formatted_published_at }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex gap-8">
                <!-- Left Content -->
                <div class="w-2/3">

                    <!-- Artikel Terbaru Section -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terbaru</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($articles->skip(4)->take(4) as $article)
                                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-200">
                                    <div class="aspect-w-16 aspect-h-9">
                                        @if($article->featured_image)
                                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded mb-2">{{ $article->category }}</span>
                                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                            <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-blue-600">{{ $article->title }}</a>
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($article->excerpt, 100) }}</p>
                                        <p class="text-xs text-gray-500">{{ $article->formatted_published_at }} • {{ $article->read_time }} menit baca</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Right Sidebar -->
                <div class="w-1/3">
                    <!-- Paling Banyak Dibaca Section -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Paling Banyak Dibaca</h3>
                        <div class="space-y-4">
                            @foreach($articles->sortByDesc('views')->take(5) as $index => $article)
                                <div class="flex items-start space-x-3">
                                    <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white text-xs font-bold rounded-full flex items-center justify-center">{{ $index + 1 }}</span>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-sm text-gray-900 mb-1 line-clamp-2">
                                            <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-blue-600">{{ $article->title }}</a>
                                        </h4>
                                        <p class="text-xs text-gray-500">{{ number_format($article->views) }} views</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pilih Topik Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Pilih Topik</h2>
            <div class="mb-8">
                <!-- Baris pertama - 3 card -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    @php
                        $topicsRow1 = [
                            ['name' => 'Pencarian Kerja', 'color' => 'border-orange-400', 'bg' => 'bg-gray-100'],
                            ['name' => 'Kehidupan Profesional', 'color' => 'border-gray-400', 'bg' => 'bg-gray-100'],
                            ['name' => 'Perencanaan Karier', 'color' => 'border-yellow-400', 'bg' => 'bg-gray-100']
                        ];
                    @endphp
                    @foreach($topicsRow1 as $topic)
                        <a href="{{ route('blog', ['category' => [$topic['name']]]) }}" class="{{ $topic['bg'] }} border-b-4 {{ $topic['color'] }} p-6 rounded-lg text-center hover:shadow-md transition-shadow duration-200">
                            <span class="text-sm font-medium text-gray-800">{{ $topic['name'] }}</span>
                        </a>
                    @endforeach
                </div>
                
                <!-- Baris kedua - 2 card -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto">
                    @php
                        $topicsRow2 = [
                            ['name' => 'Mengatur Keuangan', 'color' => 'border-gray-400', 'bg' => 'bg-gray-100'],
                            ['name' => 'Kehidupan Mahasiswa', 'color' => 'border-blue-400', 'bg' => 'bg-gray-100']
                        ];
                    @endphp
                    @foreach($topicsRow2 as $topic)
                        <a href="{{ route('blog', ['category' => [$topic['name']]]) }}" class="{{ $topic['bg'] }} border-b-4 {{ $topic['color'] }} p-6 rounded-lg text-center hover:shadow-md transition-shadow duration-200">
                            <span class="text-sm font-medium text-gray-800">{{ $topic['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('blog') }}" class="inline-block border-2 border-blue-500 text-blue-500 px-8 py-3 rounded-lg font-medium hover:bg-blue-500 hover:text-white transition-colors duration-200">
                    LIHAT LAINNYA →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-black text-white py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row justify-between items-start gap-8">
                <!-- Logo Section -->
                <div class="lg:w-1/4">
                    <div class="flex items-center mb-3">
                        <div class="bg-white p-1 rounded mr-2">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L3.09 8.26L12 14L20.91 8.26L12 2Z"/>
                                <path d="M3.09 15.74L12 22L20.91 15.74L12 9.48L3.09 15.74Z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-bold">glints</div>
                            <div class="text-xs text-blue-400">TapLoker</div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-2 mb-3">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs font-medium transition-colors w-28">
                            BERLANGGANAN
                        </button>
                        <button class="bg-transparent border border-white hover:bg-white hover:text-black text-white px-3 py-1.5 rounded text-xs font-medium transition-colors w-28">
                            CARI LOWONGAN
                        </button>
                    </div>
                </div>
                
                <!-- Categories Grid -->
                <div class="lg:w-3/4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Kategori Topik -->
                        <div>
                            <h4 class="font-bold mb-3 text-white text-xs tracking-wider">KATEGORI TOPIK</h4>
                            <ul class="space-y-1.5 text-xs text-gray-400">
                                <li><a href="#" class="hover:text-white transition-colors">Pencarian Kerja</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Kehidupan Profesional</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Perencanaan Karier</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Kehidupan Mahasiswa</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Konten Eksklusif</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Kabar Glints</a></li>
                            </ul>
                        </div>
                        
                        <!-- Media Sosial -->
                        <div>
                            <h4 class="font-bold mb-3 text-white text-xs tracking-wider">MEDIA SOSIAL</h4>
                            <ul class="space-y-1.5 text-xs text-gray-400">
                                <li><a href="#" class="hover:text-white transition-colors">Facebook</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Twitter</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Instagram</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">LinkedIn</a></li>
                            </ul>
                        </div>
                        
                        <!-- Cari Kerja Berdasarkan -->
                        <div>
                            <h4 class="font-bold mb-3 text-white text-xs tracking-wider">CARI KERJA BERDASARKAN</h4>
                            <ul class="space-y-1.5 text-xs text-gray-400">
                                <li><a href="#" class="hover:text-white transition-colors">Lokasi</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Nama Perusahaan</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Kategori</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Paling Banyak Dicari</a></li>
                            </ul>
                        </div>
                        
                        <!-- Tambah Ilmu & Skill -->
                        <div>
                            <h4 class="font-bold mb-3 text-white text-xs tracking-wider">TAMBAH ILMU & SKILL</h4>
                            <ul class="space-y-1.5 text-xs text-gray-400">
                                <li><a href="#" class="hover:text-white transition-colors">All Topics</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Articles</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">author</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">Search</a></li>
                                <li><a href="#" class="hover:text-white transition-colors">tags</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>

<script>
function sortArticles(sortValue) {
    const url = new URL(window.location);
    url.searchParams.set('sort', sortValue);
    window.location.href = url.toString();
}
</script>
@endsection