@php
    $configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Not Authorized')

@section('page-style')
    <link rel="stylesheet" href="{{asset(mix('css/base/pages/page-misc.css'))}}">
@endsection

@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        <a class="brand-logo" href="#">
            <h2 class="brand-text text-primary ms-1">Huffman Mail</h2>
        </a>
        <div class="misc-inner p-2 p-sm-3">
            <div class="w-100 text-center">
                <h2 class="mb-1">You are not authorized!</h2>
                <p class="mb-2">You're registered, but currently you we can't provide your mail hosting.</p>

                <a class="btn btn-primary mb-1 btn-sm-block" href="{{route('logout')}}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logged out</a>
                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                </form>

                @if($configData['theme'] === 'dark')
                    <img class="img-fluid" src="{{asset('images/pages/not-authorized-dark.svg')}}" alt="Not authorized page" />
                @else
                    <img class="img-fluid" src="{{asset('images/pages/not-authorized.svg')}}" alt="Not authorized page" />
                @endif
            </div>
        </div>
    </div>
    <!-- / Not authorized-->
    </section>
    <!-- maintenance end -->
@endsection
