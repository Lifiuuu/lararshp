@extends('layouts.lte.main')

@section('content')
    <h1>Daftar Pet</h1>
    <p><a href="{{ route('resepsionis.datapet.create') }}">Tambah Pet</a></p>
    <ul>
        @foreach($pets as $pet)
            <li>#{{ $pet->idpet }} - {{ $pet->nama }} — {{ $pet->nama_pemilik ?? '—' }} — <a href="{{ route('resepsionis.datapet.edit', $pet->idpet) }}">Edit</a></li>
        @endforeach
    </ul>
@endsection
