@extends('layouts.site.app')

@section('title', 'Home - RSHP Universitas Airlangga')

@section('content')

<section class="hero-section">
    <div class="container">
        <h1>Selamat Datang di RSHP UNAIR</h1>
        <p>
            Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi untuk selalu meningkatkan kualitas pelayanan. 
            Kami menyediakan fitur pendaftaran online untuk mempermudah Anda mendaftarkan hewan kesayangan.
        </p>
        <div style="margin-top: 2rem;">
            <a href="#" class="btn btn-primary" style="background-color: #A9A9A9; border-color: #A9A9A9; cursor: not-allowed; text-decoration: line-through;">
                Pendaftaran Online
            </a>
            <a href="{{route('informasi-jadwal-dokter-jaga')}}" class="btn btn-secondary">
                Informasi Jadwal Dokter Jaga
            </a>
        </div>
    </div>
</section>

{{-- 2. KONTEN UTAMA (VIDEO & PETA) --}}
<section class="features-section">
    <div class="container">

        {{-- KARTU UNTUK VIDEO PROFIL --}}
        <div class="feature-item">
            <h3>Profil RSHP</h3>
            <div class="video-container" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                <iframe 
                    src="https://www.youtube.com/embed/rCfvZPECZvE" 
                    title="YouTube video preview" 
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                    frameborder="none" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        {{-- KARTU UNTUK PETA LOKASI --}}
        {{-- Kita tambahkan sedikit jarak di atasnya agar tidak terlalu menempel dengan video --}}
        <div class="feature-item" style="margin-top: 2.5rem;">
            <h3>Lokasi Kami</h3>
            <div class="map-container" style="position: relative; padding-bottom: 75%; height: 0; overflow: hidden;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15831.09154526714!2d112.784701!3d-7.266666999999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd40a9784f5%3A0xe756f6ae03eab99!2sAnimal%20Hospital%2C%20Universitas%20Airlangga!5e0!3m2!1sen!2sus!4v1755249851861!5m2!1sen!2sus"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border:none;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</section>

@endsection