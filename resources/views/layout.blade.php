<!DOCTYPE html>
<html>
<head>
    <title>JobPilot Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">JOBPILOT</a>
            <div class="ms-auto">
                @auth
                    <span class="text-white me-3">Xin chào, {{ Auth::user()->name }}</span>
                    <a href="{{ route('employer.jobs.index') }}" class="btn btn-sm btn-light text-primary fw-bold">Quản lý Tin</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf <button class="btn btn-sm btn-danger ms-2">Thoát</button>
                    </form>
                @else
                    <a href="{{ route('login.hr') }}" class="btn btn-warning fw-bold">Đăng nhập (Demo HR)</a>
                @endauth
            </div>
        </div>
    </nav>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
