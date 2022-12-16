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
    
    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">
        
        <div class="profile-header-custome">
          <div class="img-profile-custome">
            <img src="{{ asset('storage/images/' . $user->profile_picture) }}" class="img-fluid" alt="">
          </div>
          <div class="img-profile-info-custome">
            <h4 class="text-custome">{{ $user->name }}</h4>
            <br />
            <h6>{{ $user->email }}</h6>
            <br />
            @if($user->id == Auth::user()->id)
                <a href=" {{ url('user/' . $user->id . '/edit') }} "><input class="button-custome-modal" type="submit" value="Edit profile" /></a>
            @endif
          </div>
        </div>
        
        <br /><br /><br />

        <ul class="nav nav-tabs row d-flex">
          <li class="nav-item col-4" data-aos="zoom-in">
            <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
              <i class="ri-book-2-fill"></i>
              <h4 class="d-none d-lg-block">Book Reviews</h4>
            </a>
          </li>
          <li class="nav-item col-4" data-aos="zoom-in" data-aos-delay="100">
            <a class="nav-link" data-bs-toggle="tab" href="#tab-2">
              <i class="ri-music-2-fill"></i>
              <h4 class="d-none d-lg-block">Disc Reviews</h4>
            </a>
          </li>
          <li class="nav-item col-4" data-aos="zoom-in" data-aos-delay="200">
            <a class="nav-link" data-bs-toggle="tab" href="#tab-3">
              <i class="ri-movie-2-fill"></i>
              <h4 class="d-none d-lg-block">Movie Reviews</h4>
            </a>
          </li>
        </ul>
        
        <br /><br /><br />
        
        <!-- foreach review tab-index -->
        <div class="tab-content" data-aos="fade-up">
          
          <div class="tab-pane active show" id="tab-1">
            <div class="row">
              <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0">
                @foreach($reviews as $review)
                  @if($review->type == 'book')
                  @if($review->user == $user)
                  <div class="row content" data-aos="fade-up">
                    <div class="col-lg-6">
                      <img src="{{ asset('storage/images/' . $review->image->name) }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6">
                      <h4 class="title"><a href="{{ url('review/' . $review->id) }}">{{ $review->title }}</a></h4>
                      <h6><span class="text-custome">Author:</span> {{ $review->user->name }}</h6>
                      <h6><span class="text-custome">Category:</span> {{ $review->category->name }}</h6>
                      <p class="description">{{ substr($review->review, 0, 500) }}[...]</p>
                      <h5><span class="text-custome">Rate:</span> {{ $rates[$review->rate] }}</h5>
                    </div>
                  </div>
                  <br /><br /><br />
                  @endif
                  @endif
                @endforeach
              </div>
            </div>
          </div>
          
          <div class="tab-pane" id="tab-2">
            <div class="row">
              <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0">
                @foreach($reviews as $review)
                  @if($review->type == 'disc')
                  @if($review->user == $user)
                    <div class="row content" data-aos="fade-up">
                      <div class="col-lg-6">
                        <img src="{{ asset('storage/images/' . $review->image->name) }}" class="img-fluid" alt="">
                      </div>
                      <div class="col-lg-6">
                        <h4 class="title"><a href="{{ url('review/' . $review->id) }}">{{ $review->title }}</a></h4>
                        <h6><span class="text-custome">Author:</span> {{ $review->user->name }}</h6>
                        <h6><span class="text-custome">Category:</span> {{ $review->category->name }}</h6>
                        <p class="description">{{ substr($review->review, 0, 500) }}[...]</p>
                        <h5><span class="text-custome">Rate:</span> {{ $rates[$review->rate] }}</h5>
                      </div>
                    </div>
                    <br /><br /><br />
                    @endif
                    @endif
                @endforeach
              </div>
            </div>
          </div>
          
          <div class="tab-pane" id="tab-3">
            <div class="row">
              <div class="col-lg-12 order-2 order-lg-1 mt-3 mt-lg-0">
                @foreach($reviews as $review)
                  @if($review->type == 'movie')
                  @if($review->user == $user)
                    <div class="row content" data-aos="fade-up">
                      <div class="col-lg-6">
                        <img src="{{ asset('storage/images/' . $review->image->name) }}" class="img-fluid" alt="">
                      </div>
                      <div class="col-lg-6">
                        <h4 class="title"><a href="{{ url('review/' . $review->id) }}">{{ $review->title }}</a></h4>
                        <h6><span class="text-custome">Author:</span> {{ $review->user->name }}</h6>
                        <h6><span class="text-custome">Category:</span> {{ $review->category->name }}</h6>
                        <p class="description">{{ substr($review->review, 0, 500) }}[...]</p>
                        <h5><span class="text-custome">Rate:</span> {{ $rates[$review->rate] }}</h5>
                      </div>
                    </div>
                    <br /><br /><br />
                  @endif
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- End Features Section -->
    
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
