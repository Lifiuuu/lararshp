@extends('layouts.lte.main')

@section('page-title', 'Data Pet')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('resepsionis.datapet.create') }}" class="btn btn-primary">Tambah Pet</a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-sm actions align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pets as $pet)
                        <tr>
                            <td>{{ $pet->idpet }}</td>
                            <td>{{ $pet->nama }}</td>
                            <td>{{ $pet->nama_pemilik ?? '—' }}</td>
                            <td class="actions">
                                <a href="{{ route('resepsionis.datapet.edit', $pet->idpet) }}" class="btn btn-sm btn-secondary btn-admin sm">Edit</a>
                                <form action="{{ route('resepsionis.datapet.destroy', $pet->idpet) }}" method="POST" style="display:inline-block; margin-left:6px;" onsubmit="return confirm('Hapus pet ini?')">
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
