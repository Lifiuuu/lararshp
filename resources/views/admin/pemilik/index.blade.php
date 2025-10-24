@extends('layouts.app')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Pemilik</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">No WA</th>
                <th class="py-2 px-4 border-b">Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemiliks as $index => $pemilik)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $pemilik->user->nama ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $pemilik->no_wa }}</td>
                <td class="py-2 px-4 border-b">{{ $pemilik->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
