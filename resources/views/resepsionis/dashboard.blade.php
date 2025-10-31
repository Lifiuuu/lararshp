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
                        @if($role == 4)
                            <h4>Data Pendaftaran</h4>
                            <div class="col-md-4 mb-2">
                                <a href="{{ route('resepsionis.datapemilik.index') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-users"></i> Pemilik ({{ count($data['pemiliks']) }})
                                </a>
                            </div>
                            <div class="col-md-4 mb-2">
                                <a href="{{ route('resepsionis.datapet.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-paw"></i> Pets ({{ count($data['pets']) }})
                                </a>
                            </div>
                            <div class="col-md-4 mb-2">
                                <a href="{{route('resepsionis.temudokter.index')}}" class="btn btn-info btn-block">
                                    <i class="fas fa-calendar-check"></i> Temu Dokter ({{ count($data['temudokters']) }})
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
