<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}>

<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Leave Management System</title>
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Your App</title>
<script src="https://cdn.tailwindcss.com"></script> <!-- Add this line -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Add this line -->
<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="container mt-4">
        <header class="mb-4">
            <nav class="bg-gray-800 p-4">
                <div class="max-w-7xl mx-auto flex justify-between items-center">
                    <!-- Logo or Branding (optional) -->
                    <div>
                        <a href="{{ route('leaveRequests.index') }}" class="text-white font-semibold text-xl">Leave
                            Management System</a>
                    </div>

                    <!-- Navigation links -->
                    <ul class="flex space-x-6">
                        @if (Auth::check())
                            <!-- Display for authenticated users -->
                            <li><a href="{{ route('leaveRequests.index') }}"
                                    class="text-white hover:text-blue-300">Home</a></li>
                            @if (Auth::user()->role !== 'admin')
                                <li><a href="{{ route('leaveRequests.create') }}"
                                        class="text-white hover:text-blue-300">Request Leave</a></li>
                            @endif

                            <!-- Show user name and Logout -->
                            <li class="text-white">Hello, {{ Auth::user()->name }}</li>
                            <li>
                                <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-white hover:text-red-500">Logout</button>
                                </form>
                            </li>
                        @else
                            <!-- Display for unauthenticated users -->
                            <li><a href="{{ route('auth.login') }}" class="text-white hover:text-blue-300">Login</a>
                            </li>
                            <li><a href="{{ route('auth.register') }}"
                                    class="text-white hover:text-blue-300">Register</a></li>
                        @endif
                    </ul>
                </div>
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
