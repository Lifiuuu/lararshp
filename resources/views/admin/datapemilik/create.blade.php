@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Kategori</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pemilik.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nama">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="telepon">No Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" required>
                            </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection