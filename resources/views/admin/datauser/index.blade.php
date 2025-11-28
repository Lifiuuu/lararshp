@extends('layouts.lte.main')

@section('page-title', 'Data User')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.datauser.create') }}" class="btn btn-primary">Tambah Data User</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $rowNumber = 0; @endphp
                        @forelse($users as $user)
                            @php $rowNumber++; @endphp
                            <tr>
                                <td>{{ $rowNumber }}</td>
                                <td>{{ $user->nama ?? $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        $rolesArr = [];
                                        if (isset($user->roles)) {
                                            if (is_array($user->roles) || $user->roles instanceof \Illuminate\Support\Collection) {
                                                $rolesArr = $user->roles;
                                            }
                                        }
                                    @endphp
                                    @if(!empty($rolesArr))
                                        @foreach($rolesArr as $role)
                                            <span class="badge bg-info text-dark">{{ is_object($role) ? ($role->nama_role ?? '-') : (is_array($role) ? ($role['nama_role'] ?? '-') : '-') }}</span>@if(!$loop->last), @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.datauser.edit', $user->iduser ?? $user->id) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                        <form action="{{ route('admin.datauser.destroy', $user->iduser ?? $user->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-admin sm">Hapus</button>
                                        </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- pagination (if applicable) --}}
    @if(method_exists($users, 'links'))
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    @endif

</section>
@endsection
