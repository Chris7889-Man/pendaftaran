<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/logo_dimensi.png') }}">
  <link
    href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Mulish:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/login/style.css') }}">
</head>

<body>
  <div class="wrap">
    <div class="logo">
      <div class="logo-icon">🎓</div>
      <h1>Admin Panel</h1>
      <p class="sub">Sistem Pendaftaran Ditra XXIV</p>
    </div>

    <div class="card">
      @if ($errors->any())
        <div class="error-box">
          ⚠ {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="field">
          <label for="username">Email</label>
          <input type="email" id="username" name="email" placeholder="Admin@gmail.com">

        </div>
        <div class="field">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="••••••••">
        </div>
        <button type="submit" class="btn">Masuk →</button>
      </form>

    </div>

    <div class="back"><a href="/">← Kembali ke Beranda</a></div>
  </div>
</body>

</html>
