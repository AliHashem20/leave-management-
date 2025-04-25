<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}>

<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Leave Management System</title>
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="container mt-4">
        <header class="mb-4">
            <h1>Leave Management System</h1>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ route('leaveRequests.index') }}">Home</a>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('leaveRequests.create') }}">Request
                            Leave</a></li>
                </ul>
            </nav>
        </header>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        <!-- Content -->
        <main>
            @yield('content')
        </main>

        <footer class="mt-5 text-center">
            <p>&copy; {{ date('Y') }} Leave Management System</p>
        </footer>
    </div>
</body>

</html>
