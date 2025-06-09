{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Not Found - Green Mart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-container {
            text-align: center;
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .error-icon {
            font-size: 80px;
            color: #28a745;
        }

        .error-message {
            font-size: 24px;
            color: #333;
        }

        .error-description {
            font-size: 16px;
            color: #555;
        }

        .btn-custom {
            padding: 12px 24px;
            font-size: 14px;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .btn-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1 class="error-message">Oops! Page Not Found</h1>
        <p class="error-description">Sorry, the page you are looking for doesn't exist or has been moved.</p>
        <a href="{{ url('/') }}" class="btn btn-success btn-custom">
            <i class="fas fa-arrow-left me-2"></i> Back to Home
        </a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
