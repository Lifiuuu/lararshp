@extends('layouts.lte.main')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data Tindakan</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.datatindakan.create') }}" class="btn-admin primary" style="text-align:left">Tambah Data Tindakan</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Kode</th>
                <th class="py-2 px-4 border-b">Deskripsi Tindakan Terapi</th>
                <th class="py-2 px-4 border-b">Kategori</th>
                <th class="py-2 px-4 border-b">Kategori Klinis</th>
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
                        <td class="py-2 px-4 border-b text-center">{{ $rowNumber }}</td>
                        <td class="py-2 px-4 border-b">{{ $t->kode }}</td>
                        <td class="py-2 px-4 border-b">{{ $t->deskripsi_tindakan_terapi }}</td>

                        @if($loop->first)
                            <td class="py-2 px-4 border-b" rowspan="{{ $count }}">{{ $kategoriName }}</td>
                        @endif

                        <td class="py-2 px-4 border-b">{{ $t->nama_kategori_klinis ?? 'N/A' }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.datatindakan.edit', $t->id ?? $t->kode) }}" class="btn-admin ghost">Edit</a>
                            <form action="{{ route('admin.datatindakan.destroy', $t->id ?? $t->kode) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus tindakan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-admin warn">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        </table>
    </div>
</section>
@endsection
