@extends('layouts.app')

@section('title', 'Glints - Platform Lowongan Kerja Terbesar di Indonesia')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center mb-8">
                <!-- Search Form -->
                <form class="SearchSectionsc__Form-sc-js5c89-0 fMUdgD" action="{{ route('jobs.index') }}" method="GET">
                    <h1 class="SearchSectionsc__Title-sc-js5c89-1 fcyPfe">Cari 40,000+ loker di Indonesia</h1>
                    <div class="SearchSectionsc__Container-sc-js5c89-2 fnMmus">
                        <div class="SearchSectionsc__FieldWrapper-sc-js5c89-3 kHnMMk">
                            <div data-prefix="true" data-suffix="false" class="InputStyle__StyledContainer-sc-15z2mnd-0 uZcgU">
                                <div class="InputStyle__StyledPrefixContainer-sc-15z2mnd-1 iKYIJd">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m18.031 16.617 4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617Zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15Z"></path>
                                    </svg>
                                </div>
                                <input placeholder="Cari Nama Pekerjaan, Skill, dan Perusahaan" type="text" name="keyword" class="InputStyle__StyledInput-sc-15z2mnd-4 efLWzC" value="{{ request('keyword') }}" fdprocessedid="10652">
                            </div>
                        </div>
                        <div class="SearchSectionsc__LocationFieldWrapper-sc-js5c89-4 jKKJYV">
                            <div tabindex="-1" aria-controls="popover-gez8C7rCyRaiCGYikKG9y" aria-owns="popover-gez8C7rCyRaiCGYikKG9y" aria-expanded="false">
                                <div width="100%" class="SelectStyle__ActivatorWrapper-sc-c6sc8m-1 fshVEV">
                                    <div class="InputStyle__StyledContainer-sc-15z2mnd-0 SearchableSelectInputStyle__StyledContainer-sc-1oj168h-0 caYITs fbNcJg select-input-container" data-error="false" data-disabled="false" width="100%">
                                        <div class="InputStyle__StyledPrefixContainer-sc-15z2mnd-1 iKYIJd">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_1377_1005)">
                                                    <path d="M10 20.4921L4.69667 15.1888C3.64779 14.1399 2.93349 12.8035 2.64411 11.3486C2.35473 9.89379 2.50326 8.38579 3.07092 7.01535C3.63858 5.64491 4.59987 4.47358 5.83324 3.64947C7.0666 2.82536 8.51665 2.3855 10 2.3855C11.4834 2.3855 12.9334 2.82536 14.1668 3.64947C15.4001 4.47358 16.3614 5.64491 16.9291 7.01535C17.4968 8.38579 17.6453 9.89379 17.3559 11.3486C17.0665 12.8035 16.3522 14.1399 15.3033 15.1888L10 20.4921ZM14.125 14.0104C14.9408 13.1946 15.4963 12.1552 15.7213 11.0237C15.9463 9.89212 15.8308 8.71926 15.3892 7.6534C14.9477 6.58753 14.2 5.67652 13.2408 5.03557C12.2815 4.39462 11.1537 4.05252 10 4.05252C8.8463 4.05252 7.71851 4.39462 6.75924 5.03557C5.79997 5.67652 5.05229 6.58753 4.61076 7.6534C4.16923 8.71926 4.05368 9.89212 4.27871 11.0237C4.50374 12.1552 5.05926 13.1946 5.875 14.0104L10 18.1354L14.125 14.0104ZM10 11.5521C9.55798 11.5521 9.13405 11.3765 8.82149 11.0639C8.50893 10.7514 8.33334 10.3275 8.33334 9.88543C8.33334 9.44341 8.50893 9.01948 8.82149 8.70692C9.13405 8.39436 9.55798 8.21877 10 8.21877C10.442 8.21877 10.866 8.39436 11.1785 8.70692C11.4911 9.01948 11.6667 9.44341 11.6667 9.88543C11.6667 10.3275 11.4911 10.7514 11.1785 11.0639C10.866 11.3765 10.442 11.5521 10 11.5521Z" fill="#666666"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1377_1005">
                                                        <rect width="20" height="20" fill="white" transform="translate(0 0.71875)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="SearchableSelectInputStyle__StyledSelectedValue-sc-1oj168h-2 QbWBZ searchable-select">
                                            <span class="SearchableSelectInputStyle__StyledSelected-sc-1oj168h-1 fJMxBI">Semua Kota/Provinsi</span>
                                        </div>
                                        <div class="InputStyle__StyledPrefixContainer-sc-15z2mnd-1 InputStyle__StyledSuffixContainer-sc-15z2mnd-2 SearchableSelectInputStyle__ClearSelectedContainer-sc-1oj168h-4 iKYIJd ieGlAT fINCTV">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="clear-icon" style="cursor: pointer;">
                                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586Z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button data-icon="false" aria-label="Search button" type="submit" class="ButtonStyle__StyledButton-sc-8t0676-0 kJeuuE PrimaryButtonStyle__PrimaryButton-sc-1iczr6c-0 fcHdBX" fdprocessedid="4gpb7l">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Popular Categories -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Kategori Populer</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-user-tie text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Admin & HR</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-bullhorn text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Marketing</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-cogs text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Operasional</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-truck text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Supply Chain & Logistik</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-chart-line text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Business Development & Sales</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-calculator text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Akuntansi & Keuangan</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-paint-brush text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Desain</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-newspaper text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Media & Komunikasi</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-laptop-code text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">IT</p>
                    </a>
                    <a href="#" class="bg-white border border-gray-200 rounded-lg p-3 text-center hover:border-orange-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-graduation-cap text-orange-500 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-700">Fresh Graduate</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 bg-primary text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-4">Siap Memulai Perjalanan Karir Anda?</h2>
            <p class="text-xl mb-6">Bergabunglah dengan ribuan pencari kerja yang telah menemukan pekerjaan impian mereka melalui Glints.</p>
            <div class="space-x-4">
                <a href="{{ route('register') }}" class="bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200">Daftar Sekarang</a>
                <a href="{{ route('jobs.index') }}" class="border border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition duration-200">Jelajahi Lowongan</a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
/* Custom styles for search form */
.SearchSectionsc__Form-sc-js5c89-0.fMUdgD {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.SearchSectionsc__Title-sc-js5c89-1.fcyPfe {
    font-size: 2.5rem;
    font-weight: bold;
    color: #1a202c;
    margin-bottom: 1rem;
}

.SearchSectionsc__Container-sc-js5c89-2.fnMmus {
    display: flex;
    gap: 0.5rem;
    align-items: center;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    padding: 0.5rem;
}

.SearchSectionsc__FieldWrapper-sc-js5c89-3.kHnMMk {
    flex: 1;
}

.SearchSectionsc__LocationFieldWrapper-sc-js5c89-4.jKKJYV {
    width: 300px;
}

.InputStyle__StyledContainer-sc-15z2mnd-0.uZcgU {
    display: flex;
    align-items: center;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    background: white;
    padding: 0.75rem;
}

.InputStyle__StyledPrefixContainer-sc-15z2mnd-1.iKYIJd {
    margin-right: 0.75rem;
    color: #666666;
}

.InputStyle__StyledPrefixContainer-sc-15z2mnd-1.iKYIJd svg {
    width: 20px;
    height: 20px;
}

.InputStyle__StyledInput-sc-15z2mnd-4.efLWzC {
    border: none;
    outline: none;
    flex: 1;
    font-size: 1rem;
    color: #1a202c;
}

.InputStyle__StyledInput-sc-15z2mnd-4.efLWzC::placeholder {
    color: #a0aec0;
}

.SearchableSelectInputStyle__StyledContainer-sc-1oj168h-0.caYITs.fbNcJg {
    display: flex;
    align-items: center;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    background: white;
    padding: 0.75rem;
    cursor: pointer;
}

.SearchableSelectInputStyle__StyledSelectedValue-sc-1oj168h-2.QbWBZ {
    flex: 1;
    margin: 0 0.75rem;
}

.SearchableSelectInputStyle__StyledSelected-sc-1oj168h-1.fJMxBI {
    color: #1a202c;
    font-size: 1rem;
}

.ButtonStyle__StyledButton-sc-8t0676-0.kJeuuE.PrimaryButtonStyle__PrimaryButton-sc-1iczr6c-0.fcHdBX {
    background: #3182ce;
    color: white;
    border: none;
    border-radius: 0.375rem;
    padding: 0.75rem 2rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
}

.ButtonStyle__StyledButton-sc-8t0676-0.kJeuuE.PrimaryButtonStyle__PrimaryButton-sc-1iczr6c-0.fcHdBX:hover {
    background: #2c5aa0;
}

.clear-icon {
    width: 16px;
    height: 16px;
    color: #666666;
}

@media (max-width: 768px) {
    .SearchSectionsc__Container-sc-js5c89-2.fnMmus {
        flex-direction: column;
        gap: 1rem;
    }
    
    .SearchSectionsc__LocationFieldWrapper-sc-js5c89-4.jKKJYV {
        width: 100%;
    }
    
    .SearchSectionsc__Title-sc-js5c89-1.fcyPfe {
        font-size: 2rem;
    }
}
</style>
@endpush