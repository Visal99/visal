@extends('user/layouts.master')

@section('headercss')
    <link rel="stylesheet" href="{{ asset('public/user/css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/main.css') }}">
@endsection

@section('content')
<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
        @yield('pagecontent')
        </div>
    </div>
</div>
@endsection


@section('bottomjs')
<script src="{{ asset ('public/user/js/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset ('public/user/js/lib/tether/tether.min.js') }}"></script>
<script src="{{ asset ('public/user/js/lib/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset ('public/user/js/plugins.js') }}"></script>
<script src="{{ asset ('public/user/js/app.js') }}"></script>

@yield('appbottomjs')

@endsection