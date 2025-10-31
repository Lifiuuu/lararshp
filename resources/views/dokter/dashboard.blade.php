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
                        @if($role == 2)
                            <h4>Data Rekam Medis & Tindakan</h4>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('dokter.datarekammedis.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-file-medical"></i> Rekam Medis ({{ count($data['rekamMediss']) }})
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('dokter.datatindakan.index') }}" class="btn btn-info btn-block">
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
