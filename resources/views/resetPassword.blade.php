@extends('layout')
@section('title', 'Password Reset')
@section('content')
<div class="login-signup-form animated fadeInDown">
    <div class="form">
        <form>
            @csrf
            <h1 class="title">Password reset</h1>
            <input type="email" placeholder="email" name="email">
            <button type="submit" class="btn btn-block">Send recovery email</button>
        </form>
</div>
</div>
@endsection