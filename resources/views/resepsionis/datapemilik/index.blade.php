@extends('layouts.lte.main')

@section('page-title', 'Data Pemilik')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('resepsionis.datapemilik.create') }}" class="btn btn-primary">Tambah Pemilik</a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-sm actions align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No WA</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemiliks as $p)
                        <tr>
                            <td>{{ $p->user->nama ?? '—' }}</td>
                            <td>{{ $p->no_wa }}</td>
                            <td class="actions">
                                <a href="{{ route('resepsionis.datapemilik.edit', $p->idpemilik) }}" class="btn btn-sm btn-secondary btn-admin sm">Edit</a>
                                <form action="{{ route('resepsionis.datapemilik.destroy', $p->idpemilik) }}" method="POST" style="display:inline-block; margin-left:6px;" onsubmit="return confirm('Hapus pemilik ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-admin sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
