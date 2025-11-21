@extends('layouts.lte.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Data User</div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datauser.update', $user->iduser) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text"
                                       class="form-control @error('nama') is-invalid @enderror"
                                       id="nama"
                                       name="nama"
                                       value="{{ old('nama', $user->nama) }}"
                                       placeholder="Masukkan nama user"
                                       required>

                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       placeholder="Masukkan email"
                                       required>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Masukkan password baru">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password"
                                       class="form-control"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Konfirmasi password baru">
                            </div>

                            <div class="form-group">
                                <label for="roles">Role</label>
                                <select class="form-control @error('roles') is-invalid @enderror"
                                        id="roles"
                                        name="roles[]"
                                        multiple
                                        required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->idrole }}" {{ (in_array($role->idrole, old('roles', $userRoles))) ? 'selected' : '' }}>
                                            {{ $role->nama_role }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Tahan Ctrl untuk memilih multiple role</small>

                                @error('roles')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Role-specific sections -->
                            <div id="role-sections" class="mt-3">
                                <!-- Pemilik fields -->
                                <div id="section-pemilik" style="display:none;" class="card card-body mb-3">
                                    <h5>Pemilik — Informasi Tambahan</h5>
                                    <div class="form-group">
                                        <label for="pemilik_no_wa">No WA</label>
                                        <input type="text" class="form-control" id="pemilik_no_wa" name="pemilik_no_wa" value="{{ old('pemilik_no_wa', $pemilikData->no_wa ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="pemilik_alamat">Alamat</label>
                                        <input type="text" class="form-control" id="pemilik_alamat" name="pemilik_alamat" value="{{ old('pemilik_alamat', $pemilikData->alamat ?? '') }}">
                                    </div>
                                </div>

                                <!-- Dokter fields -->
                                <div id="section-dokter" style="display:none;" class="card card-body mb-3">
                                    <h5>Dokter — Informasi Tambahan</h5>
                                    <div class="form-group">
                                        <label for="dokter_alamat">Alamat</label>
                                        <input type="text" class="form-control" id="dokter_alamat" name="dokter_alamat" value="{{ old('dokter_alamat', $dokterData->alamat ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="dokter_no_hp">No HP</label>
                                        <input type="text" class="form-control" id="dokter_no_hp" name="dokter_no_hp" value="{{ old('dokter_no_hp', $dokterData->no_hp ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="dokter_bidang_dokter">Bidang Dokter</label>
                                        <input type="text" class="form-control" id="dokter_bidang_dokter" name="dokter_bidang_dokter" value="{{ old('dokter_bidang_dokter', $dokterData->bidang_dokter ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="dokter_jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control" id="dokter_jenis_kelamin" name="dokter_jenis_kelamin">
                                            <option value="">Pilih</option>
                                            <option value="L" {{ old('dokter_jenis_kelamin', $dokterData->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('dokter_jenis_kelamin', $dokterData->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Perawat fields -->
                                <div id="section-perawat" style="display:none;" class="card card-body mb-3">
                                    <h5>Perawat — Informasi Tambahan</h5>
                                    <div class="form-group">
                                        <label for="perawat_alamat">Alamat</label>
                                        <input type="text" class="form-control" id="perawat_alamat" name="perawat_alamat" value="{{ old('perawat_alamat', $perawatData->alamat ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="perawat_no_hp">No HP</label>
                                        <input type="text" class="form-control" id="perawat_no_hp" name="perawat_no_hp" value="{{ old('perawat_no_hp', $perawatData->no_hp ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="perawat_jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control" id="perawat_jenis_kelamin" name="perawat_jenis_kelamin">
                                            <option value="">Pilih</option>
                                            <option value="L" {{ old('perawat_jenis_kelamin', $perawatData->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('perawat_jenis_kelamin', $perawatData->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="perawat_pendidikan">Pendidikan</label>
                                        <input type="text" class="form-control" id="perawat_pendidikan" name="perawat_pendidikan" value="{{ old('perawat_pendidikan', $perawatData->pendidikan ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            <script>
                                (function(){
                                    const rolesSelect = document.getElementById('roles');
                                    const sectionPemilik = document.getElementById('section-pemilik');
                                    const sectionDokter = document.getElementById('section-dokter');
                                    const sectionPerawat = document.getElementById('section-perawat');

                                    function updateSections(){
                                        const selected = Array.from(rolesSelect.options).filter(o=>o.selected).map(o=>o.text.trim().toLowerCase());
                                        sectionPemilik.style.display = selected.includes('pemilik') ? 'block' : 'none';
                                        sectionDokter.style.display = selected.includes('dokter') ? 'block' : 'none';
                                        sectionPerawat.style.display = selected.includes('perawat') ? 'block' : 'none';
                                    }

                                    rolesSelect.addEventListener('change', updateSections);
                                    // run once on load to preserve old values
                                    document.addEventListener('DOMContentLoaded', updateSections);
                                    // In case the Blade renders before DOMContentLoaded
                                    updateSections();
                                })();
                            </script>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.datauser.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
