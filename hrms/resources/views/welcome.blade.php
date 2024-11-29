<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .hero {
            background: linear-gradient(to right, #004080, #007bff);
            color: #fff;
            padding: 100px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .hero .btn {
            background-color: #fff;
            color: #007bff;
            transition: background-color 0.3s, color 0.3s;
        }
        .hero .btn:hover {
            background-color: #007bff;
            color: #fff;
        }
        .features {
            display: flex;
            justify-content: space-around;
            padding: 50px 0;
        }
        .feature {
            text-align: center;
            padding: 20px;
        }
        .feature h3 {
            margin-bottom: 15px;
        }
        .feature p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>Welcome to the HRMS System</h1>
        <p>Streamline your HR processes with our advanced management system.</p>
        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="btn"                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="btn"                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="btn"                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
    </div>
    <div class="container">
        <div class="features">
            <div class="feature">
                <h3>Efficiency</h3>
                <p>Automate routine tasks and focus on what matters.</p>
            </div>
            <div class="feature">
                <h3>Security</h3>
                <p>Keep your data safe with our top-notch security features.</p>
            </div>
            <div class="feature">
                <h3>Support</h3>
                <p>24/7 support to assist you with any issues.</p>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; {{ date('Y') }} South Sudan Revenue Authority. All rights reserved.</p>
    </footer>
</body>