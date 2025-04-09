@extends('layouts.weight_logs')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="dashboard-container">
    <div class="dashboard-box" style="max-width: 600px; margin: 40px auto; padding: 40px;">
        <h2 style="text-align: center; font-size: 24px; margin-bottom: 24px;">
            {{ isset($log) ? 'Weight Logを編集' : 'Weight Logを追加' }}
        </h2>

        <form method="POST" action="{{ url('/weight_logs/' . $log->id . '/update') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="page" value="{{ request()->query('page') }}">

            <label>日付 <span class="required">必須</span></label>
            <input type="date" name="date" value="{{ old('date', $log->date ?? date('Y-m-d')) }}">
            @error('date')<p class="error-message">{{ $message }}</p>@enderror

            <label>体重 <span class="required">必須</span></label>
            <div class="form-with-unit">
                <input type="text" name="weight" value="{{ old('weight', $log->weight ?? '') }}" placeholder="50.0">
                <span class="unit">kg</span>
            </div>
            @error('weight')<p class="error-message">{{ $message }}</p>@enderror

            <label>摂取カロリー <span class="required">必須</span></label>
            <div class="form-with-unit">
                <input type="number" name="calories" value="{{ old('calories', $log->calories ?? '') }}" placeholder="1200">
                <span class="unit">cal</span>
            </div>
            @error('calories')<p class="error-message">{{ $message }}</p>@enderror

            <label>運動時間 <span class="required">必須</span></label>
            <input type="time" name="exercise_time" value="{{ old('exercise_time', $log->exercise_time ?? '') }}">
            @error('exercise_time')<p class="error-message">{{ $message }}</p>@enderror

            <label>運動内容</label>
            <textarea name="exercise_content" placeholder="運動内容を追加">{{ old('exercise_content', $log->exercise_content ?? '') }}</textarea>
            @error('exercise_content')<p class="error-message">{{ $message }}</p>@enderror

            <div class="center-buttons">
                <a href="{{ url('/weight_logs') . '?page=' . request()->query('page') }}" class="custom-btn back">戻る</a>
                <button type="submit" class="custom-btn primary">
                    {{ isset($log) ? '更新' : '登録' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
