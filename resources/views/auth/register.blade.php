@extends('layouts.app')

@section('content')
<main id="main">
    <section id="login" class="login">
        <div class="container">
        
            <div class="section-title" data-aos="zoom-out">
                <h2>reviewApp</h2>
                <p>MyReviews</p>
            </div>
            
            <div class="row mt-5">
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="info">
                        <img src="assets/img/features-4.png" alt="" class="img-fluid">
                    </div>
                </div>
                
                <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">
                    <div class="testimonial-item">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="button-custome">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <br />
                        <div class="row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <p>You have an account? <a href="{{ route('login') }}">Sign in</a></p>
                            </div>
                        </div>
                    </form>
                </div>        
                </div>
            </div>
            <br /><br />
        </div>
    </section>
</main>
@endsection
