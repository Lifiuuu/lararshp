@extends('layouts.app')

@section('title', 'Layanan Umum - RSHP Universitas Airlangga')

@section('content')

<section class="features-section">
    <div class="container">

        {{-- Judul Halaman --}}
        <div style="text-align: center; margin-bottom: 3rem;">
            <h2>Layanan Umum</h2>
            <p style="font-size: 1.1rem; color: #555; max-width: 800px; margin: auto;">
                Rumah Sakit Hewan Pendidikan Universitas Airlangga menyediakan berbagai layanan, baik atas kehendak klien maupun rujukan dari dokter hewan praktisi.
            </p>
        </div>

        {{-- Kartu untuk Poliklinik --}}
        <div class="feature-item" style="text-align: left; margin-bottom: 2rem;">
            <h3>Poliklinik (Rawat Jalan)</h3>
            <p>
                Layanan rawat jalan untuk observasi, diagnosis, pengobatan, rehabilitasi, dan layanan kesehatan lainnya tanpa perlu menginap. Kami didukung oleh fasilitas diagnostik lengkap seperti radiologi, ultrasonografi, EKG, dan tes cepat untuk berbagai penyakit.
            </p>
            <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem; color: var(--heading-color);">Layanan Poliklinik Meliputi:</h4>
            <ul style="list-style-position: inside; padding-left: 1rem;">
                <li>Pemeriksaan & Konsultasi</li>
                <li>Vaksinasi</li>
                <li>Akupuntur</li>
                <li>Kemoterapi & Fisioterapi</li>
                <li>Mandi Terapi</li>
            </ul>
        </div>

        {{-- Kartu untuk Rawat Inap --}}
        <div class="feature-item" style="text-align: left; margin-bottom: 2rem;">
            <h3>Rawat Inap</h3>
            <p>Rawat inap dilakukan pada pasien-pasien yang berat atau parah dan membutuhkan perawatan intensif. Pasien akan diobservasi dan mendapat perawatan intensif dibawah pengawasan dokter dan paramedis yang handal. Sebelum rawat inap, klien wajib mengisi inform konsen yang artinya klien telah diberi penjelasan yang detail tentang kondisi penyakit pasien dan menyetujui rencana terapi yang akan dijalankan sepengetahuan klien. Klien juga diberitahu biaya yang dibebankan untuk semua layanan. RSHP menerima pembayaran tunai maupun kartu debit bank.</p>
        </div>

        {{-- Kartu untuk Bedah --}}
        <div class="feature-item" style="text-align: left;">
            <h3>Tindakan Bedah</h3>
            <p>Kami melayani berbagai tindakan bedah, mulai dari bedah minor hingga mayor yang kompleks.</p>
            
            {{-- Grid untuk Bedah Minor dan Mayor --}}
            <div class="features-grid" style="margin-top: 1.5rem; gap: 1.5rem;">
                {{-- Kolom Bedah Minor --}}
                <div style="background-color: var(--background-color); padding: 1.5rem; border-radius: var(--border-radius);">
                    <h4 style="color: var(--heading-color);">Tindakan Bedah Minor</h4>
                    <ul style="list-style-position: inside; padding-left: 1rem; margin-top: 0.5rem;">
                        <li>Jahit Luka</li>
                        <li>Kastrasi (Kebiri)</li>
                        <li>Othematoma</li>
                        <li>Scaling & Ekstraksi Gigi</li>
                    </ul>
                </div>
                {{-- Kolom Bedah Mayor --}}
                <div style="background-color: var(--background-color); padding: 1.5rem; border-radius: var(--border-radius);">
                    <h4 style="color: var(--heading-color);">Tindakan Bedah Mayor</h4>
                    <ul style="list-style-position: inside; padding-left: 1rem; margin-top: 0.5rem;">
                        <li>Bedah Jaringan Lunak (Digestive, Urinary, Reproductive)</li>
                        <li>Sectio Caesar</li>
                        <li>Bedah Tulang (Fraktur)</li>
                        <li>Bedah Hernia & Eksisi Tumor</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection