@extends('layouts.lte.main')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Edit Pemilik</div>

					<div class="card-body">
						<form method="POST" action="{{ route('admin.datapemilik.update', $pemilik->idpemilik) }}">
							@csrf
							@method('PUT')

							<div class="form-group">
								<label for="nama">Nama Pemilik</label>
								<input type="text"
									   class="form-control @error('nama') is-invalid @enderror"
									   id="nama"
									   name="nama"
									   value="{{ old('nama', $pemilik->user->nama ?? '') }}"
									   placeholder="Masukkan nama pemilik"
									   required>

								@error('nama')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input type="text"
									   class="form-control @error('alamat') is-invalid @enderror"
									   id="alamat"
									   name="alamat"
									   value="{{ old('alamat', $pemilik->alamat) }}"
									   placeholder="Masukkan alamat"
									   required>

								@error('alamat')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="form-group">
								<label for="telepon">No. Telepon</label>
								<input type="tel"
									   class="form-control @error('telepon') is-invalid @enderror"
									   id="telepon"
									   name="telepon"
									   value="{{ old('telepon', $pemilik->no_wa) }}"
									   placeholder="Masukkan nomor telepon (angka saja)"
									   required>

								@error('telepon')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="mt-3">
								<button type="submit" class="btn btn-primary">Update</button>
								<a href="{{ route('admin.datapemilik.index') }}" class="btn btn-secondary">Batal</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
