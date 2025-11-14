@extends('layouts.lte.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Ras Hewan</div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.rashewan.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nama_ras">Nama Ras</label>
                                <input type="text" 
                                       class="form-control @error('nama_ras') is-invalid @enderror" 
                                       id="nama_ras" 
                                       name="nama_ras"
                                       value="{{ old('nama_ras') }}" 
                                       placeholder="Masukkan nama ras hewan"
                                       required>
                            
                                @error('nama_ras')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="idjenis_hewan">Jenis Hewan</label>
                                <select class="form-control @error('idjenis_hewan') is-invalid @enderror" 
                                        id="idjenis_hewan" 
                                        name="idjenis_hewan" 
                                        required>
                                    <option value="">Pilih Jenis Hewan</option>
                                    @foreach($jenisHewans as $jenis)
                                        <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis_hewan }}
                                        </option>
                                    @endforeach
                                </select>
                            
                                @error('idjenis_hewan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.rashewan.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
