@extends('layouts.admin.admin')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data Pet</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.datapet.create') }}" class="btn-admin primary" style="text-align:left">Tambah Data Pet</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Tanggal Lahir</th>
                <th class="py-2 px-4 border-b">Warna Tanda</th>
                <th class="py-2 px-4 border-b">Jenis Kelamin</th>
                <th class="py-2 px-4 border-b">Pemilik</th>
                <th class="py-2 px-4 border-b">Ras Hewan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $index => $pet)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->nama }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->tanggal_lahir }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->warna_tanda }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->jenis_kelamin }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->pemilik->user->nama ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $pet->rasHewan->nama_ras ?? 'N/A' }}</td>
                <td class="actions">
                    <a href="{{ route('admin.datapet.edit', $pet->id ?? $pet->idpet) }}" class="btn-admin ghost">Edit</a>
                    <form action="{{ route('admin.datapet.destroy', $pet->id ?? $pet->idpet) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus data pet ini?')">
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
