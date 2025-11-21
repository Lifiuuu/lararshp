<!-- admin temudokter index -->
@extends('layouts.lte.main')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Daftar Temu Dokter (Admin)</h1>
        <a href="{{ route('admin.temudokter.create') }}" class="btn btn-primary">Buat Temu Dokter</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No Urut</th>
                <th>Waktu Daftar</th>
                <th>Status</th>
                <th>Nama Pet</th>
                <th>Nama Pemilik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($temudokters as $index => $t)
            <tr>
                <td>{{ $t->no_urut }}</td>
                <td>{{ $t->waktu_daftar }}</td>
                <td>
                    @if(trim($t->status) == 'D')
                        <span class="badge text-bg-success">Done</span>
                    @elseif(trim($t->status) == 'P')
                        <span class="badge text-bg-warning text-dark">Pending</span>
                    @elseif(trim($t->status) == 'B')
                        <span class="badge text-bg-danger">Batal</span>
                    @else
                        {{ $t->status }}
                    @endif
                </td>
                <td>{{ $t->pet_nama ?? '—' }}</td>
                <td>{{ $t->pemilik_nama ?? '—' }}</td>
                <td>
                    <a href="{{ route('admin.temudokter.edit', $t->idreservasi_dokter) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('admin.temudokter.destroy', $t->idreservasi_dokter) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus temu dokter ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
