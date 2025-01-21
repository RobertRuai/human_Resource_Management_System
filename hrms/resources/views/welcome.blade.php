<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>@yield('title') SSRA - HRMS Platform</title>
</head>
<body>
    <div class="col-md-12 nav-bar">
        <div class="left-menu">
            <div class="">
                <a href=""><img src="images/favicon.png" alt=""></a>
            </div>
            <div class="">
                <a href="#"><h6>South Sudan Revenue Authority</h6></a>
            </div>
        </div>
        <div class="right-menu">
            <ul>
                <a href="https://nra.gov.ss/"><li id="website-link"><i class="fas fa fa-globe"></i> Visit our Website</li></a>
                <a href="{{ route('login') }}"><li id="login-link">Login</li></a>   
            </ul>
        </div>
    </div>
    <div class="hero">
        <h1>Introducing the HRMS System</h1>
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
                                        Log In
                                    </a>
                                    <!--
                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="btn register"                                        >
                                            Register
                                        </a>
                                    @endif -->
                                @endauth
                            </nav>
                        @endif
    </div>
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="icon mb-3">
                                <i class="fas fa-users fa-2x" style="color: #004080"></i>
                            </div>
                            <h5 class="card-title">Employee Management</h5>
                            <p class="card-text-index">Easily manage employee records, personal details, and more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="icon mb-3">
                                <i class="fas fa-calendar-check fa-2x" style="color: #004080"></i>
                            </div>
                            <h5 class="card-title">Leave Tracking</h5>
                            <p class="card-text-index">Monitor and track employee Leave requests seamlessly.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="icon mb-3">
                                <i class="fas fa-money-check-alt fa-2x" style="color: #004080"></i>
                            </div>
                            <h5 class="card-title">Payroll Management</h5>
                            <p class="card-text-index">Manage payroll, salaries, and employee benefits with ease.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container introduction">
        <div class="">
            <img src="images/bg.jpg" alt="">
        </div>
        <div class="content">
            <h5>About Our HRMS</h5>
            <p>Our HRMS is designed to streamline our HR processes, making it easier to manage our workforce and focus on what matters most.</p>
            <ul>
                <li>Efficiency</li>
                <li>Reliability</li>
                <li>Security</li>
            </ul>
        </div>
    </div>
    <footer>
        <p>&copy; {{ date('Y') }} South Sudan Revenue Authority. All rights reserved.</p>
    </footer>
</body>