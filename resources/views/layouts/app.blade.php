<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="app-header">
        <div class="brand"><i>ش</i> پنل مدیریت</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="button ghost" type="submit">خروج</button>
        </form>
    </header>
    <main class="page">
        @yield('content')
    </main>
</body>
</html>
