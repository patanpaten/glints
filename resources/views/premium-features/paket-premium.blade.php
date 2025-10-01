@extends('company.app')

@section('title', 'Paket Berlangganan')

@section('content')
<!-- HEADER PERUSAHAAN -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
            <h2 class="fw-bold mb-0" style="color: #2D2D2D;">Paket Berlangganan</h2>
        </div>
    </div>

<div class="container py-5">

    <!-- Judul Halaman -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Pilih Paket Terbaik Anda</h2>
        <p class="text-muted">
            Anda sedang menggunakan Paket Standard dengan 5 slot loker.<br>
            Upgrade paket Anda untuk merekrut lebih dari 5 posisi bersamaan.
        </p>
    </div>

    <!-- Paket Pricing -->
<div class="row justify-content-center">
    <!-- Standard -->
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-start">
                <!-- Header Paket -->
                <div class="d-flex align-items-center gap-2 mb-2">
                    <!-- Ikon bintang -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="20" viewBox="0 0 24 24">
                        <path d="M12 .5 16 8l7.5 4-7.5 4-4 7.5L8 16 .5 12 8 8l4-7.5Z"></path>
                    </svg>
                    <h6 class="fw-bold text-dark mb-0">Standard</h6>
                </div>

                <!-- Deskripsi -->
                <p class="text-muted fw-semibold mb-2 ">5 Slot Aktif</p> <br><br><br><br><br>
                <h4 class="fw-bold text-dark mb-3">Gratis</h4>

                <!-- Tombol disabled -->
                <button class="btn fw-bold w-100 border" style="letter-spacing: 1px; background-color:#dee2e6; color:#6c757d;" disabled>
                    Paket Anda Saat Ini
                </button>
                <hr>
                <!-- List Fitur -->
                <p class="fw-semibold small mb-2">Terdapat:</p>
                <ul class="list-unstyled text-start small mb-0">
                    <li class="d-flex align-items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#6c757d" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                        <span class="ms-2">5 slot loker</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        fill="#6c757d" viewBox="0 0 24 24" class="flex-shrink-0 mt-1">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10
                                10-4.477 10-10 10Zm-.997-6 7.07-7.071-1.414-1.414-5.656
                                5.657-2.829-2.829-1.414 1.414L11.003 16Z"/>
                    </svg>
                    <span class="ms-2">Chat terbatas ke kandidat per lowongan</span>
                    </li>

                </ul>
            </div>
        </div>
    </div>


        <!-- Growth -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <!-- Ikon Growth -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="40" viewBox="0 0 24 24">
                            <path d="m8.55 1 2.973 5.576 5.575 2.973-5.575 2.974-2.974 5.575-2.973-5.575L0 9.549l5.576-2.973L8.549 1Zm11.965 15.468-1.858-3.485-1.859 3.485-3.484 1.859 3.484 1.858 1.859 3.485 1.858-3.485L24 18.327l-3.485-1.859Z"></path>
                        </svg>

                        <!-- Nama paket -->
                        <h6 class="fw-bold text-dark mb-1">Growth</h6>
                    </div>

                    <p class="text-muted small"><span class="fw-semibold">6-10 Slot Aktif </span><br> Perekrutan fleksibel untuk bisnis yang sedang berkembang.</p>
                    <p class="text-muted small">Mulai dari</p>
                    <h3 class="fw-bold text-dark">Rp 630.000</h3>
                    <button class="btn btn-primary w-100 mt-3 fw-bold" style="letter-spacing: 1px;">Pilih Paket</button>
                    <hr>
                    <ul class="list-unstyled text-start small">
                        <li class="fw-semibold">Terdapat :</li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Unlimited slot loker</span>
                        </li>

                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">VIP Membership</span>
                        </li>



                        <li class="d-flex align-items-start mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            fill="#0BAEEC" viewBox="0 0 24 24" class="flex-shrink-0 mt-1">
                            <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10
                                    10-4.477 10-10 10Zm-.997-6 7.07-7.071-1.414-1.414-5.656
                                    5.657-2.829-2.829-1.414 1.414L11.003 16Z"/>
                        </svg>
                        <span class="ms-2">Chat terbatas ke kandidat per lowongan</span>
                        </li>

                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Master Admin</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Dashboard Analytics</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Akses riwayat lamaran</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Lamaran Terdahulu</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Pesan Otomatis</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Scale -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <!-- Ikon Scale -->
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="28">
                            <path d="m17 1.208 1.32 2.473L20.792 5 18.32 6.319 17.002 8.79 15.68 6.32l-2.472-1.32 2.473-1.318L17 1.208ZM8 4.333l2.667 5 5 2.667-5 2.666-2.666 5-2.667-5-5-2.666 5-2.667 2.667-5Zm11.667 12-1.666-3.125-1.667 3.125L13.209 18l3.125 1.666 1.667 3.125 1.666-3.125L22.792 18l-3.125-1.667Z"></path>
                        </svg>
                        <!-- Nama paket -->
                        <h6 class="fw-bold text-dark mb-1">Scale</h6>

                    </div>

                    <p class="text-muted small"><span class="fw-semibold">20 Slot Aktif </span><br> Dirancang untuk kebutuhan perekrutan massal dan cepat.</p><br><br>
                    <h3 class="fw-bold text-dark">Rp 4.350.000</h3>
                    <button class="btn btn-primary w-100 mt-3 fw-bold" style="letter-spacing: 1px;">Pilih Paket</button>
                    <hr>
                    <ul class="list-unstyled text-start small">
                        <li class="fw-semibold">Terdapat :</li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Unlimited slot loker</span>
                        </li>

                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">VIP Membership</span>
                        </li>

                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Unduh data lamaran</span>
                        </li>

                        <li class="d-flex align-items-start mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            fill="#0BAEEC" viewBox="0 0 24 24" class="flex-shrink-0 mt-1">
                            <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10
                                    10-4.477 10-10 10Zm-.997-6 7.07-7.071-1.414-1.414-5.656
                                    5.657-2.829-2.829-1.414 1.414L11.003 16Z"/>
                        </svg>
                        <span class="ms-2">Chat terbatas ke kandidat per lowongan</span>
                        </li>

                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Master Admin</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Dashboard Analytics</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Akses riwayat lamaran</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Lamaran Terdahulu</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Pesan Otomatis</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Unlimited -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <!-- Ikon Unlimited -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#0BAEEC" height="28">
                            <path d="M3 12a3.5 3.5 0 0 1 3.5-3.5c1.204 0 2.02.434 2.7 1.113.726.727 1.285 1.72 1.926 2.873l.034.06c.6 1.082 1.283 2.311 2.227 3.255 1.008 1.008 2.316 1.699 4.113 1.699a5.5 5.5 0 1 0-4.158-9.1 23.58 23.58 0 0 1 1.122 1.857A3.5 3.5 0 1 1 17.5 15.5c-1.203 0-2.02-.434-2.7-1.113-.726-.727-1.285-1.72-1.926-2.873l-.034-.06c-.6-1.082-1.283-2.311-2.227-3.255C9.605 7.191 8.297 6.5 6.5 6.5a5.5 5.5 0 1 0 4.158 9.1 23.577 23.577 0 0 1-1.122-1.857A3.5 3.5 0 0 1 3 12Z"></path>
                        </svg>
                        <!-- Nama paket -->
                        <h6 class="fw-bold text-dark mb-1">Unlimited</h6>
                    </div>

                    <p class="text-muted small"><span class="fw-semibold">Unlimited Slot Aktif </span><br> Terbaik bagi rekruter yang terus-menerus merekrut dalam jumlah besar.</p><br><br><br>
                    <button class="btn btn-primary w-100 mt-3 fw-bold" style="letter-spacing: 1px;">Hubungi Sales</button>
                    <hr>
                    <ul class="list-unstyled text-start small">
                        <li class="fw-semibold">Terdapat :</li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Unlimited slot loker</span>
                        </li>

                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">VIP Membership</span>
                        </li>

                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Unduh data lamaran</span>
                        </li>

                        <li class="d-flex align-items-start mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                fill="#0BAEEC" viewBox="0 0 24 24" class="flex-shrink-0 mt-1">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10
                                        10-4.477 10-10 10Zm-.997-6 7.07-7.071-1.414-1.414-5.656
                                        5.657-2.829-2.829-1.414 1.414L11.003 16Z"/>
                            </svg>
                            <span class="ms-2">Chat terbatas ke kandidat per lowongan</span>
                            </li>

                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Master Admin</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Dashboard Analytics</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Akses riwayat lamaran</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Lamaran Terdahulu</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#0BAEEC" height="18" viewBox="0 0 24 24">
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10
                                        4.477 10 10-4.477 10-10 10Zm-.997-6
                                        7.07-7.071-1.414-1.414-5.656 5.657-2.829-2.829-1.414
                                        1.414L11.003 16Z"></path>
                            </svg>
                            <span class="ms-2">Fitur Pesan Otomatis</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
     <p class="text-muted small text-center">Harga tercantum dalam IDR, belum termasuk pajak.</p>

    <!-- Custom Plan -->
    <div class="text-center mt-5">
        <p class="fw-semibold mb-3">Butuh Paket yang Fleksibel?</p>
        <p class="text-muted small">Tim sales kami siap membantu menemukan dan merancang paket yang sesuai untuk Anda.</p>

        <!-- Tombol Hubungi Sales -->
        <button class="btn btn-outline-dark fw-bold d-flex justify-content-center align-items-center gap-2 mx-auto" style="letter-spacing: 1px;"
                data-bs-toggle="modal" data-bs-target="#hubungiSalesModal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18" viewBox="0 0 24 24" class="d-block">
                <path d="M16.8 19 14 22.5 11.2 19H6a1 1 0 0 1-1-1V7.103a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1V18a1 1 0 0 1-1 1h-5.2ZM2 2h17v2H3v11H1V3a1 1 0 0 1 1-1Z"></path>
            </svg>
            Hubungi Sales
        </button>

        <!-- Modal Hubungi Sales -->
        <div class="modal fade" id="hubungiSalesModal" tabindex="-1" aria-labelledby="hubungiSalesLabel" aria-hidden="true">
        <!-- Ganti modal-lg jadi default biar lebih kecil -->
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 620px;">
            <div class="modal-content rounded-3 shadow" style="min-height: 400px; max-height: 85vh;">

            <!-- Header -->
            <div class="modal-header flex-column align-items-start text-start">
                <h5 class="modal-title fw-bold" id="hubungiSalesLabel">Permohonan Bantuan</h5>
                <p class="text-muted small mb-0">
                Butuh bantuan tentang paket berlangganan? Kami siap membantu.<br>
                Bantuan akan diberikan dalam 1 hari kerja.
                </p>
            </div>

            <!-- Body (scrollable) -->
            <div class="modal-body text-start">
                <form>
                <!-- Nama Perusahaan -->
                <div class="mb-3">
                    <label class="form-label">Nama Perusahaan</label>
                    <p class="fw-semibold mb-0">pt ikan asin</p>
                </div>

                <!-- Nama Depan & Belakang -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Depan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control border-1  border-secondary" placeholder="Nama Depan" required>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Belakang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control border-1  border-secondary" placeholder="Nama Belakang" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control border-1  border-secondary" placeholder="Masukkan email" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon (e.g. +6281234567890) <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control border-1  border-secondary" placeholder="Nomor Telepon (e.g. +6281234567890)" required>
                </div>

                <!-- Select Bantuan -->
                <div class="mb-3">
                    <label class="form-label">Bantuan yang Dibutuhkan <span class="text-danger">*</span></label>
                    <select class="form-select border-1  border-secondary" required>
                    <option selected disabled>Pilih bantuan</option>
                    <option value="Upgrade Paket Berlangganan">Upgrade Paket Berlangganan</option>
                    <option value="Perpanjang Paket Berlangganan">Perpanjang Paket Berlangganan</option>
                    <option value="Pemakaian Platform & Paket Berlangganan">Pemakaian Platform & Paket Berlangganan</option>
                    <option value="Penambahan Saldo Cari CV">Penambahan Saldo Cari CV</option>
                    <option value="Konsultasi">Konsultasi</option>
                    <option value="Lainnya">Lainnya</option>
                    <option value="Verifikasi Perusahaan">Verifikasi Perusahaan</option>
                    </select>
                </div>

                <!-- Textarea dengan counter -->
                <div class="mb-3">
                    <label class="form-label">Jelaskan Kebutuhan Anda</label>
                    <textarea class="form-control border-1  border-secondary" rows="4" maxlength="300" style="min-height: 170px;"
                            placeholder="Jelaskan berapa loker yang ingin Anda pasang per bulan atau kebutuhan rekrutmen lainnya"
                            oninput="document.getElementById('charCount').textContent = this.value.length + ' / 300';"></textarea>
                    <div class="d-flex justify-content-end">
                    <small id="charCount" class="text-muted">0 / 300</small>
                    </div>
                </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark fw-semibold" style="letter-spacing: 1px;" data-bs-dismiss="modal">Batalkan</button>
                <button type="button" class="btn btn-primary fw-semibold" style="letter-spacing: 1px;">Kirim</button>
            </div>
            </div>
        </div>
        </div>

    </div>

</div>
@endsection
