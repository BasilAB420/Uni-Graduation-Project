<!-- Topbar Start -->
<div class="container-fluid bg-light text-dark-50 py-2 px-0 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fa fa-phone-alt me-2"></small>
                <small>+962 778093262</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="far fa-envelope-open me-2"></small>
                <small>basil.ab@icloud.com</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center">
                <a class="text-dark-50 ms-4" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="text-dark-50 ms-4" href=""><i class="fab fa-twitter"></i></a>
                <a class="text-dark-50 ms-4" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="text-dark-50 ms-4" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top px-4 px-lg-5">
    <a href="index.html" class="navbar-brand d-flex align-items-center">
        <h3 class="m-0">
            <a href="/"> <img class="img-fluid" src="{{ asset('img/Lion.png') }}" alt="logo" />UniHub</a>
        </h3>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto bg-light rounded pe-4 py-3 py-lg-0">
            <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="#about" class="nav-item nav-link {{ request()->is('#about') ? 'active' : '' }}">About Us</a>
            <a href="/allgoods" class="nav-item nav-link {{ request()->is('allgoods') ? 'active' : '' }}">All
                Goods</a>
            <a href="#contact" class="nav-item nav-link {{ request()->is('#contact') ? 'active' : '' }}">Contact
                Us</a>
            @if (Route::has('login'))
                <div class="d-lg-flex sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary px-3 mx-3 d-lg-block m-1">Dashboard</a>
                        <a class="btn btn-light px-3 mx-1 d-lg-block m-1" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary px-3 mx-3 d-lg-block m-1">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-light px-3 mx-1 d-lg-block m-1">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </div>


</nav>
<!-- Navbar End -->
