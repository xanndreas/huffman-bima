@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Register')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="#">
                <h2 class="brand-text text-primary ms-1">Huffman Mail</h2>
            </a>
            <!-- /Brand logo-->

            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                    @if($configData['theme'] === 'dark')
                        <img class="img-fluid" src="{{asset('images/pages/register-v2-dark.svg')}}" alt="Register V2"/>
                    @else
                        <img class="img-fluid" src="{{asset('images/pages/register-v2.svg')}}" alt="Register V2"/>
                    @endif
                </div>
            </div>
            <!-- /Left Text-->

            <!-- Register-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Adventure starts here </h2>
                    <p class="card-text mb-2">Make your mail app easy and fun!</p>
                    <form class="auth-register-form mt-2" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="name">Full Name</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" type="text" name="name" placeholder="johndoe"
                                   aria-describedby="name" autofocus="" tabindex="1"  value="{{ old('name') }}" required/>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="email">Email</label>

                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" type="text" name="email"
                                   placeholder="john@huffman.mythesis.website"
                                   aria-describedby="email" tabindex="2"  value="{{ old('email') }}" required />

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} form-control-merge" id="password"
                                       type="password" name="password" required
                                       placeholder="············" aria-describedby="password" tabindex="3" value="{{ old('password') }}" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" id="register-privacy-policy" type="checkbox" tabindex="4"/>
                                <label class="form-check-label" for="register-privacy-policy">I agree to<a href="#">&nbsp;privacy policy &
                                        terms</a></label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="5">Sign up</button>
                    </form>
                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        <a href="{{route('login')}}"><span>&nbsp;Sign in instead</span></a>
                    </p>
                </div>
            </div>
            <!-- /Register-->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
@endsection
