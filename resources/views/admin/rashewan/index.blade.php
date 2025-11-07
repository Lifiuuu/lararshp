@extends('layouts.admin.admin')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Ras Hewan</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.rashewan.create') }}" class="btn-admin primary" style="text-align:left">Tambah Ras Hewan</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama Ras</th>
                <th class="py-2 px-4 border-b">Jenis Hewan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rasHewans as $index => $rasHewan)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $rasHewan->nama_ras }}</td>
                <td class="py-2 px-4 border-b">{{ $rasHewan->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</td>
                <td class="actions">
                    <a href="{{ route('admin.rashewan.edit', $rasHewan->idras_hewan ?? $rasHewan->idras ?? $rasHewan->id) }}" class="btn-admin ghost">Edit</a>
                    <form action="{{ route('admin.rashewan.destroy', $rasHewan->idras_hewan ?? $rasHewan->idras ?? $rasHewan->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus ras hewan ini?')">
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
