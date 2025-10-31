@extends('layouts.app')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Pet Anda</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Tanggal Lahir</th>
                <th class="py-2 px-4 border-b">Warna Tanda</th>
                <th class="py-2 px-4 border-b">Jenis Kelamin</th>
                <th class="py-2 px-4 border-b">Ras Hewan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $index => $pet)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->nama }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->tanggal_lahir }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->warna_tanda }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->jenis_kelamin }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->rasHewan->nama_ras ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
