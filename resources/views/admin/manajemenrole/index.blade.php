@extends('layouts.lte.main')

@section('page-title', 'Manajemen Role')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.manajemenrole.create') }}" class="btn btn-primary">Tambah Role</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $index => $role)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $role->nama_role }}</td>
                            <td class="text-center actions">
                                <a href="{{ route('admin.manajemenrole.edit', $role->id ?? $role->idrole) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                <form action="{{ route('admin.manajemenrole.destroy', $role->id ?? $role->idrole) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus role ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-admin sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
