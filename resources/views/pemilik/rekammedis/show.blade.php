@extends('layouts.lte.main')

@section('page-title', 'Detail Rekam Medis')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{ route('pemilik.rekammedis.index') }}">Rekam Medis</a></li>
  <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Rekam Medis</h3>
                    <div class="card-tools">
                        <a href="{{ route('pemilik.rekammedis.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row record-info">
                                <dt class="col-sm-4">Pet</dt>
                                <dd class="col-sm-8">{{ optional($rekamMedis->temuDokter->pet)->nama ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Dokter Pemeriksa</dt>
                                <dd class="col-sm-8">{{ optional($rekamMedis->temuDokter->roleUser->user)->nama ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Tanggal Daftar</dt>
                                <dd class="col-sm-8">{{ optional(\Carbon\Carbon::parse($rekamMedis->temuDokter->waktu_daftar ?? $rekamMedis->created_at))->format('d M Y H:i') ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">No Urut</dt>
                                <dd class="col-sm-8">{{ optional($rekamMedis->temuDokter)->no_urut ?? 'N/A' }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row record-info">
                                <dt class="col-sm-4">Anamnesa</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->anamnesa }}</dd>

                                <dt class="col-sm-4">Temuan Klinis</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->temuan_klinis }}</dd>

                                <dt class="col-sm-4">Diagnosa</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->diagnosa }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Tindakan Terapi</h3>
                </div>
                <div class="card-body">
                        @if($detailRekamMedis->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Deskripsi Tindakan</th>
                                    <th>Kategori</th>
                                    <th>Kategori Klinis</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailRekamMedis as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ optional($detail->kodeTindakanTerapi)->kode ?? 'N/A' }}</td>
                                    <td>{{ optional($detail->kodeTindakanTerapi)->deskripsi_tindakan_terapi ?? 'N/A' }}</td>
                                    <td>{{ optional(optional($detail->kodeTindakanTerapi)->kategori)->nama_kategori ?? 'N/A' }}</td>
                                    <td>{{ optional(optional($detail->kodeTindakanTerapi)->kategoriKlinis)->nama_kategori_klinis ?? 'N/A' }}</td>
                                    <td>{{ $detail->detail ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Tidak ada detail tindakan terapi untuk rekam medis ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        /* Align dl labels and values so the colon sits flush and values start aligned */
        .record-info dt {
            position: relative;
            text-align: right;
            padding-right: 3rem; /* increase space before the pseudo-colon */
            white-space: nowrap;
        }
        /* draw a consistent colon at the right edge of the label column */
        .record-info dt::after {
            content: ":";
            position: absolute;
            /* move further to the right so the colon sits more into the value column */
            right: -1rem;
            top: 50%;
            transform: translateY(-50%);
            color: inherit;
        }

        .record-info dd {
            margin-left: 0; /* bootstrap puts margin-left; reset so columns control layout */
            padding-left: 1.4rem; /* add more space between colon and value */
        }
        /* ensure small screens keep readable spacing */
        @media (max-width: 576px) {
            .record-info dt { text-align: left; padding-right: .25rem; }
            .record-info dt::after { position: static; transform: none; margin-left: .25rem; }
            .record-info dd { padding-left: .6rem; }
        }
    </style>
@endpush