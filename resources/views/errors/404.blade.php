<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Not Found - Green Mart</title>
    <link rel="icon" href="{{ asset('/favicomatic/favicon.ico') }}" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .error-container {
            text-align: center;
            max-width: 500px;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #28a745;
            line-height: 1;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h2 class="mb-3">Oops! Page Not Found</h2>
        <p class="text-muted mb-4">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        
        <div class="d-flex gap-2 justify-content-center">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-success">
                    <i class="fas fa-home me-2"></i> Go to Dashboard
                </a>
            @else
                <a href="{{ url('/') }}" class="btn btn-success">
                    <i class="fas fa-home me-2"></i> Go to Home
                </a>
            @endauth
            <button onclick="history.back()" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Go Back
            </button>
        </div>
    </div>
</body>
</html>