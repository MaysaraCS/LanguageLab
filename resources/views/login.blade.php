@extends('layout')
@section('title', 'login')
@section('content')
<div class="login-signup-form animated fadeInDown">
    <div class="mt-5">
        @if ($errors->any()) 
            <div class="col-12">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
    </div>
<div class="form">
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <h1 class="title">Login into your account</h1>
        <input type="text" placeholder="Name" name="name">
        <input type="password" placeholder="password" name="password">
        <button type="submit" class="btn btn-block">Submit</button>
        <p class="message">Forgot your passowrd? <a href="{{ route('resetPassword') }}">Recover now</a></p>
        <p class="message">Haven't registerd yet? <a href="{{ route('register') }}">Register now</a></p>
      </form>
</div>
</div>
@endsection