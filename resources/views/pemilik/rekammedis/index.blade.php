@extends('layouts.lte.main')

@section('page-title', 'Rekam Medis')
@section('breadcrumb')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered actions align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Created At</th>
                                    <th>Anamnesa</th>
                                    <th>Temuan Klinis</th>
                                    <th>Diagnosa</th>
                                    <th>Pet</th>
                                    <th>Dokter Pemeriksa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekamMediss as $index => $rekamMedis)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $rekamMedis->created_at }}</td>
                                    <td>{{ Str::limit($rekamMedis->anamnesa, 5) }}</td>
                                    <td>{{ Str::limit($rekamMedis->temuan_klinis, 5) }}</td>
                                    <td>{{ Str::limit($rekamMedis->diagnosa, 5) }}</td>
                                    <td>{{ $rekamMedis->pet_nama ?? 'N/A' }}</td>
                                    <td>{{ $rekamMedis->dokter_nama ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('pemilik.rekammedis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-sm btn-info btn-admin">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
