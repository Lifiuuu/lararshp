@extends('layouts.lte.main')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data Pemilik</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.datapemilik.create') }}" class="btn-admin primary" style="text-align:left">Tambah Data Pemilik</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
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
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $pemilik->user->nama ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $pemilik->no_wa }}</td>
                <td class="py-2 px-4 border-b">{{ $pemilik->alamat }}</td>
                <td class="actions">
                    <a href="{{ route('admin.datapemilik.edit', $pemilik->id ?? $pemilik->idpemilik) }}" class="btn-admin ghost">Edit</a>
                    <form action="{{ route('admin.datapemilik.destroy', $pemilik->id ?? $pemilik->idpemilik) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus pemilik ini?')">
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
