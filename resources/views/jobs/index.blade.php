@extends('layouts.app')

@section('title', 'Lowongan Kerja Terbaru di Indonesia | Glints')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-6 border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-stretch">

                    <!-- Input Keyword -->
                    <div class="flex-1">
                        <div class="relative flex items-center border border-gray-300 rounded-lg bg-white px-11 py-2">
                            <!-- Input -->
                            <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}"
                                placeholder="Cari Nama Pekerjaan, Skill, dan Perusahaan"
                                aria-label="Cari Nama Pekerjaan, Skill, dan Perusahaan"
                                class="flex-1 text-gray-900 text-sm focus:outline-none placeholder-gray-500">
                            <!-- Icon Search (posisi kanan input secara DOM, tapi tetap terlihat di kiri dengan absolute) -->
                            <div class="absolute left-3 text-gray-500 pointer-events-none">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 100 100">
                                    <path
                                        d="M70 43c0-14.886-12.114-27-27-27S16 28.114 16 43s12.114 27 27 27 27-12.114 27-27zm30 49.308c0 4.206-3.486 7.692-7.692 7.692-2.044 0-4.027-.841-5.409-2.284L66.286 77.163c-7.031 4.868-15.445 7.452-23.978 7.452C18.93 84.615 0 65.685 0 42.308 0 18.93 18.93 0 42.308 0c23.377 0 42.307 18.93 42.307 42.308 0 8.533-2.584 16.947-7.452 23.978L97.776 86.9C99.16 88.281 100 90.264 100 92.308z" />
                                </svg>
                            </div>
                        </div>
                    </div>



                    <!-- Input Location -->
                    <div class="flex-1 md:w-64">
                        <div class="relative flex items-center border border-gray-300 rounded-lg bg-white px-9 py-2">
                            <!-- Input -->
                            <input type="text" id="location" name="location"
                                value="{{ request('location') ?? 'All Cities/Provinces' }}"
                                placeholder="Tambahkan kota/provinsi" aria-label="Tambahkan kota/provinsi"
                                class="flex-1 text-gray-900 text-sm focus:outline-none placeholder-gray-500">

                            <!-- Start Icon -->
                            <div class="absolute left-3 text-gray-500 pointer-events-none">
                                <svg width="1em" height="1em" fill="currentColor" viewBox="0 0 100 100">
                                    <path
                                        d="M24.491 10.268C31.485 3.423 39.893 0 49.714 0c9.822 0 18.23 3.423 25.224 10.268 6.994 6.845 10.49 15.104 10.49 24.777 0 7.738-2.976 17.038-8.928 27.901-5.952 10.864-11.905 19.792-17.857 26.786L49.714 100c-1.041-1.042-2.343-2.493-3.906-4.353-1.562-1.86-4.39-5.468-8.482-10.826-4.092-5.357-7.701-10.565-10.826-15.625-3.125-5.06-5.99-10.788-8.594-17.187C15.302 45.61 14 39.955 14 35.045c0-9.673 3.497-17.932 10.491-24.777zm16.072 33.705c2.53 2.381 5.58 3.572 9.151 3.572 3.572 0 6.585-1.228 9.04-3.683 2.456-2.456 3.684-5.395 3.684-8.817 0-3.423-1.228-6.362-3.684-8.817-2.455-2.456-5.468-3.683-9.04-3.683-3.571 0-6.585 1.227-9.04 3.683-2.455 2.455-3.683 5.394-3.683 8.817 0 3.422 1.19 6.398 3.571 8.928z" />
                                </svg>
                            </div>

                            <!-- Clear Button -->
                            @if (request('location'))
                                <button type="button" onclick="document.getElementById('location').value=''"
                                    aria-label="Clear input" class="absolute right-3 text-gray-400 hover:text-gray-600">
                                    <svg width="1em" height="1em" fill="currentColor" viewBox="0 0 100 100">
                                        <path
                                            d="M14.509 14.732C24.33 4.911 36.16 0 50 0c13.84 0 25.632 4.873 35.38 14.62C95.126 24.369 100 36.16 100 50c0 13.84-4.873 25.632-14.62 35.38C75.631 95.126 63.84 100 50 100c-13.84 0-25.632-4.873-35.38-14.62C4.874 75.631 0 63.84 0 50c0-13.84 4.836-25.595 14.509-35.268zm59.598 52.01L57.367 50 74.33 33.259c.893-.893.893-1.786 0-2.679l-4.91-4.687c-.447-.447-.893-.67-1.34-.67-.297 0-.67.223-1.116.67L50 42.41 33.036 25.893c-.447-.447-.819-.67-1.116-.67-.447 0-.893.223-1.34.67l-4.687 4.687c-.893.893-.893 1.786 0 2.679L42.857 50 25.893 66.964c-.298.15-.447.521-.447 1.116 0 .596.15 1.042.447 1.34l4.687 4.91c.298.298.744.447 1.34.447.595 0 1.041-.149 1.339-.447L50 57.366l16.964 16.741c.447.447.819.67 1.116.67.447 0 .893-.223 1.34-.67l4.687-4.687c.447-.298.67-.744.67-1.34 0-.446-.223-.892-.67-1.339z" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>


                    <!-- Button -->
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 rounded-lg transition flex items-center justify-center">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </section>


    <!-- Main Content -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <!-- Page Title -->
            <div class="max-w-6xl mx-auto mb-6">
                <h1 class="text-1.5xl font-bold text-gray-900 mb-2 total-job-search-result-count">
                    Lowongan Kerja di Indonesia
                </h1>
            </div>

            <div class="flex flex-col lg:flex-row gap-4 max-w-6xl mx-auto" style="display: flex; align-items: flex-start;">


                <!-- Sidebar Filter -->
                <aside class="w-full flex-shrink-0" style="width: 350px; min-width: 350px; max-width: 350px;">
                    <div class="sticky top-4 bg-white rounded-lg border border-gray-200 flex flex-col h-[calc(100vh-2rem)]">

                        <!-- QR Card -->
                        <div class="p-3 border-b border-gray-200 bg-white">
                            <div class="flex items-center p-4 border border-gray-200 rounded-lg bg-white shadow-sm">
                                <!-- QR Code Icon -->
                                <div class="flex-shrink-0">
                                    <!-- SVG QR -->
                                    <svg xmlns="http://www.w3.org/2000/svg" height="64" width="64"
                                        viewBox="0 0 29 29" fill="currentColor">
                                        <path
                                            d="M 0 0 l 1 0 0 1 -1 0 Z M 1 0 l 1 0 0 1 -1 0 Z M 2 0 l 1 0 0 1 -1 0 Z M 3 0 l 1 0 0 1 -1 0 Z M 4 0 l 1 0 0 1 -1 0 Z M 5 0 l 1 0 0 1 -1 0 Z M 6 0 l 1 0 0 1 -1 0 Z    M 10 0 l 1 0 0 1 -1 0 Z   M 13 0 l 1 0 0 1 -1 0 Z M 14 0 l 1 0 0 1 -1 0 Z M 15 0 l 1 0 0 1 -1 0 Z  M 17 0 l 1 0 0 1 -1 0 Z M 18 0 l 1 0 0 1 -1 0 Z M 19 0 l 1 0 0 1 -1 0 Z   M 22 0 l 1 0 0 1 -1 0 Z M 23 0 l 1 0 0 1 -1 0 Z M 24 0 l 1 0 0 1 -1 0 Z M 25 0 l 1 0 0 1 -1 0 Z M 26 0 l 1 0 0 1 -1 0 Z M 27 0 l 1 0 0 1 -1 0 Z M 28 0 l 1 0 0 1 -1 0 Z M 0 1 l 1 0 0 1 -1 0 Z      M 6 1 l 1 0 0 1 -1 0 Z  M 8 1 l 1 0 0 1 -1 0 Z M 9 1 l 1 0 0 1 -1 0 Z M 10 1 l 1 0 0 1 -1 0 Z   M 13 1 l 1 0 0 1 -1 0 Z M 14 1 l 1 0 0 1 -1 0 Z M 15 1 l 1 0 0 1 -1 0 Z M 16 1 l 1 0 0 1 -1 0 Z  M 18 1 l 1 0 0 1 -1 0 Z  M 20 1 l 1 0 0 1 -1 0 Z  M 22 1 l 1 0 0 1 -1 0 Z      M 28 1 l 1 0 0 1 -1 0 Z M 0 2 l 1 0 0 1 -1 0 Z  M 2 2 l 1 0 0 1 -1 0 Z M 3 2 l 1 0 0 1 -1 0 Z M 4 2 l 1 0 0 1 -1 0 Z  M 6 2 l 1 0 0 1 -1 0 Z  M 8 2 l 1 0 0 1 -1 0 Z      M 14 2 l 1 0 0 1 -1 0 Z   M 17 2 l 1 0 0 1 -1 0 Z  M 19 2 l 1 0 0 1 -1 0 Z   M 22 2 l 1 0 0 1 -1 0 Z  M 24 2 l 1 0 0 1 -1 0 Z M 25 2 l 1 0 0 1 -1 0 Z M 26 2 l 1 0 0 1 -1 0 Z  M 28 2 l 1 0 0 1 -1 0 Z M 0 3 l 1 0 0 1 -1 0 Z  M 2 3 l 1 0 0 1 -1 0 Z M 3 3 l 1 0 0 1 -1 0 Z M 4 3 l 1 0 0 1 -1 0 Z  M 6 3 l 1 0 0 1 -1 0 Z   M 9 3 l 1 0 0 1 -1 0 Z   M 12 3 l 1 0 0 1 -1 0 Z  M 14 3 l 1 0 0 1 -1 0 Z    M 18 3 l 1 0 0 1 -1 0 Z M 19 3 l 1 0 0 1 -1 0 Z   M 22 3 l 1 0 0 1 -1 0 Z  M 24 3 l 1 0 0 1 -1 0 Z M 25 3 l 1 0 0 1 -1 0 Z M 26 3 l 1 0 0 1 -1 0 Z  M 28 3 l 1 0 0 1 -1 0 Z M 0 4 l 1 0 0 1 -1 0 Z  M 2 4 l 1 0 0 1 -1 0 Z M 3 4 l 1 0 0 1 -1 0 Z M 4 4 l 1 0 0 1 -1 0 Z  M 6 4 l 1 0 0 1 -1 0 Z  M 8 4 l 1 0 0 1 -1 0 Z M 9 4 l 1 0 0 1 -1 0 Z M 10 4 l 1 0 0 1 -1 0 Z  M 12 4 l 1 0 0 1 -1 0 Z M 13 4 l 1 0 0 1 -1 0 Z  M 15 4 l 1 0 0 1 -1 0 Z M 16 4 l 1 0 0 1 -1 0 Z M 17 4 l 1 0 0 1 -1 0 Z M 18 4 l 1 0 0 1 -1 0 Z    M 22 4 l 1 0 0 1 -1 0 Z  M 24 4 l 1 0 0 1 -1 0 Z M 25 4 l 1 0 0 1 -1 0 Z M 26 4 l 1 0 0 1 -1 0 Z  M 28 4 l 1 0 0 1 -1 0 Z M 0 5 l 1 0 0 1 -1 0 Z      M 6 5 l 1 0 0 1 -1 0 Z  M 8 5 l 1 0 0 1 -1 0 Z  M 10 5 l 1 0 0 1 -1 0 Z  M 12 5 l 1 0 0 1 -1 0 Z  M 14 5 l 1 0 0 1 -1 0 Z M 15 5 l 1 0 0 1 -1 0 Z   M 18 5 l 1 0 0 1 -1 0 Z M 19 5 l 1 0 0 1 -1 0 Z M 20 5 l 1 0 0 1 -1 0 Z  M 22 5 l 1 0 0 1 -1 0 Z      M 28 5 l 1 0 0 1 -1 0 Z M 0 6 l 1 0 0 1 -1 0 Z M 1 6 l 1 0 0 1 -1 0 Z M 2 6 l 1 0 0 1 -1 0 Z M 3 6 l 1 0 0 1 -1 0 Z M 4 6 l 1 0 0 1 -1 0 Z M 5 6 l 1 0 0 1 -1 0 Z M 6 6 l 1 0 0 1 -1 0 Z  M 8 6 l 1 0 0 1 -1 0 Z  M 10 6 l 1 0 0 1 -1 0 Z  M 12 6 l 1 0 0 1 -1 0 Z  M 14 6 l 1 0 0 1 -1 0 Z  M 16 6 l 1 0 0 1 -1 0 Z  M 18 6 l 1 0 0 1 -1 0 Z  M 20 6 l 1 0 0 1 -1 0 Z  M 22 6 l 1 0 0 1 -1 0 Z M 23 6 l 1 0 0 1 -1 0 Z M 24 6 l 1 0 0 1 -1 0 Z M 25 6 l 1 0 0 1 -1 0 Z M 26 6 l 1 0 0 1 -1 0 Z M 27 6 l 1 0 0 1 -1 0 Z M 28 6 l 1 0 0 1 -1 0 Z         M 8 7 l 1 0 0 1 -1 0 Z  M 10 7 l 1 0 0 1 -1 0 Z M 11 7 l 1 0 0 1 -1 0 Z    M 15 7 l 1 0 0 1 -1 0 Z M 16 7 l 1 0 0 1 -1 0 Z M 17 7 l 1 0 0 1 -1 0 Z M 18 7 l 1 0 0 1 -1 0 Z M 19 7 l 1 0 0 1 -1 0 Z M 20 7 l 1 0 0 1 -1 0 Z         M 0 8 l 1 0 0 1 -1 0 Z M 1 8 l 1 0 0 1 -1 0 Z  M 3 8 l 1 0 0 1 -1 0 Z   M 6 8 l 1 0 0 1 -1 0 Z M 7 8 l 1 0 0 1 -1 0 Z    M 11 8 l 1 0 0 1 -1 0 Z M 12 8 l 1 0 0 1 -1 0 Z M 13 8 l 1 0 0 1 -1 0 Z M 14 8 l 1 0 0 1 -1 0 Z    M 18 8 l 1 0 0 1 -1 0 Z M 19 8 l 1 0 0 1 -1 0 Z   M 22 8 l 1 0 0 1 -1 0 Z M 23 8 l 1 0 0 1 -1 0 Z M 24 8 l 1 0 0 1 -1 0 Z  M 26 8 l 1 0 0 1 -1 0 Z M 27 8 l 1 0 0 1 -1 0 Z       M 5 9 l 1 0 0 1 -1 0 Z    M 9 9 l 1 0 0 1 -1 0 Z  M 11 9 l 1 0 0 1 -1 0 Z M 12 9 l 1 0 0 1 -1 0 Z M 13 9 l 1 0 0 1 -1 0 Z   M 16 9 l 1 0 0 1 -1 0 Z      M 22 9 l 1 0 0 1 -1 0 Z   M 25 9 l 1 0 0 1 -1 0 Z   M 28 9 l 1 0 0 1 -1 0 Z  M 1 10 l 1 0 0 1 -1 0 Z  M 3 10 l 1 0 0 1 -1 0 Z  M 5 10 l 1 0 0 1 -1 0 Z M 6 10 l 1 0 0 1 -1 0 Z M 7 10 l 1 0 0 1 -1 0 Z M 8 10 l 1 0 0 1 -1 0 Z   M 11 10 l 1 0 0 1 -1 0 Z M 12 10 l 1 0 0 1 -1 0 Z M 13 10 l 1 0 0 1 -1 0 Z    M 17 10 l 1 0 0 1 -1 0 Z  M 19 10 l 1 0 0 1 -1 0 Z    M 23 10 l 1 0 0 1 -1 0 Z M 24 10 l 1 0 0 1 -1 0 Z M 25 10 l 1 0 0 1 -1 0 Z M 26 10 l 1 0 0 1 -1 0 Z M 27 10 l 1 0 0 1 -1 0 Z   M 1 11 l 1 0 0 1 -1 0 Z   M 4 11 l 1 0 0 1 -1 0 Z    M 8 11 l 1 0 0 1 -1 0 Z M 9 11 l 1 0 0 1 -1 0 Z M 10 11 l 1 0 0 1 -1 0 Z M 11 11 l 1 0 0 1 -1 0 Z M 12 11 l 1 0 0 1 -1 0 Z M 13 11 l 1 0 0 1 -1 0 Z  M 15 11 l 1 0 0 1 -1 0 Z   M 18 11 l 1 0 0 1 -1 0 Z  M 20 11 l 1 0 0 1 -1 0 Z M 21 11 l 1 0 0 1 -1 0 Z M 22 11 l 1 0 0 1 -1 0 Z M 23 11 l 1 0 0 1 -1 0 Z   M 26 11 l 1 0 0 1 -1 0 Z M 27 11 l 1 0 0 1 -1 0 Z  M 0 12 l 1 0 0 1 -1 0 Z  M 2 12 l 1 0 0 1 -1 0 Z    M 6 12 l 1 0 0 1 -1 0 Z    M 10 12 l 1 0 0 1 -1 0 Z M 11 12 l 1 0 0 1 -1 0 Z   M 14 12 l 1 0 0 1 -1 0 Z M 15 12 l 1 0 0 1 -1 0 Z  M 17 12 l 1 0 0 1 -1 0 Z     M 22 12 l 1 0 0 1 -1 0 Z   M 25 12 l 1 0 0 1 -1 0 Z  M 27 12 l 1 0 0 1 -1 0 Z M 28 12 l 1 0 0 1 -1 0 Z  M 1 13 l 1 0 0 1 -1 0 Z    M 5 13 l 1 0 0 1 -1 0 Z  M 7 13 l 1 0 0 1 -1 0 Z  M 9 13 l 1 0 0 1 -1 0 Z  M 11 13 l 1 0 0 1 -1 0 Z  M 13 13 l 1 0 0 1 -1 0 Z    M 17 13 l 1 0 0 1 -1 0 Z M 18 13 l 1 0 0 1 -1 0 Z M 19 13 l 1 0 0 1 -1 0 Z M 20 13 l 1 0 0 1 -1 0 Z M 21 13 l 1 0 0 1 -1 0 Z        M 0 14 l 1 0 0 1 -1 0 Z M 1 14 l 1 0 0 1 -1 0 Z M 2 14 l 1 0 0 1 -1 0 Z    M 6 14 l 1 0 0 1 -1 0 Z M 7 14 l 1 0 0 1 -1 0 Z M 8 14 l 1 0 0 1 -1 0 Z M 9 14 l 1 0 0 1 -1 0 Z M 10 14 l 1 0 0 1 -1 0 Z M 11 14 l 1 0 0 1 -1 0 Z  M 13 14 l 1 0 0 1 -1 0 Z M 14 14 l 1 0 0 1 -1 0 Z   M 17 14 l 1 0 0 1 -1 0 Z M 18 14 l 1 0 0 1 -1 0 Z   M 21 14 l 1 0 0 1 -1 0 Z    M 25 14 l 1 0 0 1 -1 0 Z M 26 14 l 1 0 0 1 -1 0 Z M 27 14 l 1 0 0 1 -1 0 Z M 28 14 l 1 0 0 1 -1 0 Z      M 5 15 l 1 0 0 1 -1 0 Z  M 7 15 l 1 0 0 1 -1 0 Z   M 10 15 l 1 0 0 1 -1 0 Z M 11 15 l 1 0 0 1 -1 0 Z    M 15 15 l 1 0 0 1 -1 0 Z M 16 15 l 1 0 0 1 -1 0 Z M 17 15 l 1 0 0 1 -1 0 Z M 18 15 l 1 0 0 1 -1 0 Z M 19 15 l 1 0 0 1 -1 0 Z M 20 15 l 1 0 0 1 -1 0 Z M 21 15 l 1 0 0 1 -1 0 Z M 22 15 l 1 0 0 1 -1 0 Z M 23 15 l 1 0 0 1 -1 0 Z M 24 15 l 1 0 0 1 -1 0 Z M 25 15 l 1 0 0 1 -1 0 Z  M 27 15 l 1 0 0 1 -1 0 Z   M 1 16 l 1 0 0 1 -1 0 Z    M 5 16 l 1 0 0 1 -1 0 Z M 6 16 l 1 0 0 1 -1 0 Z   M 9 16 l 1 0 0 1 -1 0 Z M 10 16 l 1 0 0 1 -1 0 Z  M 12 16 l 1 0 0 1 -1 0 Z M 13 16 l 1 0 0 1 -1 0 Z    M 17 16 l 1 0 0 1 -1 0 Z  M 19 16 l 1 0 0 1 -1 0 Z  M 21 16 l 1 0 0 1 -1 0 Z      M 27 16 l 1 0 0 1 -1 0 Z   M 1 17 l 1 0 0 1 -1 0 Z M 2 17 l 1 0 0 1 -1 0 Z M 3 17 l 1 0 0 1 -1 0 Z M 4 17 l 1 0 0 1 -1 0 Z    M 8 17 l 1 0 0 1 -1 0 Z M 9 17 l 1 0 0 1 -1 0 Z M 10 17 l 1 0 0 1 -1 0 Z  M 12 17 l 1 0 0 1 -1 0 Z M 13 17 l 1 0 0 1 -1 0 Z M 14 17 l 1 0 0 1 -1 0 Z  M 16 17 l 1 0 0 1 -1 0 Z  M 18 17 l 1 0 0 1 -1 0 Z   M 21 17 l 1 0 0 1 -1 0 Z M 22 17 l 1 0 0 1 -1 0 Z M 23 17 l 1 0 0 1 -1 0 Z  M 25 17 l 1 0 0 1 -1 0 Z   M 28 17 l 1 0 0 1 -1 0 Z M 0 18 l 1 0 0 1 -1 0 Z     M 5 18 l 1 0 0 1 -1 0 Z M 6 18 l 1 0 0 1 -1 0 Z   M 9 18 l 1 0 0 1 -1 0 Z M 10 18 l 1 0 0 1 -1 0 Z M 11 18 l 1 0 0 1 -1 0 Z M 12 18 l 1 0 0 1 -1 0 Z  M 14 18 l 1 0 0 1 -1 0 Z   M 17 18 l 1 0 0 1 -1 0 Z M 18 18 l 1 0 0 1 -1 0 Z  M 20 18 l 1 0 0 1 -1 0 Z M 21 18 l 1 0 0 1 -1 0 Z M 22 18 l 1 0 0 1 -1 0 Z M 23 18 l 1 0 0 1 -1 0 Z    M 27 18 l 1 0 0 1 -1 0 Z M 28 18 l 1 0 0 1 -1 0 Z   M 2 19 l 1 0 0 1 -1 0 Z   M 5 19 l 1 0 0 1 -1 0 Z    M 9 19 l 1 0 0 1 -1 0 Z   M 12 19 l 1 0 0 1 -1 0 Z  M 14 19 l 1 0 0 1 -1 0 Z M 15 19 l 1 0 0 1 -1 0 Z  M 17 19 l 1 0 0 1 -1 0 Z  M 19 19 l 1 0 0 1 -1 0 Z M 20 19 l 1 0 0 1 -1 0 Z    M 24 19 l 1 0 0 1 -1 0 Z   M 27 19 l 1 0 0 1 -1 0 Z M 28 19 l 1 0 0 1 -1 0 Z M 0 20 l 1 0 0 1 -1 0 Z   M 3 20 l 1 0 0 1 -1 0 Z M 4 20 l 1 0 0 1 -1 0 Z  M 6 20 l 1 0 0 1 -1 0 Z  M 8 20 l 1 0 0 1 -1 0 Z       M 15 20 l 1 0 0 1 -1 0 Z M 16 20 l 1 0 0 1 -1 0 Z   M 19 20 l 1 0 0 1 -1 0 Z M 20 20 l 1 0 0 1 -1 0 Z M 21 20 l 1 0 0 1 -1 0 Z M 22 20 l 1 0 0 1 -1 0 Z M 23 20 l 1 0 0 1 -1 0 Z M 24 20 l 1 0 0 1 -1 0 Z  M 26 20 l 1 0 0 1 -1 0 Z           M 8 21 l 1 0 0 1 -1 0 Z   M 11 21 l 1 0 0 1 -1 0 Z   M 14 21 l 1 0 0 1 -1 0 Z   M 17 21 l 1 0 0 1 -1 0 Z  M 19 21 l 1 0 0 1 -1 0 Z M 20 21 l 1 0 0 1 -1 0 Z    M 24 21 l 1 0 0 1 -1 0 Z  M 26 21 l 1 0 0 1 -1 0 Z M 27 21 l 1 0 0 1 -1 0 Z M 28 21 l 1 0 0 1 -1 0 Z M 0 22 l 1 0 0 1 -1 0 Z M 1 22 l 1 0 0 1 -1 0 Z M 2 22 l 1 0 0 1 -1 0 Z M 3 22 l 1 0 0 1 -1 0 Z M 4 22 l 1 0 0 1 -1 0 Z M 5 22 l 1 0 0 1 -1 0 Z M 6 22 l 1 0 0 1 -1 0 Z  M 8 22 l 1 0 0 1 -1 0 Z  M 10 22 l 1 0 0 1 -1 0 Z      M 16 22 l 1 0 0 1 -1 0 Z M 17 22 l 1 0 0 1 -1 0 Z M 18 22 l 1 0 0 1 -1 0 Z  M 20 22 l 1 0 0 1 -1 0 Z  M 22 22 l 1 0 0 1 -1 0 Z  M 24 22 l 1 0 0 1 -1 0 Z   M 27 22 l 1 0 0 1 -1 0 Z  M 0 23 l 1 0 0 1 -1 0 Z      M 6 23 l 1 0 0 1 -1 0 Z   M 9 23 l 1 0 0 1 -1 0 Z M 10 23 l 1 0 0 1 -1 0 Z    M 14 23 l 1 0 0 1 -1 0 Z M 15 23 l 1 0 0 1 -1 0 Z M 16 23 l 1 0 0 1 -1 0 Z  M 18 23 l 1 0 0 1 -1 0 Z  M 20 23 l 1 0 0 1 -1 0 Z    M 24 23 l 1 0 0 1 -1 0 Z M 25 23 l 1 0 0 1 -1 0 Z M 26 23 l 1 0 0 1 -1 0 Z  M 28 23 l 1 0 0 1 -1 0 Z M 0 24 l 1 0 0 1 -1 0 Z  M 2 24 l 1 0 0 1 -1 0 Z M 3 24 l 1 0 0 1 -1 0 Z M 4 24 l 1 0 0 1 -1 0 Z  M 6 24 l 1 0 0 1 -1 0 Z    M 10 24 l 1 0 0 1 -1 0 Z  M 12 24 l 1 0 0 1 -1 0 Z    M 16 24 l 1 0 0 1 -1 0 Z M 17 24 l 1 0 0 1 -1 0 Z   M 20 24 l 1 0 0 1 -1 0 Z M 21 24 l 1 0 0 1 -1 0 Z M 22 24 l 1 0 0 1 -1 0 Z M 23 24 l 1 0 0 1 -1 0 Z M 24 24 l 1 0 0 1 -1 0 Z   M 27 24 l 1 0 0 1 -1 0 Z M 28 24 l 1 0 0 1 -1 0 Z M 0 25 l 1 0 0 1 -1 0 Z  M 2 25 l 1 0 0 1 -1 0 Z M 3 25 l 1 0 0 1 -1 0 Z M 4 25 l 1 0 0 1 -1 0 Z  M 6 25 l 1 0 0 1 -1 0 Z  M 8 25 l 1 0 0 1 -1 0 Z M 9 25 l 1 0 0 1 -1 0 Z  M 11 25 l 1 0 0 1 -1 0 Z M 12 25 l 1 0 0 1 -1 0 Z       M 19 25 l 1 0 0 1 -1 0 Z   M 22 25 l 1 0 0 1 -1 0 Z M 23 25 l 1 0 0 1 -1 0 Z M 24 25 l 1 0 0 1 -1 0 Z M 25 25 l 1 0 0 1 -1 0 Z M 26 25 l 1 0 0 1 -1 0 Z M 27 25 l 1 0 0 1 -1 0 Z  M 0 26 l 1 0 0 1 -1 0 Z  M 2 26 l 1 0 0 1 -1 0 Z M 3 26 l 1 0 0 1 -1 0 Z M 4 26 l 1 0 0 1 -1 0 Z  M 6 26 l 1 0 0 1 -1 0 Z      M 12 26 l 1 0 0 1 -1 0 Z    M 16 26 l 1 0 0 1 -1 0 Z    M 20 26 l 1 0 0 1 -1 0 Z    M 24 26 l 1 0 0 1 -1 0 Z M 25 26 l 1 0 0 1 -1 0 Z M 26 26 l 1 0 0 1 -1 0 Z  M 28 26 l 1 0 0 1 -1 0 Z M 0 27 l 1 0 0 1 -1 0 Z      M 6 27 l 1 0 0 1 -1 0 Z  M 8 27 l 1 0 0 1 -1 0 Z M 9 27 l 1 0 0 1 -1 0 Z   M 12 27 l 1 0 0 1 -1 0 Z M 13 27 l 1 0 0 1 -1 0 Z M 14 27 l 1 0 0 1 -1 0 Z M 15 27 l 1 0 0 1 -1 0 Z M 16 27 l 1 0 0 1 -1 0 Z M 17 27 l 1 0 0 1 -1 0 Z M 18 27 l 1 0 0 1 -1 0 Z M 19 27 l 1 0 0 1 -1 0 Z M 20 27 l 1 0 0 1 -1 0 Z  M 22 27 l 1 0 0 1 -1 0 Z M 23 27 l 1 0 0 1 -1 0 Z    M 27 27 l 1 0 0 1 -1 0 Z  M 0 28 l 1 0 0 1 -1 0 Z M 1 28 l 1 0 0 1 -1 0 Z M 2 28 l 1 0 0 1 -1 0 Z M 3 28 l 1 0 0 1 -1 0 Z M 4 28 l 1 0 0 1 -1 0 Z M 5 28 l 1 0 0 1 -1 0 Z M 6 28 l 1 0 0 1 -1 0 Z  M 8 28 l 1 0 0 1 -1 0 Z  M 10 28 l 1 0 0 1 -1 0 Z M 11 28 l 1 0 0 1 -1 0 Z  M 13 28 l 1 0 0 1 -1 0 Z M 14 28 l 1 0 0 1 -1 0 Z   M 17 28 l 1 0 0 1 -1 0 Z   M 20 28 l 1 0 0 1 -1 0 Z   M 23 28 l 1 0 0 1 -1 0 Z  M 25 28 l 1 0 0 1 -1 0 Z  M 27 28 l 1 0 0 1 -1 0 Z "
                                            fill="#000000"></path>
                                    </svg>
                                </div>
                                <!-- Text Content -->
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900">
                                        Dapatkan notifikasi lokermu secara langsung di Aplikasi Glints
                                    </span>
                                    <p class="text-xs text-gray-500">
                                        <span>Scan kode QR untuk download</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Filter (scrollable) -->
                        <div class="border rounded-lg divide-y overflow-y-auto max-h-[80vh]" aria-label="Filter your search"
                            role="region">

                            <!-- Prioritaskan -->
                            <div x-data="{ open: true }" class="p-3">
                                <button @click="open = !open" class="flex justify-between items-center w-full">
                                    <span class="font-medium">Prioritaskan</span>
                                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <div x-show="open" class="mt-3 flex gap-2" role="radiogroup"
                                    aria-label="sortBy filter options">
                                    @foreach (['relevant' => 'Paling Relevan', 'latest' => 'Baru Ditambahkan'] as $value => $label)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="sort" value="{{ $value }}"
                                                class="hidden peer"
                                                {{ request('sort', 'relevant') == $value ? 'checked' : '' }}>
                                            <div
                                                class="px-3 py-1 border rounded-full text-sm peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 hover:bg-gray-100">
                                                {{ $label }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Tipe Pekerjaan -->
                            <div x-data="{ open: true }" tabindex="0"
                                class="CollapsibleStyle_CollapsibleContainer-sc-133mwvh-1 cBVfEI aries-collapsible stylessc_Collapsible-sc-ns5f3p-6 fVuTrT px-3"
                                data-testid="collapsible-container">

                                <!-- Header -->
                                <button @click="open = !open" class="flex justify-between items-center w-full">
                                    <span class="font-medium">Tipe Pekerjaan</span>
                                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <!-- Body -->
                                <div x-show="open"
                                    class="CollapsibleStyle__CollapsibleBody-sc-133mwvh-3 hRheXY collapsible-content"
                                    data-testid="collapsible-content">
                                    <div data-cy="job_types_filter" data-scroll="true"
                                        class="stylessc__CheckboxContainer-sc-15bexo7-1 cpqGZq">
                                        @foreach ([
            'FULL_TIME' => 'Penuh Waktu',
            'CONTRACT' => 'Kontrak',
            'INTERNSHIP' => 'Magang',
            'PROJECT_BASED' => 'Freelance',
            'PART_TIME' => 'Paruh Waktu',
            'DAILY' => 'Harian',
        ] as $value => $label)
                                            @php $checked = in_array(strtolower($value), request('employment_type', [])); @endphp
                                            <div class="CheckboxStyle_CheckboxContainer-sc-c3ckvs-0 fLkASp aries-checkbox stylessc_Checkbox-sc-15bexo7-0 kNkqRn"
                                                role="checkbox" aria-labelledby="jobTypes{{ $value }}"
                                                :aria-checked="{{ $checked ? 'true' : 'false' }}" data-border="false"
                                                tabindex="0">
                                                <input type="checkbox" id="jobTypes{{ $value }}"
                                                    value="{{ $value }}"
                                                    @if ($checked) checked @endif>
                                                <label for="jobTypes{{ $value }}"
                                                    tabindex="-1"><span>{{ $label }}</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- kebijakan kerja --}}
                            <div x-data="{ open: true }" tabindex="0"
                                class="CollapsibleStyle_CollapsibleContainer-sc-133mwvh-1 cBVfEI aries-collapsible stylessc_Collapsible-sc-ns5f3p-6 fVuTrT px-3"
                                data-testid="collapsible-container">

                                <!-- Header -->
                                <button @click="open = !open" class="flex justify-between items-center w-full">
                                    <span class="font-medium">kebijakan Kerja</span>
                                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <!-- Body -->
                                <div x-show="open"
                                    class="CollapsibleStyle__CollapsibleBody-sc-133mwvh-3 hRheXY collapsible-content"
                                    data-testid="collapsible-content">
                                    <div data-cy="work_arrangement_options_filter" data-scroll="false"
                                        class="stylessc__CheckboxContainer-sc-15bexo7-1 cpqGZq">

                                        @foreach ([
            'ONSITE' => 'Kerja di kantor',
            'HYBRID' => 'Kerja di kantor / rumah',
            'REMOTE' => 'Kerja Remote/dari rumah',
        ] as $value => $label)
                                            <div class="CheckboxStyle_CheckboxContainer-sc-c3ckvs-0 fLkASp aries-checkbox stylessc_Checkbox-sc-15bexo7-0 kNkqRn"
                                                role="checkbox"
                                                aria-labelledby="workArrangementOptions{{ $value }}"
                                                aria-checked="false" data-border="false" tabindex="0">
                                                <input type="checkbox" id="workArrangementOptions{{ $value }}"
                                                    value="{{ $value }}">
                                                <label for="workArrangementOptions{{ $value }}"
                                                    tabindex="-1"><span>{{ $label }}</span></label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            {{-- kecamatan --}}
                            <div x-data="{ open: true }" tabindex="0"
                                class="CollapsibleStyle_CollapsibleContainer-sc-133mwvh-1 cBVfEI aries-collapsible stylessc_Collapsible-sc-ns5f3p-6 fVuTrT px-3"
                                data-testid="collapsible-container">
                                

                                <!-- Header -->
                                <button @click="open = !open" class="flex justify-between items-center w-full">
                                    <span class="font-medium">Kecamatan</span>
                                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <!-- Body -->
                                <div x-show="open"
                                    class="CollapsibleStyle__CollapsibleBody-sc-133mwvh-3 hRheXY collapsible-content"
                                    data-testid="collapsible-content">

                                    <div data-cy="filter_location_ids_filter" data-scroll="true"
                                        class="stylessc__CheckboxContainer-sc-15bexo7-1 cpqGZq">

                                        @php
                                            $locations = [
                                                [
                                                    'id' => 'ea9cf55e-2236-402a-8861-d603d34d6624',
                                                    'name' => 'Cengkareng',
                                                ],
                                                ['id' => '70029131-cce8-4c16-8214-839852d36c52', 'name' => 'Cilandak'],
                                                [
                                                    'id' => '58769ed5-7016-43cd-8bf9-277f6485c92e',
                                                    'name' => 'Denpasar Barat',
                                                ],
                                                [
                                                    'id' => '85f5355e-fd22-47f8-8710-3a6e3aa46415',
                                                    'name' => 'Denpasar Selatan',
                                                ],
                                                ['id' => 'c3754bdf-fa78-428f-ae5a-ccb5fe31fdec', 'name' => 'Gambir'],
                                                [
                                                    'id' => '540025a5-9145-4250-9a55-9e69e7f3be10',
                                                    'name' => 'Grogol Petamburan',
                                                ],
                                                ['id' => '65c2f402-ae4b-4aea-bcfc-e32291e0cfd1', 'name' => 'Kalideres'],
                                                [
                                                    'id' => '9f7c7460-1548-4eb5-9659-37d917f7ea90',
                                                    'name' => 'Kebayoran Baru',
                                                ],
                                                [
                                                    'id' => '63027b8c-d9a2-427c-b4d5-5d3f210f9932',
                                                    'name' => 'Kebon Jeruk',
                                                ],
                                                [
                                                    'id' => '2bc69434-f510-4ed6-b5f8-de5a0e85d70b',
                                                    'name' => 'Kelapa Dua',
                                                ],
                                                [
                                                    'id' => '8cd24324-d933-45e4-9c59-612ad942955d',
                                                    'name' => 'Kelapa Gading',
                                                ],
                                                ['id' => '6a08e00a-7070-4b21-a0a9-eb7d1a353c03', 'name' => 'Kembangan'],
                                                ['id' => '0a4edc64-57e8-4381-8ca1-1eaf9bb6d79a', 'name' => 'Kuta'],
                                                [
                                                    'id' => '12d46826-7ba6-4801-acd5-cc10f451f8a7',
                                                    'name' => 'Kuta Selatan',
                                                ],
                                                [
                                                    'id' => '6d0dde78-c0d3-4241-b9d3-5b883c36adf7',
                                                    'name' => 'Kuta Utara',
                                                ],
                                                [
                                                    'id' => '5a9b9083-d5e8-4af3-a786-0d3d88b7a023',
                                                    'name' => 'Pagedangan',
                                                ],
                                                [
                                                    'id' => '037897c3-5ebb-4dbe-b7fb-a06521ea8e4f',
                                                    'name' => 'Penjaringan',
                                                ],
                                                ['id' => '9b545302-dd3d-4ed3-827c-cfa3d7648554', 'name' => 'Serpong'],
                                                ['id' => '1a26bce1-b0a8-4677-a380-79701d53185a', 'name' => 'Setiabudi'],
                                                [
                                                    'id' => '7bed87b0-14f6-44fc-8309-9067d1d3c65d',
                                                    'name' => 'Tanah Abang',
                                                ],
                                            ];
                                        @endphp

                                        @foreach ($locations as $loc)
                                            <div class="CheckboxStyle_CheckboxContainer-sc-c3ckvs-0 fLkASp aries-checkbox stylessc_Checkbox-sc-15bexo7-0 kNkqRn"
                                                role="checkbox" aria-labelledby="filterLocationIds{{ $loc['id'] }}"
                                                aria-checked="false" data-border="false" tabindex="0">
                                                <input type="checkbox" id="filterLocationIds{{ $loc['id'] }}"
                                                    value="{{ $loc['id'] }}">
                                                <label for="filterLocationIds{{ $loc['id'] }}" tabindex="-1"><span
                                                        title="{{ $loc['name'] }}">{{ $loc['name'] }}</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Pengalaman --}}
                            <div x-data="{ open: true }" tabindex="0"
                                class="CollapsibleStyle_CollapsibleContainer-sc-133mwvh-1 cBVfEI aries-collapsible stylessc_Collapsible-sc-ns5f3p-6 fVuTrT px-3"
                                data-testid="collapsible-container">

                                <!-- Header -->
                                <button @click="open = !open" class="flex justify-between items-center w-full">
                                    <span class="font-medium">Pengalaman</span>
                                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <!-- Body -->
                                <div x-show="open"
                                    class="CollapsibleStyle__CollapsibleBody-sc-133mwvh-3 hRheXY collapsible-content"
                                    data-testid="collapsible-content">

                                    <div data-cy="years_of_experience_filter_filter" data-scroll="true"
                                        class="stylessc__CheckboxContainer-sc-15bexo7-1 cpqGZq">

                                        @php
                                            $experienceLevels = [
                                                'NO_EXPERIENCE' => 'Tidak berpengalaman',
                                                'FRESH_GRAD' => 'Fresh Graduate',
                                                'LESS_THAN_A_YEAR' => 'Kurang dari setahun',
                                                'ONE_TO_THREE_YEARS' => '1–3 tahun',
                                                'THREE_TO_FIVE_YEARS' => '3–5 tahun',
                                                'FIVE_TO_TEN_YEARS' => '5–10 tahun',
                                                'MORE_THAN_TEN_YEARS' => 'Lebih dari 10 tahun',
                                            ];
                                        @endphp

                                        @foreach ($experienceLevels as $key => $label)
                                            <div class="CheckboxStyle_CheckboxContainer-sc-c3ckvs-0 fLkASp aries-checkbox stylessc_Checkbox-sc-15bexo7-0 kNkqRn"
                                                role="checkbox"
                                                aria-labelledby="yearsOfExperienceFilter{{ $key }}"
                                                aria-checked="false" data-border="false" tabindex="0">
                                                <input type="checkbox" id="yearsOfExperienceFilter{{ $key }}"
                                                    value="{{ $key }}">
                                                <label for="yearsOfExperienceFilter{{ $key }}"
                                                    tabindex="-1"><span>{{ $label }}</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- pendidikan --}}
                            <div x-data="{ open: true }" tabindex="0"
                                class="CollapsibleStyle_CollapsibleContainer-sc-133mwvh-1 cBVfEI aries-collapsible stylessc_Collapsible-sc-ns5f3p-6 fVuTrT px-3"
                                data-testid="collapsible-container">

                                <!-- Header -->
                                <button @click="open = !open" class="flex justify-between items-center w-full">
                                    <span class="font-medium">Tingkat Pendidikan</span>
                                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <!-- Body -->
                                <div x-show="open"
                                    class="CollapsibleStyle__CollapsibleBody-sc-133mwvh-3 hRheXY collapsible-content"
                                    data-testid="collapsible-content">

                                    <div data-cy="education_level_filter" data-scroll="true"
                                        class="stylessc__CheckboxContainer-sc-15bexo7-1 cpqGZq">

                                        @php
                                            $educationLevels = [
                                                'DOCTORATE' => 'S3',
                                                'MASTER_DEGREE' => 'S2',
                                                'BACHELOR_DEGREE' => 'S1',
                                                'DIPLOMA' => 'D1-D4',
                                                'HIGH_SCHOOL' => 'SMA/SMK',
                                                'SECONDARY_SCHOOL' => 'SMP',
                                                'PRIMARY_SCHOOL' => 'SD',
                                            ];
                                        @endphp

                                        @foreach ($educationLevels as $key => $label)
                                            <div class="CheckboxStyle_CheckboxContainer-sc-c3ckvs-0 fLkASp aries-checkbox stylessc_Checkbox-sc-15bexo7-0 kNkqRn"
                                                role="checkbox" aria-labelledby="educationLevel{{ $key }}"
                                                aria-checked="false" data-border="false" tabindex="0">
                                                <input type="checkbox" id="educationLevel{{ $key }}"
                                                    value="{{ $key }}">
                                                <label for="educationLevel{{ $key }}" tabindex="-1">
                                                    <span title="{{ $label }}">{{ $label }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div x-data="{ open: true }" tabindex="0"
                                class="CollapsibleStyle_CollapsibleContainer-sc-133mwvh-1 cBVfEI aries-collapsible stylessc_Collapsible-sc-ns5f3p-6 fVuTrT px-3"
                                data-testid="collapsible-container">

                                <!-- Header -->
                                <button @click="open = !open" class="flex justify-between items-center w-full">
                                    <span class="font-medium">Terakhir Diperbarui</span>
                                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <!-- Body -->
                                <div x-show="open"
                                    class="CollapsibleStyle__CollapsibleBody-sc-133mwvh-3 hRheXY collapsible-content"
                                    data-testid="collapsible-content">

                                    <div role="radiogroup" aria-label="lastUpdated filter options"
                                        class="stylessc__RadioButtonContainer-sc-ahrpnp-2 DjAKU flex flex-col">
                                        @php
                                            $lastUpdatedOptions = [
                                                'PAST_MONTH' => 'Sebulan Terakhir',
                                                'PAST_WEEK' => 'Seminggu Terakhir',
                                                'PAST_24_HOURS' => '24 Jam Terakhir',
                                                'ANY_TIME' => 'Kapan pun',
                                            ];
                                        @endphp

                                        @foreach ($lastUpdatedOptions as $value => $label)
                                            <label
                                                class="RadioButtonStyle__RadioContainer-sc-1dmv219-3 fbUXbY aries-radiobtn"
                                                tabindex="0">
                                                <input type="radio" name="lastUpdated" value="{{ $value }}">
                                                <span data-testid="radio-icon"
                                                    class="RadioButtonStyle__RadioIcon-sc-1dmv219-0 fAWPpl"></span>
                                                <span
                                                    class="RadioButtonStyle__RadioLabel-sc-1dmv219-1 dDpPQy radiobtn-content"
                                                    tabindex="-1">{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </aside>


                <!-- Job Listings -->
                <div class="flex-1" style="flex: 1; min-width: 0;">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($jobs->count() > 0)
                            @foreach($jobs as $job)
                                <div class="border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition bg-white p-3">
                                    <div class="flex items-start gap-3">
                                        <!-- Company Logo -->
                                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-center flex-shrink-0">
                                            @if($job->company && $job->company->logo)
                                                <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-building text-gray-400 text-sm"></i>
                                            @endif
                                        </div>
                                        
                                        <!-- Job Info --> 
                                        <div class="flex-1 min-w-0">
                                            <!-- Job Title and Salary -->
                                            <div class="flex items-center justify-between mb-1">
                                                <!-- Job Title -->
                                                <h2 class="text-base font-medium text-gray-900 leading-tight hover:text-blue-600 transition-colors">
                                                    <a href="{{ route('jobs.show', $job->id) }}" class="truncate">
                                                        {{ $job->title }}
                                                    </a>
                                                </h2>
                                            
                                                <!-- Salary -->
                                                <span class="text-sm font-semibold text-blue-600 whitespace-nowrap ml-2">
                                                    @if($job->salary_min && $job->salary_max)
                                                        Rp {{ number_format($job->salary_min/1000000, 1, ',', '.') }}&nbsp;jt-{{ number_format($job->salary_max/1000000, 1, ',', '.') }}&nbsp;jt
                                                    @else
                                                        <span class="text-gray-500 text-sm">Gaji Tidak Ditampilkan</span>
                                                    @endif
                                                </span>
                                            </div>
                                            
                                            
                                            <!-- Tags -->
                                            <div class="flex flex-wrap gap-1 mb-1">
                                                <span class="px-1.5 py-0.5 bg-orange-100 text-orange-700 text-xs rounded font-medium">
                                                    {{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}
                                                </span>
                                                <span class="px-1.5 py-0.5 bg-blue-100 text-blue-700 text-xs rounded font-medium">
                                                    {{ ucfirst($job->experience_level ?? 'Entry') }}
                                                </span>
                                                <span class="px-1.5 py-0.5 bg-green-100 text-green-700 text-xs rounded font-medium">
                                                    Freelance
                                                </span>
                                            </div>
                                            
                                            <!-- Additional Tags -->
                                            <div class="flex flex-wrap gap-1 mb-2">
                                                <span class="px-1.5 py-0.5 bg-gray-100 text-gray-600 text-xs rounded">
                                                    Kurang dari setahun
                                                </span>
                                                <span class="px-1.5 py-0.5 bg-gray-100 text-gray-600 text-xs rounded">
                                                    Minimal SD
                                                </span>
                                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">
                                                    +4
                                                </span>
                                            </div>
                                            
                                            <!-- Company Info -->
                                            <div class="flex items-center gap-2 mb-2">
                                                <div class="flex items-center text-sm text-blue-600">
                                                    <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                    <span class="font-medium">{{ $job->company->name ?? 'Mitra Sewa Gojek' }}</span>
                                                </div>
                                            </div>
                                            
                                            <!-- Location -->
                                            <div class="flex items-center text-xs text-gray-500 mb-2">
                                                <i class="fas fa-map-marker-alt mr-1"></i>
                                                {{ $job->location ?? 'Karawaci, Tangerang, Banten' }}
                                            </div>
                                            
                                            <!-- Footer -->
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <span class="px-1.5 py-0.5 bg-orange-500 text-white text-xs rounded font-bold">
                                                        HOT
                                                    </span>
                                                    <span class="px-1.5 py-0.5 bg-green-600 text-white text-xs rounded font-medium">
                                                        <i class="fas fa-check mr-1"></i>
                                                        Aktif Merekrut
                                                    </span>
                                                    <span class="text-xs text-blue-500">
                                                        {{ $job->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                                <button class="text-gray-400 hover:text-blue-500 transition-colors">
                                                    <i class="far fa-bookmark text-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-span-full text-center py-12 bg-white border border-gray-200 rounded-lg">
                                <i class="fas fa-search fa-3x text-gray-400"></i>
                                <h3 class="mt-3 text-lg font-semibold">Tidak ada lowongan kerja ditemukan</h3>
                                <p class="text-gray-500 text-sm">Coba ubah kata kunci pencarian atau filter yang Anda gunakan.</p>
                            </div>
                        @endif
                    </div>
                
                    <!-- Pagination -->
                    @if ($jobs->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $jobs->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
                
                
                
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        function sortJobs(sortValue) {
            const url = new URL(window.location);
            url.searchParams.set('sort', sortValue);
            window.location.href = url.toString();
        }

        function clearFilters() {
            const url = new URL(window.location);
            window.location.href = url.origin + url.pathname;
        }
    </script>
@endpush