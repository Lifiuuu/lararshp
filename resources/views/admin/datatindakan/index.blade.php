@extends('layouts.app')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data Tindakan</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Kode</th>
                <th class="py-2 px-4 border-b">Deskripsi Tindakan Terapi</th>
                <th class="py-2 px-4 border-b">Kategori</th>
                <th class="py-2 px-4 border-b">Kategori Klinis</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tindakans as $index => $tindakan)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $tindakan->kode }}</td>
                <td class="py-2 px-4 border-b">{{ $tindakan->deskripsi_tindakan_terapi }}</td>
                <td class="py-2 px-4 border-b">{{ $tindakan->kategori->nama_kategori ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $tindakan->kategoriKlinis->nama_kategori_klinis ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
