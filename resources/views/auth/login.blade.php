@extends('layouts.app')

@section('title', 'Login - RSHP Universitas Airlangga')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-200px)] bg-gray-50 px-4 py-12">
    <div class="w-full max-w-md">
        
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <div class="text-center mb-8">
                <img src="{{ asset('images/unair-logo.png') }}" alt="Logo UNAIR" class="h-16 mx-auto mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h1>
                <p class="text-gray-500">Silakan login ke akun Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <input id="email" type="email"
                           class="form-input w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="text-red-600 text-sm mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-baseline">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password"
                           class="form-input w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                           name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="text-red-600 text-sm mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="flex items-center mb-6">
                    <input class="form-checkbox h-4 w-4 text-blue-600 rounded focus:ring-blue-500" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm text-gray-900" for="remember">
                        Ingat Saya
                    </label>
                </div>

                <div>
                    <button type="submit"
                            class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                        Login
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:underline">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection