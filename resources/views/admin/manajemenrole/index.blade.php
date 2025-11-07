@extends('layouts.admin.admin')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Manajemen Role</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.manajemenrole.create') }}" class="btn-admin primary" style="text-align:left">Tambah Role</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $index => $role)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $role->nama_role }}</td>
                <td class="actions">
                    <a href="{{ route('admin.manajemenrole.edit', $role->id ?? $role->idrole) }}" class="btn-admin ghost">Edit</a>
                    <form action="{{ route('admin.manajemenrole.destroy', $role->id ?? $role->idrole) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus role ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-admin warn">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</section>
@endsection
