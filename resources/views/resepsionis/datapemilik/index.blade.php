@extends('layouts.lte.main')

@section('content')
    <h1>Daftar Pemilik</h1>
    <p><a href="{{ route('resepsionis.datapemilik.create') }}" class="btn btn-primary">Tambah Pemilik</a></p>
    <ul>
        @foreach($pemiliks as $p)
            <li>#{{ $p->idpemilik }} - {{ $p->user_nama ?? '—' }} — {{ $p->no_wa }} — <a href="{{ route('resepsionis.datapemilik.edit', $p->idpemilik) }}">Edit</a></li>
        @endforeach
    </ul>
@endsection
