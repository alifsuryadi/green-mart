<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Green Mart</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }
        
        .register-container {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
        }
        
        .register-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        
        .register-header {
            background-color: #28a745;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
        
        .btn-register {
            background-color: #28a745;
            border: none;
            padding: 12px;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .btn-register:hover {
            background-color: #1e7e34;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .password-strength {
            height: 5px;
            margin-top: 5px;
            border-radius: 3px;
            transition: all 0.3s;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="card register-card">
                <div class="register-header">
                    <i class="fas fa-leaf fa-3x mb-3"></i>
                    <h3 class="mb-0">Create Account</h3>
                    <p class="mb-0 mt-2">Join Green Mart today</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-1"></i> Full Name
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-1"></i> Email Address
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-1"></i> Password
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            <div class="password-strength" id="passwordStrength"></div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock me-1"></i> Confirm Password
                            </label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <!-- Terms -->
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#" class="text-success">Terms and Conditions</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success btn-register w-100">
                            <i class="fas fa-user-plus me-2"></i> Create Account
                        </button>

                        <hr class="my-4">
                        
                        <div class="text-center">
                            <p class="mb-0">Already have an account?</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-success mt-2">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-white text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strength = document.getElementById('passwordStrength');
            
            if (password.length < 6) {
                strength.style.width = '33%';
                strength.style.backgroundColor = '#dc3545';
            } else if (password.length < 10) {
                strength.style.width = '66%';
                strength.style.backgroundColor = '#ffc107';
            } else {
                strength.style.width = '100%';
                strength.style.backgroundColor = '#28a745';
            }
        });
    </script>
</body>
</html>