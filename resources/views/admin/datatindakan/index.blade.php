@extends('layouts.lte.main')

@section('page-title', 'Data Tindakan')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.datatindakan.create') }}" class="btn btn-primary">Tambah Data Tindakan</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode</th>
                            <th>Deskripsi Tindakan Terapi</th>
                            <th>Kategori</th>
                            <th>Kategori Klinis</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // use flat fields provided by controller (`nama_kategori`)
                            $groups = $tindakans->groupBy(function($t) {
                                return $t->nama_kategori ?? 'N/A';
                            });
                            $rowNumber = 0;
                        @endphp

                        @foreach($groups as $kategoriName => $list)
                            @php $count = $list->count(); @endphp
                            @foreach($list as $t)
                                @php $rowNumber++; @endphp
                                <tr>
                                    <td>{{ $t->kode }}</td>
                                    <td>{{ $t->deskripsi_tindakan_terapi }}</td>

                                    @if($loop->first)
                                        <td rowspan="{{ $count }}">{{ $kategoriName }}</td>
                                    @endif

                                    <td>{{ $t->nama_kategori_klinis ?? 'N/A' }}</td>
                                    <td class="text-center actions">
                                        <a href="{{ route('admin.datatindakan.edit', $t->id ?? $t->kode) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                        <form action="{{ route('admin.datatindakan.destroy', $t->id ?? $t->kode) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus tindakan ini?')">
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
