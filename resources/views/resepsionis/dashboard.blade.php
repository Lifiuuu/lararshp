@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
		<div class="row mb-3">
			<div class="col-lg-6 col-12">
				<div class="small-box text-bg-success">
					<div class="inner">
						<h3>{{ isset($data['pemiliks']) ? count($data['pemiliks']) : 0 }}</h3>
                        <p>Pemilik</p>
					</div>
					<div class="icon"><i class="bi bi-file-medical"></i></div>
					<a href="{{ route('perawat.datarekammedis.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
				</div>
			</div>
		</div>

    <div class="container-fluid p-3">
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ isset($data['pemiliks']) ? count($data['pemiliks']) : 0 }}</h3>
                        <p>Pemilik</p>
                    </div>
                    <div class="icon"><i class="bi bi-people-fill"></i></div>
                    <a href="{{ route('resepsionis.datapemilik.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ isset($data['pets']) ? count($data['pets']) : 0 }}</h3>
                        <p>Pets</p>
                    </div>
                    <div class="icon"><i class="bi bi-paw"></i></div>
                    <a href="{{ route('resepsionis.datapet.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-info">
                    <div class="inner">
                        <h3>{{ isset($data['temudokters']) ? count($data['temudokters']) : 0 }}</h3>
                        <p>Temu Dokter</p>
                    </div>
                    <div class="icon"><i class="bi bi-calendar-check"></i></div>
                    <a href="{{ route('resepsionis.temudokter.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-secondary">
                    <div class="inner">
                        <h3>{{ isset($data['rekamMediss']) ? count($data['rekamMediss']) : 0 }}</h3>
                        <p>Rekam Medis</p>
                    </div>
                    <div class="icon"><i class="bi bi-file-medical"></i></div>
                    <a href="{{ route('resepsionis.datarekammedis.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-header">Recent Appointments</div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Urut</th>
                                    <th>Pet</th>
                                    <th>Pemilik</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice(($data['temudokters'] ?? collect())->toArray() ?? [], 0, 8) as $i => $t)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $t->no_urut ?? '-' }}</td>
                                        <td>{{ $t->pet_nama ?? '-' }}</td>
                                        <td>{{ $t->pemilik_nama ?? '-' }}</td>
                                        <td>{{ optional(\Carbon\Carbon::parse($t->waktu_daftar ?? $t->created_at ?? null))->format('Y-m-d H:i') ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">Quick Links</div>
                    <div class="card-body">
                        <a href="{{ route('resepsionis.datapemilik.index') }}" class="btn btn-sm btn-primary mb-2">Manage Pemilik</a>
                        <a href="{{ route('resepsionis.datapet.index') }}" class="btn btn-sm btn-secondary mb-2">Manage Pets</a>
                        <a href="{{ route('resepsionis.temudokter.index') }}" class="btn btn-sm btn-info mb-2">Manage Appointments</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
