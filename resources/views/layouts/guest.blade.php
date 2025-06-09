<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Green Mart') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Custom Styles for Green Mart Theme -->
        <style>
            body {
                background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
                min-height: 100vh;
            }
            
            /* Override Tailwind styles for Green Mart theme */
            .bg-gray-100 {
                background: transparent !important;
            }
            
            /* Logo styling */
            .green-mart-logo {
                width: 80px;
                height: 80px;
                background: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                margin: 0 auto;
            }
            
            .green-mart-logo i {
                font-size: 40px;
                color: #28a745;
            }
            
            /* Card styling */
            .bg-white {
                border-radius: 15px !important;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
            }
            
            /* Form elements */
            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                border-color: #28a745 !important;
                box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1) !important;
            }
            
            /* Primary button */
            button[type="submit"] {
                background-color: #28a745 !important;
                border-color: #28a745 !important;
                transition: all 0.3s;
            }
            
            button[type="submit"]:hover {
                background-color: #1e7e34 !important;
                border-color: #1e7e34 !important;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            }
            
            /* Links */
            a {
                color: #28a745 !important;
                transition: color 0.3s;
            }
            
            a:hover {
                color: #1e7e34 !important;
            }
            
            /* Checkbox */
            input[type="checkbox"]:checked {
                background-color: #28a745 !important;
                border-color: #28a745 !important;
            }
            
            /* Back to home link */
            .back-home-link {
                position: absolute;
                top: 20px;
                left: 20px;
                color: white !important;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 8px;
                text-decoration: none;
                transition: opacity 0.3s;
            }
            
            .back-home-link:hover {
                opacity: 0.8;
                color: white !important;
            }
            
            /* Error messages */
            .text-red-600 {
                color: #dc3545 !important;
            }
            
            /* Success messages */
            .text-green-600 {
                color: #28a745 !important;
            }
            
            /* Add subtle animation */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .bg-white {
                animation: fadeIn 0.5s ease-out;
            }
            
            /* Responsive adjustments */
            @media (max-width: 640px) {
                .green-mart-logo {
                    width: 60px;
                    height: 60px;
                }
                
                .green-mart-logo i {
                    font-size: 30px;
                }
                
                .back-home-link {
                    position: relative;
                    top: auto;
                    left: auto;
                    margin-bottom: 20px;
                    justify-content: center;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Back to Home Link -->
        <a href="/" class="back-home-link">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <div class="green-mart-logo">
                        <i class="fas fa-leaf"></i>
                    </div>
                </a>
                <h2 class="mt-4 text-center text-2xl font-bold text-white">Green Mart</h2>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>