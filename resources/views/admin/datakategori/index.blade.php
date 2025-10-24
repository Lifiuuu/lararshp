@extends('layouts.app')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data Kategori</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $index => $kategori)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $kategori->nama_kategori }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
