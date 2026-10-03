<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <main class="auth-shell">
        <section class="auth-panel">
            <div>
                <div class="auth-mark">ش</div>
                <h1>پنل مدیریت</h1>
                <p>ورود کارکنان برای مدیریت ناحیه‌ها، خدمات، اطلاعیه‌ها و پروژه‌ها.</p>
            </div>
        </section>
        <section class="auth-card">
            <div class="auth-form">
                @yield('content')
            </div>
        </section>
    </main>
</body>
</html>
