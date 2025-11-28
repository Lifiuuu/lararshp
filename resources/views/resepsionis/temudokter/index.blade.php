@extends('layouts.lte.main')

@section('page-title', 'Daftar Temu Dokter')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Temu Dokter</li>
@endsection

@section('content')
<div class="container">
    <!-- Form Pendaftaran Temu Dokter -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Pendaftaran Temu Dokter</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('resepsionis.temudokter.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="idpet" class="form-label">Pilih Pet dan Pemilik</label>
                        <select name="idpet" id="idpet" class="form-select" required>
                            <option value="">-- Pilih Pet --</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->idpet }}">{{ $pet->nama }} - {{ $pet->nama_pemilik }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="idrole_user" class="form-label">Pilih Dokter Pemeriksa</label>
                        <select name="idrole_user" id="idrole_user" class="form-select" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->idrole_user }}">{{ $doctor->user_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Daftar Temu Dokter</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Temu Dokter -->
    <div class="card">
        <div class="card-header">
            <h5>Daftar Temu Dokter</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped actions align-middle">
                <thead>
                    <tr>
                        <th>No. Urut</th>
                        <th>Waktu Daftar</th>
                        <th>Status</th>
                        <th>Nama Pet</th>
                        <th>Nama Pemilik</th>
                        <th>Nama Dokter</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($temudokters as $temu)
                        <tr>
                            <td>{{ $temu->no_urut }}</td>
                            <td>{{ $temu->waktu_daftar }}</td>
                            <td>
                                @if($temu->status == 'P')
                                    Pending
                                @elseif($temu->status == 'D')
                                    Selesai
                                @elseif($temu->status == 'C')
                                    Batal
                                @else
                                    {{ $temu->status }}
                                @endif
                            </td>
                            <td>{{ $temu->nama_pet }}</td>
                            <td>{{ $temu->nama_pemilik }}</td>
                            <td>
                                @php
                                    $doctor = $doctors->where('idrole_user', $temu->idrole_user)->first();
                                @endphp
                                {{ $doctor ? $doctor->user_nama : 'N/A' }}
                            </td>
                            <td class="actions">
                                <a href="{{ route('resepsionis.temudokter.edit', $temu->idreservasi_dokter) }}" class="btn btn-sm btn-warning btn-admin sm">Edit</a>
                                <form action="{{ route('resepsionis.temudokter.destroy', $temu->idreservasi_dokter) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-admin sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data temu dokter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection