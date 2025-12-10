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
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Edit Data Pet</div>

					<div class="card-body">
						<form method="POST" action="{{ route('admin.datapet.update', $pet->idpet) }}">
							@csrf
							@method('PUT')

							<div class="form-group mb-3">
								<label for="nama">Nama Pet</label>
								<input type="text" 
									class="form-control @error('nama') is-invalid @enderror" 
									id="nama" 
									name="nama"
									value="{{ old('nama', $pet->nama) }}" 
									placeholder="Masukkan nama pet"
								required>
								@error('nama')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group mb-3">
								<label for="jenis_kelamin">Jenis Kelamin</label>
								<select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
									<option value="">Pilih Jenis Kelamin</option>
									<option value="J" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' ? 'selected' : '' }}>Jantan</option>
									<option value="B" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' ? 'selected' : '' }}>Betina</option>
								</select>
								@error('jenis_kelamin')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group mb-3">
								<label for="tanggal_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}" required>
								@error('tanggal_lahir')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group mb-3">
								<label for="warna_tanda">Warna/Tanda</label>
								<input type="text" class="form-control @error('warna_tanda') is-invalid @enderror" id="warna_tanda" name="warna_tanda" value="{{ old('warna_tanda', $pet->warna_tanda) }}" placeholder="Masukkan warna atau tanda khusus" required>
								@error('warna_tanda')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group mb-3">
								<label for="idpemilik">Pemilik</label>
								<select class="form-control @error('idpemilik') is-invalid @enderror" id="idpemilik" name="idpemilik" required>
									<option value="">Pilih Pemilik</option>
									@foreach($pemiliks as $pemilik)
										<option value="{{ $pemilik->idpemilik }}" {{ old('idpemilik', $pet->idpemilik) == $pemilik->idpemilik ? 'selected' : '' }}>
											{{ $pemilik->user->nama ?? ($pemilik->no_wa ?? 'Pemilik #' . $pemilik->idpemilik) }}
										</option>
									@endforeach
								</select>
								@error('idpemilik')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group mb-3">
								<label for="idras_hewan">Ras Hewan</label>
								<select class="form-control @error('idras_hewan') is-invalid @enderror" id="idras_hewan" name="idras_hewan" required>
									<option value="">Pilih Ras Hewan</option>
									@foreach($rasHewans as $ras)
										<option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan', $pet->idras_hewan) == $ras->idras_hewan ? 'selected' : '' }}>
											{{ $ras->nama_ras }} ({{ $ras->jenisHewan->nama_jenis_hewan }})
										</option>
									@endforeach
								</select>
								@error('idras_hewan')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="mt-3">
								<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
								<a href="{{ route('admin.datapet.index') }}" class="btn btn-secondary">Batal</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
