@extends('layouts.app')
@section('content')

<!-- ======= Header ======= -->
      <header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
        <div class="container d-flex align-items-center justify-content-between">
    
          <div class="logo">
            <h1><a href="index.html">MyReviews</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          </div>
    
          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="{{ url('home') }}">Home</a></li>
              <li><a class="nav-link scrollto" href="{{ url('user/' . Auth::user()->id) }}">Profile</a></li>
              @if (Auth::user()->isAdmin())
                <li><a class="nav-link scrollto" href="{{ url('admin') }}">Admin Zone</a></li>
              @endif
              <form action="{{ url('logout') }}" method="post">
                  @csrf
                  <input class="button-custome-nav" type="submit" value="Logout"/>
              </form>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
    
        </div>
      </header><!-- End Header -->
      
      <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
  <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="carousel-container">
        <h2 class="animate__animated animate__fadeInDown">Welcome to MyReviews</h2>
        <p class="animate__animated animate__fadeInDown hero-subtitle-custome">Where people think they know more than others</p>
      </div>
    </div>

   

  </div>

  <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
    <defs>
      <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
    </defs>
    <g class="wave1">
      <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
    </g>
    <g class="wave2">
      <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
    </g>
    <g class="wave3">
      <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
    </g>
  </svg>

</section><!-- End Hero -->

<main id="main">
    <section id="features" class="features">
        <div class="container">
            <div class="row" style="margin-top: 8px;">
                <form action="{{ url('admin/' . $user->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">User name</label>
                        <input value="{{ old('name', $user->name) }}" required type="text" minlength="2" maxlength="100" class="form-control" id="nombre" name="name" placeholder="User name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="email">User email</label>
                        <input value="{{ old('email', $user->email) }}" required type="text" minlength="2" maxlength="100" class="form-control" id="email" name="email" placeholder="User email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="password">User password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="User password" >
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-select" name="type" id="type" required>
                            @foreach ($types as $index => $type)
                              <option value="{{ $index }}" @if($user->type == $index) selected @endif> {{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <div class="text-center">
                    <a href=" {{ url('admin') }} "><input class="button-custome-modal" type="button" value="Cancel" /></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="button-custome-modal">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<!-- ======= Footer ======= -->
      <footer id="footer">
        <div class="container">
          <h3>MyReviews</h3>
          <p>Where you think your opinion matters to someone</p>
        </div>
      </footer><!-- End Footer -->
    
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


@endsection
