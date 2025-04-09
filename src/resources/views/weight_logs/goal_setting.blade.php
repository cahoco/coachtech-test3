@extends('layouts.weight_logs')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="goal-setting-wrapper">
    <div class="goal-setting-card">
        <h2>目標体重設定</h2>
        @if(session('status'))
        <p class="status-message">{{ session('status') }}</p>
        @endif
        <form method="POST" action="{{ url('/weight_logs/goal_setting') }}">
        @csrf
            <div class="form-group">
                <input type="number" name="target_weight" step="0.1" value="{{ old('target_weight', $targetWeight ?? '') }}" required>
                <span class="unit">kg</span>
            </div>
            <div class="form-buttons">
                <a href="{{ url('/weight_logs') }}" class="btn btn-back">戻る</a>
                <button type="submit" class="btn btn-submit">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection
