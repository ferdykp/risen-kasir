@extends('layouts.auth')
@section('content')
    <div class="login-box">
        <h3>Login Kasir</h3>

        @if (session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('auth.login') }}">
            @csrf
            <input type="name" name="name" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <style>
        body {
            font-family: sans-serif;
            background: #757070;
        }

        .login-box {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type=name],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>

    </section>
@endsection
