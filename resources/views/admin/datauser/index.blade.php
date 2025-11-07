@extends('layouts.admin.admin')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data User</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.datauser.create') }}" class="btn-admin primary" style="text-align:left">Tambah Data User</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->nama ?? $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('idrole')->join(', ') }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.datauser.edit', $user->iduser ?? $user->id) }}" class="btn-admin ghost">Edit</a>
                            <form action="{{ route('admin.datauser.destroy', $user->iduser ?? $user->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-admin warn">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- pagination (if applicable) --}}
    @if(method_exists($users, 'links'))
        <div class="admin-pagination">
            {{ $users->links() }}
        </div>
    @endif

</section>
@endsection
