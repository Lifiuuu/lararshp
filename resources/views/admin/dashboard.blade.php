@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} - {{ session('user_name') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} {{ session('user_role') }}

                    <div class="row mt-4">
                        @if($role == 1)
                            <h4>Data Master</h4>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.datakategori.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-list"></i> Kategori ({{ count($data['kategoris']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.datakategoriklinis.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-list"></i> Kategori Klinis ({{ count($data['kategoriKliniss']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.jenishewan.index') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-paw"></i> Jenis Hewan ({{ count($data['jenisHewans']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.rashewan.index') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-paw"></i> Ras Hewan ({{ count($data['rasHewans']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.manajemenrole.index') }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-user-tag"></i> Roles ({{ count($data['roles']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.datauser.index') }}" class="btn btn-danger btn-block">
                                    <i class="fas fa-users"></i> Users ({{ count($data['users']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.datapemilik.index') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-users"></i> Pemilik ({{ count($data['pemiliks']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.datapet.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-paw"></i> Pets ({{ count($data['pets']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.datarekammedis.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-file-medical"></i> Rekam Medis ({{ count($data['rekamMediss']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('admin.datatindakan.index') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-procedures"></i> Tindakan ({{ count($data['tindakans']) }})
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
