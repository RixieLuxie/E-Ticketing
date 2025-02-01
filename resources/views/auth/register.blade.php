@extends('auth.regis')

@section('content')
<x-notif />
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Name" aria-label="name" name="name" id="name" required>
    </div>



    <!-- Email Address -->
    <div class="mb-3">
        <input type="email" class="form-control" placeholder="Email" aria-label="email" name="email" id="email" required>
    </div>
    

    {{-- Phone Number --}}
    <div class="mb-3">
        <input type="number" class="form-control" placeholder="Phone Number" aria-label="phonenumber" name="phonenumber" id="phonenumber" required>
    </div>


    {{-- Gender --}}
    <div class="mb-3">
        <select name="gender" id="gender" class="form-select">
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>


    <!-- Password -->
    <div class="mb-3">
        <input type="password" class="form-control" placeholder="Password" aria-label="password" name="password" id="password" required>
    </div>


    <!-- Confirm Password -->
    <div class="mb-3">
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation" aria-label="password_confirmation" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
    </div>
    <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
</form>
@endsection