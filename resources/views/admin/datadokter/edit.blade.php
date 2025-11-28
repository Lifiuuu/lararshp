@extends('layouts.lte.main')

@section('content')
    @if(empty($dokter))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-danger">Data dokter tidak ditemukan. <a href="{{ route('admin.datadokter.index') }}">Kembali ke daftar</a></div>
                </div>
            </div>
        </div>
    @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Data Dokter</div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datadokter.update', $dokter->id_dokter) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="id_user">User</label>
                                <select class="form-control @error('id_user') is-invalid @enderror" id="id_user" name="id_user" required>
                                    <option value="">Pilih User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->iduser }}" {{ old('id_user', $dokter->id_user) == $user->iduser ? 'selected' : '' }}>{{ $user->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" 
                                       class="form-control @error('alamat') is-invalid @enderror" 
                                       id="alamat" 
                                       name="alamat" 
                                       value="{{ old('alamat', $dokter->alamat) }}" 
                                       placeholder="Masukkan alamat"
                                       required>

                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="text" 
                                       class="form-control @error('no_hp') is-invalid @enderror" 
                                       id="no_hp" 
                                       name="no_hp" 
                                       value="{{ old('no_hp', $dokter->no_hp) }}" 
                                       placeholder="Masukkan nomor HP"
                                       required>

                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bidang_dokter">Bidang Dokter</label>
                                <input type="text" 
                                       class="form-control @error('bidang_dokter') is-invalid @enderror" 
                                       id="bidang_dokter" 
                                       name="bidang_dokter" 
                                       value="{{ old('bidang_dokter', $dokter->bidang_dokter) }}" 
                                       placeholder="Masukkan bidang dokter"
                                       required>

                                @error('bidang_dokter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" id="jenis_kelamin_l" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'L' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="jenis_kelamin_l">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" id="jenis_kelamin_p" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'P' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="jenis_kelamin_p">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.datadokter.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection