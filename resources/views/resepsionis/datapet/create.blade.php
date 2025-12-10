@extends('layouts.lte.main')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#tanggal_lahir", {
        dateFormat: "Y-m-d",
        maxDate: "today"
    });
});
</script>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Tambah Pet</div>
            <div class="card-body">
                <form method="POST" action="{{ route('resepsionis.datapet.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama</label>
                        <input id="nama" name="nama" class="form-control" value="{{ old('nama') }}">
                        @error('nama')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                            <option value="J" @if(old('jenis_kelamin')=='J') selected @endif>Jantan</option>
                            <option value="B" @if(old('jenis_kelamin')=='B') selected @endif>Betina</option>
                        </select>
                        @error('jenis_kelamin')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                        <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="warna_tanda">Warna / Tanda</label>
                        <input id="warna_tanda" name="warna_tanda" class="form-control" value="{{ old('warna_tanda') }}">
                        @error('warna_tanda')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="idpemilik">Pemilik</label>
                        <input type="text" id="pemilik_search" name="pemilik_search" class="form-control" list="pemilik_list" placeholder="Ketik nama pemilik..." autocomplete="off">
                        <datalist id="pemilik_list">
                            @foreach($pemiliks as $pm)
                                <option value="{{ $pm->user->nama ?? ($pm->no_wa ?? 'Pemilik #' . $pm->idpemilik) }}" data-id="{{ $pm->idpemilik }}">
                            @endforeach
                        </datalist>
                        <input type="hidden" id="idpemilik" name="idpemilik">
                        @error('idpemilik')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="idras_hewan">Ras Hewan</label>
                        <select id="idras_hewan" name="idras_hewan" class="form-select">
                            @foreach($rasHewans as $r)
                                <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }} ({{ $r->jenisHewan->nama_jenis_hewan ?? '' }})</option>
                            @endforeach
                        </select>
                        @error('idras_hewan')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('resepsionis.datapet.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pemilik_search').addEventListener('input', function() {
            const selectedOption = Array.from(document.querySelectorAll('#pemilik_list option')).find(option => option.value === this.value);
            document.getElementById('idpemilik').value = selectedOption ? selectedOption.getAttribute('data-id') : '';
        });
    </script>
@endsection
