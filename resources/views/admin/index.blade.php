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
          <h5 class="modal-title">Delete user</h5>
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
<section id="features" class="features">
    <div class="container">
        <div class="row" style="margin-top: 8px;">
            <table class="table table-striped" id="userTable">
                <thead>
                    <tr>
                        <th scope="col">NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">TYPE</th>
                        <th scope="col">DELETE</th>
                        <th scope="col">EDIT</th>
                        <th scope="col">SHOW</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->type }}
                        </td>
                        <td>
                            @if($user->email != Auth::user()->email)
                                <a href="javascript: void(0);" 
                                   data-name="{{ $user->name }}"
                                   data-url="{{ url('admin/' . $user->id) }}"
                                   data-toggle="modal"
                                   data-target="#modalDelete">delete</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/' . $user->id . '/edit') }}">edit</a>
                        </td>
                        <td>
                            <a href="{{ url('user/' . $user->id) }}">show</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('admin/create') }}" class="btn btn-primary btn-custome">Create user</a>
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