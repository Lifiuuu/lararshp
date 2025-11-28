@extends('layouts.lte.main')

@section('page-title', 'Ras Hewan')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.rashewan.create') }}" class="btn btn-primary">Tambah Ras Hewan</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Ras</th>
                            <th>Jenis Hewan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Group ras by jenis hewan name; provide fallback label when missing
                            // controller returns `nama_jenis_hewan` via join; fallback to relation if present
                            $groups = $rasHewans->groupBy(function($r) {
                                return $r->nama_jenis_hewan ?? ($r->jenisHewan->nama_jenis_hewan ?? 'N/A');
                            });
                            $rowNumber = 0;
                        @endphp

                        @foreach($groups as $jenisName => $rasList)
                            @php $count = $rasList->count(); @endphp
                            @foreach($rasList as $ras)
                                @php $rowNumber++; @endphp
                                <tr>
                                    <td class="text-center">{{ $rowNumber }}</td>
                                    <td>{{ $ras->nama_ras }}</td>

                                    @if($loop->first)
                                        <td rowspan="{{ $count }}">{{ $jenisName }}</td>
                                    @endif

                                    <td class="text-center actions">
                                        <a href="{{ route('admin.rashewan.edit', $ras->idras_hewan ?? $ras->idras ?? $ras->id) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                        <form action="{{ route('admin.rashewan.destroy', $ras->idras_hewan ?? $ras->idras ?? $ras->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus ras hewan ini?')">
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
