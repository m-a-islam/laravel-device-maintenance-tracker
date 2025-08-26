<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Device Maintenance Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,"Helvetica Neue",Arial,sans-serif;margin:2rem;color:#222}
        a{color:#0a58ca;text-decoration:none} a:hover{text-decoration:underline}
        .container{max-width:960px;margin:0 auto}
        .nav{display:flex;gap:1rem;margin-bottom:1rem}
        .card{border:1px solid #ddd;border-radius:8px;padding:1rem;margin-bottom:1rem}
        .btn{display:inline-block;padding:.4rem .7rem;border:1px solid #bbb;border-radius:6px;background:#f8f9fa}
        .btn-danger{border-color:#cc0000;color:#cc0000;background:#fff}
        .btn-primary{border-color:#0a58ca;color:#fff;background:#0a58ca}
        .btn-link{border:none;background:none;padding:0;color:#0a58ca}
        table{width:100%;border-collapse:collapse} th,td{padding:.5rem;border-bottom:1px solid #eee;text-align:left}
        .flash{padding:.6rem .8rem;border:1px solid #b6e3b6;background:#eaf8ea;border-radius:6px;margin-bottom:1rem}
        .error{color:#b20000;font-size:.9rem}
        form.inline{display:inline}
        .right{float:right}
        .muted{color:#666}
        .row{display:flex;gap:.5rem;flex-wrap:wrap}
        input,select,textarea{padding:.4rem .5rem;border:1px solid #bbb;border-radius:6px;width:100%}
        .field{margin-bottom:.7rem}
        .actions{display:flex;gap:.5rem;align-items:center}
    </style>
</head>
<body>
<div class="container">
    <div class="nav">
        <a href="{{ route('devices.index') }}">Devices</a>
    </div>

    @if(session('ok'))
        <div class="flash">{{ session('ok') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
