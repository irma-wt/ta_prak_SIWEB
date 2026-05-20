<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login — TokoAksesoris</title>

  <!-- Bootstrap 5 CSS via CDN -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <!-- Bootstrap Icons via CDN -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    rel="stylesheet"
  />

  <!-- CSS Eksternal (termasuk style login-page) -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body class="login-page">

  <div class="login-box">

    <!-- Logo / Brand -->
    <div class="text-center mb-4">
      <i class="bi bi-gem login-gem-icon"></i>
      <h4 class="login-heading mt-2">TokoAksesoris</h4>
      <p class="login-sub">Silakan login untuk melanjutkan</p>
    </div>

    <!-- Alert Error: muncul jika login gagal -->
    @if(session('error'))
      <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 14px; border-radius: 8px;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
      </div>
    @endif

    <!-- Form Login -->
    <form method="POST" action="{{ route('login.proses') }}">
      @csrf

      <!-- Field Username -->
      <div class="mb-3">
        <label class="form-label" for="username">
          <i class="bi bi-person me-1"></i>Username
        </label>
        <input
          type="text"
          id="username"
          name="username"
          class="form-control"
          placeholder="Masukkan username"
          value="{{ request()->cookie('username') ?? '' }}"
          required
        />
      </div>

      <!-- Field Password -->
      <div class="mb-3">
        <label class="form-label" for="password">
          <i class="bi bi-lock me-1"></i>Password
        </label>
        <div class="position-relative">
          <input
            type="password"
            id="password"
            name="password"
            class="form-control"
            placeholder="Masukkan password"
            required
          />
          <!-- Toggle show/hide password -->
          <button
            type="button"
            class="btn-toggle-pass"
            onclick="togglePassword()"
            tabindex="-1"
          >
            <i class="bi bi-eye" id="icon-eye"></i>
          </button>
        </div>
      </div>

      <!-- Remember Me -->
      <div class="form-check mb-4">
        <input
          class="form-check-input"
          type="checkbox"
          id="remember"
          name="remember"
          {{ request()->cookie('username') ? 'checked' : '' }}
        />
        <label class="form-check-label" for="remember">Ingat saya</label>
      </div>

      <!-- Tombol Login -->
      <button type="submit" class="btn btn-login w-100 mb-3">
        <i class="bi bi-box-arrow-in-right me-2"></i>Login
      </button>

      <!-- Tombol Kembali ke Beranda -->
      <a href="{{ route('home') }}" class="btn btn-back w-100">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
      </a>

    </form>

    <!-- Info akun demo -->
    <div class="login-demo-info mt-4">
      <i class="bi bi-info-circle me-1"></i>
      Demo: username <strong>irma</strong> / password <strong>123</strong>
    </div>

  </div>

  <!-- Script toggle show/hide password -->
  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      const icon  = document.getElementById('icon-eye');
      if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
      } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
      }
    }
  </script>

</body>
</html>