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

<main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>Edit profile</h2>
          <p>give yourself a new look {{ $user->name }}</p>
        </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    Error al editar
                </div>
                @error('store')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            @endif
            
            <form action="{{ url('user/' . $user->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('put')
              
              <input class="form-control" type="text" name="id" id="id" value="{{ $user->id }}" hidden>
              
              <div class="row">
                <div class="form-group mt-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name', $user->name) }}" required>
                  @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group mt-3">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email', $user->email) }}" required>
                  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              
              <div class="row">
                <div class="form-group mt-3">
                  <div class="portfolio-img">
                    <img src="{{ asset('storage/images/' . $user->profile_picture) }}" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
              
              <br />
              <div data-bs-toggle="collapse" class="collapsed question" href="#faq2">Change profile picture<i class="bi bi-chevron-down icon-show"></i></div>
              <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <div class="row">
                  <input type="file" name="file" id="file" class="form-control">
                  @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              </div>
              
              <br />
              <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Change password<i class="bi bi-chevron-down icon-show"></i></div>
              <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                <div class="row">
                    <div class="form-group mt-3">
                        <label for="password">New password</label>
                        <input type="password" minlength="8" class="form-control" id="password" name="password" placeholder="New password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
              
              <div class="row">
                    <div class="form-group mt-3">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password_confirmation" minlength="8" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
              </div>
              
              <br />
              <div class="text-center">
                <a href=" {{ url('user/' . $user->id) }} "><input class="button-custome-modal" type="button" value="Cancel" /></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="button-custome-modal" type="submit">Confirm</button>
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
