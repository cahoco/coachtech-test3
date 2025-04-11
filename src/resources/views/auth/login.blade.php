@extends('layouts.auth')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <h1 class="logo">PiGLy</h1>
        <h2 class="login-title">ログイン</h2>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" placeholder="メールアドレスを入力">
                    @error('email')<p class="error-message">{{ $message }}</p>@enderror
                <label for="password">パスワード</label>
                    <input type="password" name="password" id="password" placeholder="パスワードを入力">
                    @error('password')<p class="error-message">{{ $message }}</p>@enderror
                <button type="submit" class="btn-login">ログイン</button>
            </form>
                <div class="link-area">
                    <a href="{{ route('register.step1') }}">アカウント作成はこちら</a>
                </div>
    </div>
</div>
@endsection
