@extends('layouts.lte.main')

@section('page-title', 'My Pets')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered actions align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Warna Tanda</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Ras Hewan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pets as $index => $pet)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $pet->nama }}</td>
                                    <td>{{ $pet->tanggal_lahir }}</td>
                                    <td>{{ $pet->warna_tanda }}</td>
                                    <td>{{ $pet->jenis_kelamin }}</td>
                                    <td>{{ $pet->nama_ras ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
