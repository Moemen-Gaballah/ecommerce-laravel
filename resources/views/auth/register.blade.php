@extends('front-end.main')
@section('content')
<div class="container login-page">
    <h1 class="text-center">
        <span class="selected" data-class="login">Login</span> |
        <span data-class="signup">Signup</span>
    </h1>
    <!-- Start Login Form -->
    <form class="login" action="{{ route('login') }}" method="POST">
        {{ csrf_field() }}
        <div class="input-container">
            <input
                    class="form-control"
                    type="text"
                    name="email"
                    autocomplete="off"
                    placeholder="Type your username"
                    required />
        </div>
        <div class="input-container">
            <input
                    class="form-control"
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    placeholder="Type your password"
                    required />
        </div>
        <input class="btn btn-primary btn-block" name="login" type="submit" value="Login" />
    </form>
    <!-- End Login Form -->
    <!-- Start Signup Form -->
    <form class="signup" action="{{ route('register') }}" method="POST">
        {{ csrf_field() }}
        <div class="input-container">
            <input
                    pattern=".{4,}"
                    title="Username Must Be Between 4 Chars"
                    class="form-control"
                    type="text"
                    name="name"
                    autocomplete="off"
                    placeholder="Type your username"
                    required />
        </div>
        <div class="input-container">
            <input
                    minlength="4"
                    class="form-control"
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    placeholder="Type a Complex password"
                    required />
        </div>
        <div class="input-container">
            <input
                    minlength="4"
                    class="form-control"
                    type="password"
                    name="password_confirmation"
                    autocomplete="new-password"
                    placeholder="Type a password again"
                    required />
        </div>
        <div class="input-container">
            <input
                    class="form-control"
                    type="email"
                    name="email"
                    placeholder="Type a Valid email" />
        </div>
        <input class="btn btn-success btn-block" name="signup" type="submit" value="Signup" />
    </form>
    <!-- End Signup Form -->
</div>
@endsection