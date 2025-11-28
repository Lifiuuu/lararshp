<!-- admin temudokter index -->
@extends('layouts.lte.main')

@section('page-title', 'Temu Dokter')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start align-items-center mb-3">
        <a href="{{ route('admin.temudokter.create') }}" class="btn btn-primary me-3">Buat Temu Dokter</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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
                            <td class="actions">
                                <a href="{{ route('admin.temudokter.edit', $t->idreservasi_dokter) }}" class="btn btn-sm btn-secondary btn-admin sm">Edit</a>
                                <form action="{{ route('admin.temudokter.destroy', $t->idreservasi_dokter) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus temu dokter ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger btn-admin sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
