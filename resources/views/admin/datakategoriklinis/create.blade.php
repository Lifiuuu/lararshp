@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Kategori</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datakategoriklinis.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nama">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.datakategoriklinis.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection