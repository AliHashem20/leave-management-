@extends('layouts.app')


@section('content')
    <form action="{{ route('auth.register') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
        @csrf

        <h2 class="mb-4">Register for an Account</h2>

        <!-- Name Field -->
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required class="form-control">

        <!-- Email Field -->
        <label for="email" class="mt-3">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="form-control">

        <!-- Password Field -->
        <label for="password" class="mt-3">Password:</label>
        <input type="password" name="password" required class="form-control">

        <!-- Password Confirmation Field -->
        <label for="password_confirmation" class="mt-3">Confirm Password:</label>
        <input type="password" name="password_confirmation" required class="form-control">

        <!-- Department Field -->
        <label for="department_id" class="mt-3">Department:</label>
        <select name="department_id" id="department_id" class="form-control" required>
            <option value="" disabled selected>Select Department</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ $department->id == old('department_id') ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-4">Register</button>

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
@endsection
