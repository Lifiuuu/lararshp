@extends('layouts.admin.admin')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data Rekam Medis</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.datarekammedis.create') }}" class="btn-admin primary" style="text-align:left">Tambah Data Rekam Medis</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">ID Rekam Medis</th>
                <th class="py-2 px-4 border-b">Created At</th>
                <th class="py-2 px-4 border-b">Anamnesa</th>
                <th class="py-2 px-4 border-b">Temuan Klinis</th>
                <th class="py-2 px-4 border-b">Diagnosa</th>
                <th class="py-2 px-4 border-b">ID Reservasi Dokter</th>
                <th class="py-2 px-4 border-b">Pet</th>
                <th class="py-2 px-4 border-b">Dokter Pemeriksa</th>
            </tr>
        </thead>
        <tbody>
            @php
                $groups = $rekamMediss->groupBy(function($r) {
                    // group by pet name where possible
                    return $r->temuDokter->pet->nama ?? $r->pet->nama ?? 'N/A';
                });
                $rowNumber = 0;
            @endphp

            @foreach($groups as $petName => $list)
                @php $count = $list->count(); @endphp
                @foreach($list as $rekam)
                    @php $rowNumber++; @endphp
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $rowNumber }}</td>
                        <td class="py-2 px-4 border-b">{{ $rekam->idrekam_medis }}</td>
                        <td class="py-2 px-4 border-b">{{ $rekam->created_at }}</td>
                        <td class="py-2 px-4 border-b">{{ $rekam->anamnesa }}</td>
                        <td class="py-2 px-4 border-b">{{ $rekam->temuan_klinis }}</td>
                        <td class="py-2 px-4 border-b">{{ $rekam->diagnosa }}</td>
                        <td class="py-2 px-4 border-b">{{ $rekam->idreservasi_dokter }}</td>

                        @if($loop->first)
                            <td class="py-2 px-4 border-b" rowspan="{{ $count }}">{{ $petName }}</td>
                        @endif

                        <td class="py-2 px-4 border-b">{{ $rekam->roleUser->user->nama ?? 'N/A' }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.datarekammedis.edit', $rekam->id ?? $rekam->idrekam_medis) }}" class="btn-admin ghost">Edit</a>
                            <form action="{{ route('admin.datarekammedis.destroy', $rekam->id ?? $rekam->idrekam_medis) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus rekam medis ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-admin warn">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        </table>
    </div>
</section>
@endsection
