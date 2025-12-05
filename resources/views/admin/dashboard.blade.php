@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $stats['users'] ?? 0 }}</h3>
                        <p>Users</p>
                    </div>
                    <div class="icon"><i class="bi bi-people"></i></div>
                    <a href="{{ route('admin.datauser.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $stats['pets'] ?? 0 }}</h3>
                        <p>Pets</p>
                    </div>
                    <div class="icon"><i class="bi bi-heart"></i></div>
                    <a href="{{ route('admin.datapet.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['rekam_medis'] ?? 0 }}</h3>
                        <p>Rekam Medis</p>
                    </div>
                    <div class="icon"><i class="bi bi-file-medical"></i></div>
                    <a href="{{ route('admin.datarekammedis.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>{{ $stats['tindakans'] ?? 0 }}</h3>
                        <p>Data Tindakan</p>
                    </div>
                    <div class="icon"><i class="bi bi-clipboard-plus"></i></div>
                    <a href="{{ route('admin.datatindakan.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-info">
                    <div class="inner">
                        <h3>{{ $stats['dokters'] ?? 0 }}</h3>
                        <p>Dokter</p>
                    </div>
                    <div class="icon"><i class="bi bi-person-badge"></i></div>
                    <a href="{{ route('admin.datadokter.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-secondary">
                    <div class="inner">
                        <h3>{{ $stats['perawats'] ?? 0 }}</h3>
                        <p>Perawat</p>
                    </div>
                    <div class="icon"><i class="bi bi-person-lines-fill"></i></div>
                    <a href="{{ route('admin.dataperawat.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
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
                                    <th>Pet</th>
                                    <th>Dokter</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['rekamMediss']->take(8) ?? collect() as $i => $r)
                                    <tr>
                                        <td>{{ $r->temuDokter->pet->nama ?? '-' }}</td>
                                        <td>{{ $r->roleUser->user->nama ?? '-' }}</td>
                                        <td>{{ optional(\Carbon\Carbon::parse($r->temuDokter->waktu_daftar ?? $r->created_at))->format('Y-m-d H:i') ?? '-' }}</td>
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
                        <div class="quick-grid">
                            <a href="{{ route('admin.datapet.index') }}" class="btn btn-quick btn-primary">Manage Pets</a>
                            <a href="{{ route('admin.datauser.index') }}" class="btn btn-quick btn-secondary">Manage Users</a>

                            <a href="{{ route('admin.datadokter.index') }}" class="btn btn-quick btn-success">Manage Dokter</a>
                            <a href="{{ route('admin.dataperawat.index') }}" class="btn btn-quick btn-info">Manage Perawat</a>

                            <a href="{{ route('admin.datapemilik.index') }}" class="btn btn-quick btn-warning">Manage Pemilik</a>
                            <a href="{{ route('admin.datarekammedis.index') }}" class="btn btn-quick btn-danger">Rekam Medis</a>

                            <a href="{{ route('admin.datatindakan.index') }}" class="btn btn-quick btn-dark">Data Tindakan</a>
                            <a href="{{ route('admin.temudokter.index') }}" class="btn btn-quick btn-light text-dark">Temu Dokter</a>

                            <a href="{{ route('admin.datakategori.index') }}" class="btn btn-quick btn-outline-primary">Kategori</a>
                            <a href="{{ route('admin.datakategoriklinis.index') }}" class="btn btn-quick btn-outline-secondary">Kategori Klinis</a>

                            <a href="{{ route('admin.jenishewan.index') }}" class="btn btn-quick btn-outline-success">Jenis Hewan</a>
                            <a href="{{ route('admin.rashewan.index') }}" class="btn btn-quick btn-outline-info">Ras Hewan</a>

                            <a href="{{ route('admin.manajemenrole.index') }}" class="btn btn-quick btn-outline-warning btn-full">Manajemen Role</a>
                        </div>
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

            // If no data, show a friendly empty state inside the card
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
                            // show label and value (not percent) for clarity
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

@push('styles')
    <style>
        /* Quick links grid */
        .quick-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: .5rem;
            align-items: center;
            justify-items: center; /* center buttons horizontally inside their cells */
        }

        /* Smaller, compact pill buttons centered in the card */
        .btn-quick {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            padding: .28rem .5rem;
            border-radius: 10px;
            font-size: .82rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            transition: transform .06s ease, box-shadow .06s ease;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 260px;
            min-width: 110px;
            width: auto;
        }

        .btn-quick:hover { transform: translateY(-1px); box-shadow: 0 3px 8px rgba(0,0,0,0.08); }

        /* Make outline variants visually consistent (light background + colored border) */
        .btn-quick.btn-outline-primary { background:#ffffff; color:var(--bs-primary); border:1px solid var(--bs-primary); }
        .btn-quick.btn-outline-secondary { background:#ffffff; color:var(--bs-secondary); border:1px solid var(--bs-secondary); }
        .btn-quick.btn-outline-success { background:#ffffff; color:var(--bs-success); border:1px solid var(--bs-success); }
        .btn-quick.btn-outline-info { background:#ffffff; color:var(--bs-info); border:1px solid var(--bs-info); }
        .btn-quick.btn-outline-warning { background:#ffffff; color:var(--bs-warning); border:1px solid var(--bs-warning); }

        /* Last button: span two columns but remain centered and constrained */
        .btn-full { grid-column: 1 / -1; justify-self: center; max-width: 360px; width: calc(100% - 2rem); }

        @media (max-width: 576px) {
            .quick-grid { grid-template-columns: 1fr; }
            .btn-quick { height: 40px; font-size: .86rem; min-width: auto; width: 100%; max-width: none; }
            .btn-full { grid-column: auto; width: 100%; }
        }
    </style>
@endpush
