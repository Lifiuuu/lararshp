@extends('layouts.lte.main')

@section('page-title', 'Data Pet')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.datapet.create') }}" class="btn btn-primary">Tambah Data Pet</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Warna Tanda</th>
                            <th>Jenis Kelamin</th>
                            <th>Pemilik</th>
                            <th>Ras Hewan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Group pets by owner name (controller provides flat fields `nama_pemilik` and `pemilik_no_wa`)
                            $groups = $pets->groupBy(function($p) {
                                return $p->nama_pemilik ?? $p->pemilik_no_wa ?? 'N/A';
                            });
                            $rowNumber = 0;
                        @endphp

                        @foreach($groups as $pemilikName => $petList)
                            @php $count = $petList->count(); @endphp
                            @foreach($petList as $pet)
                                @php $rowNumber++; @endphp
                                <tr>
                                    <td class="text-center">{{ $rowNumber }}</td>
                                    <td>{{ $pet->nama }}</td>
                                    <td>{{ $pet->tanggal_lahir }}</td>
                                    <td>{{ $pet->warna_tanda }}</td>
                                    <td>{{ $pet->jenis_kelamin }}</td>

                                    @if($loop->first)
                                        <td rowspan="{{ $count }}">{{ $pemilikName }}</td>
                                    @endif

                                    <td>{{ $pet->nama_ras ?? 'N/A' }}</td>
                                    <td class="text-center actions">
                                        <a href="{{ route('admin.datapet.edit', $pet->id ?? $pet->idpet) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                        <form action="{{ route('admin.datapet.destroy', $pet->id ?? $pet->idpet) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus data pet ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-admin sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
