@extends('layouts.weight_logs')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    {{-- 情報カード --}}
    <section class="dashboard-cards">
        <div class="card">
            <p class="card-label">目標体重</p>
            <p class="card-value">{{ number_format(optional($target)->target_weight, 1) ?? '-' }} <span>kg</span></p>
        </div>
        <div class="card">
            <p class="card-label">目標まで</p>
            <p class="card-value">{{ isset($difference) ? number_format($difference, 1) : '-' }} <span>kg</span></p>
        </div>
        <div class="card">
            <p class="card-label">最新体重</p>
            <p class="card-value">{{ optional($latestLog)->weight ? number_format($latestLog->weight, 1) : '-' }} <span>kg</span></p>
        </div>
    </section>

    <div class="dashboard-box">
        {{-- 検索フォーム＆データ追加ボタン --}}
        <div class="dashboard-controls">
            {{-- 左側：検索フォーム --}}
            <div class="search-area">
                <form method="GET" action="{{ url('/weight_logs/search') }}" class="search-form">
                    <input type="date" name="start_date" value="{{ old('start_date', $start ?? '') }}">
                    <span>〜</span>
                    <input type="date" name="end_date" value="{{ old('end_date', $end ?? '') }}">
                    <button type="submit" class="btn-search">検索</button>
                    @if (isset($start, $end))
                        <a href="{{ url('/weight_logs') }}" class="btn-reset">リセット</a>
                    @endif
                </form>

                {{-- 検索結果テキストだけを下に分けて配置！ --}}
                @if (isset($start, $end))
                    <p class="search-result">{{ $start }}〜{{ $end }}の検索結果：{{ $logs->total() }}件</p>
                @endif
            </div>

            {{-- データ追加ボタン --}}
            <div class="add-button">
                <a href="{{ url('/weight_logs') }}?modal=open" class="custom-btn primary">データ追加</a>
            </div>
        </div>

        {{-- データテーブル --}}
        <table class="dashboard-table">
            <thead>
                <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                    <td>{{ number_format($log->weight, 1) }}kg</td>
                    <td>{{ $log->calories ?? '-' }}cal</td>
                    <td>{{ $log->exercise_time ?? '-' }}</td>
                    <td>
                    <a href="{{ url('/weight_logs/' . $log->id) }}?page={{ request()->get('page', $logs->currentPage()) }}">
                        <img src="{{ asset('images/icon-edit.png') }}" alt="編集" width="16" height="16">
                    </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">体重データがありません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ページネーション（仮） --}}
    <div class="pagination-wrapper">
        {{ $logs->links('vendor.pagination.default') }}
    </div>
</div>

@if(request()->query('modal') === 'open')
    <div class="modal-page">
        <div class="modal-card">
            <h2>Weight Logを追加</h2>
            <form method="POST" action="{{ url('/weight_logs/create?modal=open') }}">
            @csrf
                {{-- 各フォーム項目 --}}
                <label>日付 <span class="required">必須</span></label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                    @error('date')<p class="error-message">{{ $message }}</p>@enderror
                <label>体重 <span class="required">必須</span></label>
                    <div class="form-with-unit">
                    <input type="text" name="weight" value="{{ old('weight') }}" placeholder="50.0">
                        <span class="unit">kg</span>
                    </div>
                    @error('weight')<p class="error-message">{{ $message }}</p>@enderror
                <label>摂取カロリー <span class="required">必須</span></label>
                    <div class="form-with-unit">
                    <input type="number" name="calories" value="{{ old('calories') }}" placeholder="1200">
                        <span class="unit">cal</span>
                    </div>
                    @error('calories')<p class="error-message">{{ $message }}</p>@enderror
                <label>運動時間 <span class="required">必須</span></label>
                    <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
                    @error('exercise_time')<p class="error-message">{{ $message }}</p>@enderror
                <label>運動内容</label>
                    <textarea name="exercise_content" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                    @error('exercise_content')<p class="error-message">{{ $message }}</p>@enderror
                <div class="center-buttons">
                    <a href="{{ url('/weight_logs') }}" class="custom-btn back">戻る</a>
                    <button type="submit" class="custom-btn primary">登録</button>
                </div>
            </form>
        </div>
    </div>
@endif

@endsection
