<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
?>

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
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>edit {{ $review->type }} Review</h2>
          <p>{{ $review->title }}</p>
        </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    El post no se ha podido publicar, por favor corrige los errores.
                </div>
                @error('store')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            @endif
            
            <form action="{{ url('review/' . $review->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('put')
              <input class="form-control" type="text" name="iduser" id="iduser" value="{{ $review->user->id }}" hidden>
              <input class="form-control" type="text" name="idimage" id="idimage" value="{{ $review->idimage }}" hidden>
              
              <div class="row">
                <div class="form-group mt-3">
                  <select name="type" id="type" class="form-select" required>
                    @foreach($types as $index => $type)
                      <option value="{{ strtolower($type) }}" <?php if($review->type == strtolower($type)){ echo 'selected'; } ?>>{{ $type }}</option>
                    @endforeach()
                  </select>
                  @error('type')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group mt-3">
                  <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title', $review->title) }}" required>
                  @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group mt-3">
                  <select name="idcategory" id="idcategory" class="form-select" aria-label="Default select example" required>
                    <?php 
                      $categories = DB::select('select * from category order by name');
                    ?>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}" <?php if($review->category->name == $category->name){ echo 'selected'; } ?>>{{ $category->name }}</option>
                    @endforeach()
                  </select>
                  @error('idcategory')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group mt-3">
                  <textarea class="form-control" name="review" id= "review" rows="5" placeholder="Review" required>{{ old('review', $review->review) }}</textarea>
                  @error('review')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group mt-3">
                  <select name="rate" id="rate" class="form-select" aria-label="Default select example" required>
                    @foreach($rates as $index => $rate)
                      <option value="{{ $index }}" <?php if($review->rate == $index){ echo 'selected'; } ?>>{{ $rate }}</option>
                    @endforeach()
                  </select>
                  @error('rate')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group mt-3">
                  <div class="portfolio-img">
                    <img src="{{ asset('storage/images/' . $review->image->name) }}" class="img-fluid" alt="">
                  </div>
                  <br /><br />
                  <input type="file" name="file" id="file" class="form-control">
                  @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <br />
              <div class="text-center">
                <a href=" {{ url('review/' . $review->id) }} "><input class="button-custome-modal" type="button" value="Cancel" /></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="button-custome-modal">Confirm</button>
              </div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
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
