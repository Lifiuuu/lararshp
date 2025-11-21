@extends('layouts.lte.main')

@section('content')
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hapus Data Rekam Medis</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('perawat.datarekammedis.destroy', $rekam->idrekam_medis) }}">
                            @csrf
                            @method('DELETE')

                            <p>Apakah Anda yakin ingin menghapus rekam medis untuk pet <strong>{{ $rekam->nama_pet ?? '-' }}</strong>?</p>

                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <a href="{{ route('perawat.datarekammedis.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection