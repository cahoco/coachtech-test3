@extends('layouts.auth')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <h1 class="logo">PiGLy</h1>
            <h2 class="login-title">新規会員登録</h2>
                <p class="step-text">STEP2 体重データの入力</p>
                    <form method="POST" action="{{ route('register.step2.post') }}">
                    @csrf
                        <label for="initial_weight">現在の体重</label>
                            <div style="display: flex; align-items: center;">
                                <input type="number" name="initial_weight" id="initial_weight" placeholder="現在の体重を入力" step="0.1">
                                <span style="margin-left: 8px;">kg</span>
                            </div>
                            @error('initial_weight')<p class="error-message">{{ $message }}</p>@enderror
                        <label for="target_weight">目標の体重</label>
                            <div style="display: flex; align-items: center;">
                                <input type="number" name="target_weight" id="target_weight" placeholder="目標の体重を入力" step="0.1">
                                <span style="margin-left: 8px;">kg</span>
                            </div>
                            @error('target_weight')<p class="error-message">{{ $message }}</p>@enderror
                        <button type="submit" class="btn-login">アカウント作成</button>
                    </form>
    </div>
</div>
@endsection
