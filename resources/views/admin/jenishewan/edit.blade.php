@extends('layouts.lte.main')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Edit Jenis Hewan</div>

					<div class="card-body">
						<form method="POST" action="{{ route('admin.jenishewan.update', $jenis->idjenis_hewan) }}">
							@csrf
							@method('PUT')

							<div class="form-group">
								<label for="nama_jenis_hewan">Nama Jenis Hewan</label>
								<input type="text" 
									class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
									id="nama_jenis_hewan" 
									name="nama_jenis_hewan" 
									value="{{ old('nama_jenis_hewan', $jenis->nama_jenis_hewan) }}" 
									placeholder="Masukkan nama jenis hewan"
									required>

								@error('nama_jenis_hewan')
									<div class="invalid-feedback">
										<strong>{{ $message }}</strong>
									</div>
								@enderror
							</div>

							<div class="mt-3">
								<button type="submit" class="btn btn-primary">Update</button>
								<a href="{{ route('admin.jenishewan.index') }}" class="btn btn-secondary">Batal</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
