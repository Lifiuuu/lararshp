@extends('layouts.admin.admin')

@section('content')
    <div class="admin-cards">
        <div class="admin-card">
            <h4>{{ __('Dashboard') }} - {{ optional(auth()->user())->nama_user ?? auth()->user()->name ?? session('user_name') ?? 'Guest' }}</h4>
            @if (session('status'))
                <div class="badge success" style="margin-bottom:10px; display:inline-block">{{ session('status') }}</div>
            @endif
            <p class="muted">{{ __('You are logged in!') }}</p>
        </div>
@endsection
