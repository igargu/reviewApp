<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
?>

@extends('layouts.app')

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
@section('modalContent')
  <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Do you want to delete <span id="deleteElement">XXX</span>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="button-custome-modal" data-dismiss="modal">Cancel</button>
          &nbsp;&nbsp;&nbsp;
          <form action="" method="post" id="modalDeleteResourceForm">
              @method('delete')
              @csrf
              <input type="submit" class="button-custome-modal" value="Confirm"/>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
  
  @section('content')
    <!-- ======= Contact Section ======= -->
    <section>
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>{{ $review->type }} review</h2>
          <p>{{ $review->title }}</p>
        </div>
      <div class="row">
        
        <div class="col-lg-6">
          <div class="col-lg-12 col-md-6">
            <div class="portfolio-img">
              <img src="{{ asset('storage/images/' . $review->image->name) }}" class="img-fluid" alt="">
            </div>
            <br />
            <p>{{ $review->review }}</p>
          </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
          <div class="member" data-aos="fade-up">
            <div class="member-img">
              <img src="{{ asset('storage/images/' . $review->user->profile_picture) }}" class="img-fluid img-profile-small-custome" alt="">
            </div>
            <br /><br />
            <div class="member-info">
              <a href="{{ url('user/' . $review->user->id) }}"><h4>{{ $review->user->name }}</h4></a>
              <p>{{ $review->user->email }}</p>
              <p><span class="text-custome">Category:</span> {{ $review->category->name }}</p>
              <p><span class="text-custome">Rate:</span> {{ $rates[$review->rate] }}</p>
              @if($review->user->id == Auth::user()->id)
                <div class="button-custome-small-container">
                  <a href=" {{ url('review/' . $review->id . '/edit') }} "><input class="button-custome-small" type="submit" value="Edit review" /></a>
                  &nbsp;&nbsp;&nbsp;
                  <a href="javascript: void(0);" 
                     data-name="{{ $review->title }}"
                     data-url="{{ url('review/' . $review->id) }}"
                     data-toggle="modal"
                     data-target="#modalDelete"><input class="button-custome-small" type="submit" value="Delete review" /></a>
                </div>
              @endif  
            </div>
          </div>
        </div>
        
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

@section('scripts')
    <script src="{{ url('assets/js/common.js') }}"></script>
@endsection