@extends('layouts.app')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Temu Dokter</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">No Urut</th>
                <th class="py-2 px-4 border-b">Waktu Daftar</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Nama Pet</th>
                <th class="py-2 px-4 border-b">Nama Dokter</th>
            </tr>
        </thead>
        <tbody>
            @foreach($temudokters as $index => $temudokter)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $temudokter->no_urut }}</td>
                <td class="py-2 px-4 border-b">{{ $temudokter->waktu_daftar }}</td>
                <td class="py-2 px-4 border-b">{{ $temudokter->status }}</td>
                <td class="py-2 px-4 border-b">{{ $temudokter->pet->nama ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $temudokter->dokter->nama ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
