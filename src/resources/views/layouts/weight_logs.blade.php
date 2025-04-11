<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PiGLy</title>
        <link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
        @stack('styles')
    </head>
    <body>
        <header class="header">
            <div class="logo">PiGLy</div>
                <div class="dashboard-menu">
                    <a href="{{ url('/weight_logs/goal_setting') }}" class="menu-button">
                        <img src="{{ asset('images/icon-setting.png') }}" class="icon">
                        目標体重設定
                    </a>
                    <a href="{{ url('/logout') }}" class="menu-button">
                        <img src="{{ asset('images/icon-logout.png') }}" class="icon">
                        ログアウト
                    </a>
                </div>
        </header>
        <main>
            @yield('content')
        </main>
    </body>
</html>
