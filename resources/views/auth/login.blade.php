@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('auth.login') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
            @csrf

            <h2 class="mb-4">Log In to Your Account</h2>

            <!-- Email Field -->
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <!-- Password Field -->
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-3">Log In</button>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection
