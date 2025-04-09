@extends('layouts.auth')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <h1 class="logo">PiGLy</h1>
            <h2 class="login-title">新規会員登録</h2>
                <p class="step-text">STEP1 アカウント情報の登録</p>
                    <form method="POST" action="{{ route('register.step1.post') }}">
                    @csrf
                        <label for="name">お名前</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="名前を入力">
                            @error('name')<p class="error-message">{{ $message }}</p>@enderror
                        <label for="email">メールアドレス</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                            @error('email')<p class="error-message">{{ $message }}</p>@enderror
                        <label for="password">パスワード</label>
                            <input type="password" name="password" id="password" placeholder="パスワードを入力">
                            @error('password')<p class="error-message">{{ $message }}</p>@enderror
                        <button type="submit" class="btn-login">次に進む</button>
                    </form>
                        <div class="link-area">
                            <a href="{{ route('login') }}">ログインはこちら</a>
                        </div>
    </div>
</div>
@endsection
