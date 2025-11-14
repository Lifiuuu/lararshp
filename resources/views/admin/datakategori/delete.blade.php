@extends('layouts.lte.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hapus Data Kategori</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datakategori.destroy', $kategori->idkategori) }}">
                            @csrf
                            @method('DELETE')

                            <p>Apakah Anda yakin ingin menghapus kategori <strong>{{ $kategori->nama_kategori }}</strong>?</p>

                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <a href="{{ route('admin.datakategori.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection