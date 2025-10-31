@extends('layouts.app')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Rekam Medis Pet Anda</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Created At</th>
                <th class="py-2 px-4 border-b">Anamnesa</th>
                <th class="py-2 px-4 border-b">Temuan Klinis</th>
                <th class="py-2 px-4 border-b">Diagnosa</th>
                <th class="py-2 px-4 border-b">Pet</th>
                <th class="py-2 px-4 border-b">Dokter Pemeriksa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekamMediss as $index => $rekamMedis)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->created_at }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->anamnesa }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->temuan_klinis }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->diagnosa }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->temuDokter->pet->nama ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $rekamMedis->roleUser->user->nama ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
