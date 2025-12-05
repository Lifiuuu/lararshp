@extends('layouts.lte.main')

@section('content')
	<div class="container-fluid p-3">
		<div class="row mb-3">
			<div class="col-lg-6 col-12">
				<div class="small-box text-bg-success">
					<div class="inner">
						<h3>{{ $stats['rekam_medis'] ?? 0 }}</h3>
						<p>Rekam Medis</p>
					</div>
					<div class="icon"><i class="bi bi-file-medical"></i></div>
					<a href="{{ route('perawat.datarekammedis.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8">
				<div class="card mb-3">
					<div class="card-header">Monthly Visits</div>
					<div class="card-body">
						<div id="visits-chart" style="height:320px;"></div>
					</div>
				</div>

				<div class="card">
					<div class="card-header">Recent Rekam Medis</div>
					<div class="card-body table-responsive">
						<table class="table table-striped table-sm">
							<thead>
								<tr>
									<th>No</th>
									<th>Pet</th>
									<th>Dokter</th>
									<th>Waktu</th>
								</tr>
							</thead>
							<tbody>
								@foreach(($data['rekamMediss'] ?? collect())->take(8) as $i => $r)
									<tr>
										<td>{{ $i + 1 }}</td>
										<td>{{ $r->temuDokter->pet->nama ?? '-' }}</td>
										<td>{{ $r->roleUser->user->nama ?? '-' }}</td>
										<td>{{ optional(\Carbon\Carbon::parse($r->temuDokter->waktu_daftar ?? $r->created_at ?? null))->format('Y-m-d H:i') ?? '-' }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="card mb-3">
					<div class="card-header">Pet Distribution by Ras</div>
					<div class="card-body">
						<div id="pet-pie" style="height:320px;"></div>
					</div>
				</div>

				<div class="card">
					<div class="card-header">Quick Links</div>
					<div class="card-body">
						<a href="{{ route('perawat.datarekammedis.index') }}" class="btn btn-sm btn-secondary mb-2">Manage Rekam Medis</a>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@push('scripts')
	<!-- ApexCharts CDN -->
	<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"></script>
	<script>
		(function(){
			// Monthly visits data (delimited strings parsed into arrays to avoid json_encode)
			const months = ("{{ $monthlyLabelsCsv ?? '' }}" === '') ? [] : "{{ $monthlyLabelsCsv }}".split('|');
			const visits = ("{{ $monthlyTotalsCsv ?? '' }}" === '') ? [] : "{{ $monthlyTotalsCsv }}".split(',').map(Number);

			const visitsOptions = {
				series: [{ name: 'Visits', data: visits }],
				chart: { type: 'area', height: 320, toolbar: { show: false } },
				xaxis: { categories: months },
				colors: ['#0d6efd'],
				dataLabels: { enabled: false },
				stroke: { curve: 'smooth' }
			};
			const visitsChart = new ApexCharts(document.querySelector('#visits-chart'), visitsOptions);
			visitsChart.render();

			// Pet pie
			const petLabels = ("{{ $petLabelsCsv ?? '' }}" === '') ? [] : "{{ $petLabelsCsv }}".split('|');
			const petValues = ("{{ $petValuesCsv ?? '' }}" === '') ? [] : "{{ $petValuesCsv }}".split(',').map(Number);

			const petContainer = document.querySelector('#pet-pie');
			if (!petValues || petValues.length === 0) {
				petContainer.innerHTML = '<div class="d-flex align-items-center justify-content-center" style="height:320px;"><div class="text-muted">No pet data available</div></div>';
			} else {
				const petOptions = {
					series: petValues,
					chart: { type: 'donut', height: 320 },
					labels: petLabels,
					legend: { position: 'bottom' },
					dataLabels: {
						enabled: true,
						formatter: function (val, opts) {
							const label = opts.w.globals.labels[opts.seriesIndex] || '';
							return label + '\n' + Math.round(val);
						}
					},
					colors: ['#0d6efd','#198754','#ffc107','#dc3545','#6f42c1','#fd7e14']
				};
				const petChart = new ApexCharts(petContainer, petOptions);
				petChart.render();
			}
		})();
	</script>
@endpush

