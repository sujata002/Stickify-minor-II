<!DOCTYPE html>
<html>
<head>
    <title>Token Generation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Generate Access Token</h2>

        <!-- Token Generation Form -->
        <form action="{{ route('generate.token') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Generate Token</button>
        </form>

        <!-- Show error message if exists -->
        @if(session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Show the Generated Token -->
        @if(session('token'))
            <div class="alert alert-success mt-4">
                <strong>Token Generated:</strong>
                <input type="text" class="form-control mt-2" value="{{ session('token') }}" readonly onclick="this.select();document.execCommand('copy');">
                <small class="text-muted">Click the box to copy the token.</small>
            </div>
        @endif
    </div>
</body>
</html>
