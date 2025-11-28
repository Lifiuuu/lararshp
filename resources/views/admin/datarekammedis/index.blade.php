@extends('layouts.lte.main')

@section('page-title', 'Data Rekam Medis')

@section('content')
<section class="container-fluid p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.datarekammedis.create') }}" class="btn btn-primary">Tambah Data Rekam Medis</a>
    </div>
    <div class="card w-100">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Created At</th>
                            <th>Anamnesa</th>
                            <th>Temuan Klinis</th>
                            <th>Diagnosa</th>
                            <th>Pet</th>
                            <th>Dokter Pemeriksa</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Group by dokter name so the doctor's cell is merged (rowspan)
                            $groups = $rekamMediss->groupBy(function($r) {
                                return $r->nama_dokter ?? 'N/A';
                            });
                            $rowNumber = 0;
                        @endphp

                        @foreach($groups as $dokterName => $list)
                            @php $count = $list->count(); @endphp
                            @foreach($list as $rekam)
                                @php $rowNumber++; @endphp
                                <tr>
                                    <td class="text-center">{{ $rowNumber }}</td>
                                    <td>{{ $rekam->created_at }}</td>
                                    <td class="truncate-cell" title="{{ $rekam->anamnesa }}">{{ \Illuminate\Support\Str::limit($rekam->anamnesa ?? '', 10) }}</td>
                                    <td class="truncate-cell" title="{{ $rekam->temuan_klinis }}">{{ \Illuminate\Support\Str::limit($rekam->temuan_klinis ?? '', 10) }}</td>
                                    <td class="truncate-cell" title="{{ $rekam->diagnosa }}">{{ \Illuminate\Support\Str::limit($rekam->diagnosa ?? '', 10) }}</td>

                                    <td>{{ $rekam->nama_pet ?? 'N/A' }}</td>

                                    @if($loop->first)
                                        <td rowspan="{{ $count }}">{{ $dokterName }}</td>
                                    @endif
                                    <td class="text-center actions">
                                        <a href="{{ route('admin.datarekammedis.edit', $rekam->id ?? $rekam->idrekam_medis) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                        <form action="{{ route('admin.datarekammedis.destroy', $rekam->id ?? $rekam->idrekam_medis) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus rekam medis ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-admin sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
