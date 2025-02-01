@extends('auth.template')
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email -->
    @section('content')
    <div>
        <div class="mb-3">
            <input type="email" class="form-control form-control-lg" placeholder="email" aria-label="email" name="email" id="email" required>
        </div>

        @error('email')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mt-4">
        <div class="mb-3">
            <input type="password" class="form-control form-control-lg" placeholder="password" aria-label="password" name="password" id="password" required>
        </div>

        @error('password')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
        </div>
</form>
@endsection