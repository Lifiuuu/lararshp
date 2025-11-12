@extends('layouts.admin.admin')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Ras Hewan</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.rashewan.create') }}" class="btn-admin primary" style="text-align:left">Tambah Ras Hewan</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama Ras</th>
                <th class="py-2 px-4 border-b">Jenis Hewan</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Group ras by jenis hewan name; provide fallback label when missing
                $groups = $rasHewans->groupBy(function($r) {
                    return $r->jenisHewan->nama_jenis_hewan ?? 'N/A';
                });
                $rowNumber = 0;
            @endphp

            @foreach($groups as $jenisName => $rasList)
                @php $count = $rasList->count(); @endphp
                @foreach($rasList as $ras)
                    @php $rowNumber++; @endphp
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $rowNumber }}</td>
                        <td class="py-2 px-4 border-b">{{ $ras->nama_ras }}</td>

                        @if($loop->first)
                            <td class="py-2 px-4 border-b" rowspan="{{ $count }}">{{ $jenisName }}</td>
                        @endif

                        <td class="actions">
                            <a href="{{ route('admin.rashewan.edit', $ras->idras_hewan ?? $ras->idras ?? $ras->id) }}" class="btn-admin ghost">Edit</a>
                            <form action="{{ route('admin.rashewan.destroy', $ras->idras_hewan ?? $ras->idras ?? $ras->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus ras hewan ini?')">
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
