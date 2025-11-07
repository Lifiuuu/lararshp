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
            @foreach($rekamMediss as $index => $rekamMedis)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->idrekam_medis }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->created_at }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->anamnesa }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->temuan_klinis }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->diagnosa }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->idreservasi_dokter }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->temuDokter->pet->nama ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->roleUser->user->nama ?? 'N/A' }}</td>
                <td class="actions">
                    <a href="{{ route('admin.datarekammedis.edit', $rekamMedis->id ?? $rekamMedis->idrekam_medis) }}" class="btn-admin ghost">Edit</a>
                    <form action="{{ route('admin.datarekammedis.destroy', $rekamMedis->id ?? $rekamMedis->idrekam_medis) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus rekam medis ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-admin warn">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</section>
@endsection
