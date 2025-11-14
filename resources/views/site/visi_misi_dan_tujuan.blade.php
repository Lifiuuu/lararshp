@extends('layouts.app')

@section('title', 'Visi Misi dan Tujuan - RSHP Universitas Airlangga')

@section('content')

<section class="features-section">
    <div class="container">

        {{-- Judul Halaman --}}
        <div style="text-align: center; margin-bottom: 3rem;">
            <h2>Visi, Misi, dan Tujuan RSHP</h2>
        </div>

        {{-- Kartu untuk Visi --}}
        <div class="feature-item" style="text-align: left; margin-bottom: 2rem;">
            <h3>Visi</h3>
            <p>
                Menjadi Rumah Sakit Hewan Pendidikan terkemuka di tingkat nasional dan internasional dalam pemberian pelayanan paripurna, pendidikan, dan penelitian di bidang kesehatan hewan, yang unggul dan mandiri serta bermartabat berdasarkan moral, agama, etika dengan tetap berorientasi pada kesejahteraan masyarakat.
            </p>
        </div>

        {{-- Kartu untuk Misi --}}
        <div class="feature-item" style="text-align: left; margin-bottom: 2rem;">
            <h3>Misi</h3>
            <ul style="list-style-position: inside; padding-left: 1rem;">
                <li>Menyelenggarakan fungsi pelayanan terintegrasi, bermutu dan mengutamakan keselamatan dan kesehatan pasien (klien).</li>
                <li>Menyelenggarakan pendidikan dan pelatihan terintegrasi bidang kedokteran hewan dan kesehatan lainnya untuk menghasilkan lulusan atau tenaga kesehatan yang kompeten di bidangnya.</li>
                <li>Melakukan penelitian terintegrasi berbasis pada keunggulan bidang kedokteran hewan dan kesehatan lainnya yang berorientasi pada produk inovasi.</li>
                <li>Menjadi pusat rujukan pelayanan kedokteran hewan dan kesehatan lain yang unggul.</li>
                <li>Mengembangkan manajemen rumah sakit hewan yang produktif, efisien, bermutu, dan berbasis kinerja.</li>
            </ul>
        </div>

        {{-- Kartu untuk Tujuan --}}
        <div class="feature-item" style="text-align: left;">
            <h3>Tujuan</h3>
            <ul style="list-style-position: inside; padding-left: 1rem;">
                <li>Menjadi Rumah Sakit Hewan yang adaptif, kreatif dan proaktif terhadap tuntutan perkembangan ilmu pengetahuan dan teknologi di bidang pengobatan kesehatan hewan.</li>
                <li>Menjadi Rumah Sakit Hewan mandiri yang bertatakelola baik.</li>
            </ul>
        </div>

    </div>
</section>

@endsection