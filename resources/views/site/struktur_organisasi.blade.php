@extends('layouts.site.app')

@section('title', 'Struktur Organisasi - RSHP Universitas Airlangga')

@section('content')
    <section class="features-section">
        <div class="container">

            {{-- Judul Halaman --}}
            <div style="text-align: center; margin-bottom: 3rem;">
                <h1>STRUKTUR PIMPINAN</h1>
                <p style="font-size: 1rem; color: #555;">RUMAH SAKIT HEWAN PENDIDIKAN UNIVERSITAS AIRLANGGA</p>
            </div>

            {{-- Kartu untuk Direktur (Terpusat) --}}
            <div style="display: flex; justify-content: center; margin-bottom: 2.5rem;">
                <div class="feature-item" style="text-align: center; max-width: 450px;">
                    <h3>DIREKTUR</h3>
                    <img src="{{ asset('images/direktur.jpg') }}" alt="Direktur" class="profile-pic">
                    <p class="profile-name">Dr. drh. Susi Taufanilawaty, M.Si., drh.</p>
                </div>
            </div>

            {{-- Grid untuk Wakil Direktur --}}
            <div class="features-grid">

                {{-- Kartu Wakil Direktur I --}}
                <div class="feature-item" style="text-align: center;">
                    <h3>WAKIL DIREKTUR I</h3>
                    <p class="profile-role">PELAYANAN MEDIS, PENDIDIKAN DAN PENELITIAN</p>
                    <img src="{{ asset('images/wadek1.jpg') }}" alt="Wadir 1" class="profile-pic">
                    <p class="profile-name">Dr. Noefiarno Trisakti, M.Si., drh.</p>
                </div>

                {{-- Kartu Wakil Direktur II --}}
                <div class="feature-item" style="text-align: center;">
                    <h3>WAKIL DIREKTUR II</h3>
                    <p class="profile-role">SUMBER DAYA MANUSIA, SARANA PRASARANA DAN KEUANGAN</p>
                    <img src="{{ asset('images/wadek2.jpg') }}" alt="Wadir 2" class="profile-pic">
                    <p class="profile-name">Dr. Mimy Sasmita S., M.Med., drh.</p>
                </div>

            </div>
        </div>
    </section>
   
@endsection