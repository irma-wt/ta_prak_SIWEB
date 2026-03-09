<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <!-- =============================================
       META & KONFIGURASI DASAR
       ============================================= -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistem Pengelolaan Toko Aksesoris</title>

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

  <!-- CSS Eksternal -->
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!-- =============================================
       NAVBAR
       Berisi: Brand, menu navigasi, tombol Wishlist,
       tombol Dark Mode, dan tombol Login/Logout.
       ============================================= -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="mainNavbar">
    <div class="container">

      <!-- Brand teks navbar -->
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <i class="bi bi-gem fs-4" style="color: #FFD6E3;"></i>
        <span>TokoAksesoris</span>
      </a>

      <!-- Tombol Hamburger: muncul di layar mobile -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarMenu"
        aria-controls="navbarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Daftar Menu + Tombol Aksi -->
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" href="#beranda">
              <i class="bi bi-house-door me-1"></i>Beranda
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#kelola">
              <i class="bi bi-pencil-square me-1"></i>Kelola Aksesoris
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#statistik">
              <i class="bi bi-bar-chart-line me-1"></i>Statistik
            </a>
          </li>

        </ul>

        <!-- Tombol Wishlist, Dark Mode, dan Login/Logout di sisi kanan navbar -->
        <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0 flex-wrap">

          <!-- Tombol Wishlist: membuka modal -->
          <button
            class="btn btn-outline-light btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#wishlistModal"
          >
            <i class="bi bi-heart-fill me-1"></i>
            Wishlist (<span id="wishlist-count">0</span>)
          </button>

          <!-- Tombol Dark Mode: dikendalikan oleh script.js -->
          <button id="btn-theme" class="btn btn-outline-light btn-sm">
            <i class="bi bi-moon-fill me-1"></i>Mode Gelap
          </button>

          <!-- Kondisi Login/Logout menggunakan PHP Session -->
          <?php if (isset($_SESSION['user'])): ?>
            <!-- Sudah login: tampilkan nama user dan tombol Logout -->
            <span class="navbar-user-badge">
              <i class="bi bi-person-circle me-1"></i>
              <?php echo htmlspecialchars($_SESSION['user']); ?>
            </span>
            <a href="controller/logout.php" class="btn btn-danger btn-sm">
              <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
          <?php else: ?>
            <!-- Belum login: tampilkan tombol Login -->
            <a href="login.php" class="btn btn-warning btn-sm fw-semibold">
              <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </nav>
  <!-- END NAVBAR -->


  <!-- =============================================
       MODAL WISHLIST
       Menampilkan daftar produk yang di-wishlist.
       Diisi secara dinamis oleh script.js via DOM.
       ============================================= -->
  <div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header" style="background-color: #FFF0F4; border-bottom-color: #F4A7B9;">
          <h5 class="modal-title" style="color: #C2607A; font-family: Georgia, serif;">
            <i class="bi bi-heart-fill me-2" style="color: #C2607A;"></i>Daftar Wishlist Saya
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- List diisi oleh JavaScript -->
          <ul class="list-group" id="daftar-wishlist">
          </ul>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i>Tutup
          </button>
          <button type="button" class="btn btn-danger btn-sm" onclick="hapusWishlist()">
            <i class="bi bi-trash me-1"></i>Kosongkan
          </button>
        </div>

      </div>
    </div>
  </div>
  <!-- END MODAL WISHLIST -->


  <!-- =============================================
       HERO SECTION
       ============================================= -->
  <section id="beranda" class="hero-section d-flex align-items-center">
    <div class="container text-center">

      <div class="hero-icon mb-4">
        <i class="bi bi-gem"></i>
      </div>

      <h1 class="hero-title">Sistem Pengelolaan Toko Aksesoris</h1>

      <p class="hero-desc mx-auto">
        Platform digital untuk mengelola produk aksesoris dengan mudah dan efisien.
        Pantau stok, atur harga, dan kelola kategori produk Anda dalam satu tempat.
      </p>

      <a href="#kelola" class="btn btn-hero me-2">
        <i class="bi bi-plus-circle me-1"></i>Tambah Produk
      </a>
      <a href="#statistik" class="btn btn-hero-outline">
        <i class="bi bi-bar-chart-line me-1"></i>Lihat Produk
      </a>

    </div>
  </section>
  <!-- END HERO SECTION -->


  <!-- =============================================
       SECTION PRODUK & STATISTIK
       Tiap card punya:
       - .btn-beli       → tombol Beli (kurangi stok via JS)
       - .btn-wishlist   → tombol Wishlist (simpan ke SessionStorage)
       - .stok-text      → paragraf stok yang dimanipulasi JS
       - .product-name   → nama produk yang dibaca JS
       ============================================= -->
  <section id="statistik" class="stats-section py-5">
    <div class="container">

      <div class="section-header text-center mb-5">
        <h2 class="section-title">Produk Aksesoris</h2>
        <p class="section-subtitle">Daftar produk pilihan yang tersedia di toko kami</p>
      </div>

      <div class="row g-4" id="container-produk">

        <!-- ============================
             CARD 1: Anting Mutiara
             ============================ -->
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="product-card card h-100">

            <div class="card-img-wrapper">
              <img
                src="assets/antingmutiara.jpg"
                alt="Anting Mutiara Elegan"
                class="img-fluid product-img"
              />
              <span class="product-badge">Anting</span>
            </div>

            <div class="card-body d-flex flex-column">
              <h5 class="product-name">Anting Mutiara Elegan</h5>
              <p class="product-desc text-muted small">
                Anting berbahan mutiara asli dengan desain klasik, cocok untuk
                acara formal maupun kasual sehari-hari.
              </p>

              <div class="product-meta mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="product-price">Rp 185.000</span>
                  <span class="stok-text">
                    <i class="bi bi-archive me-1"></i>Stok: 42
                  </span>
                </div>
                <div class="product-rating mb-3">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <span class="ms-1 small text-muted">(4.5)</span>
                </div>
                <div class="d-flex gap-2">
                  <button class="btn btn-primary btn-sm btn-beli w-50">
                    <i class="bi bi-cart-plus me-1"></i>Beli
                  </button>
                  <button class="btn btn-outline-danger btn-sm btn-wishlist w-50">
                    <i class="bi bi-heart me-1"></i>Wishlist
                  </button>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- END CARD 1 -->


        <!-- ============================
             CARD 2: Cincin Perak
             ============================ -->
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="product-card card h-100">

            <div class="card-img-wrapper">
              <img
                src="assets/cincin.jpg"
                alt="Cincin Perak Minimalis"
                class="img-fluid product-img"
              />
              <span class="product-badge product-badge--gold">Cincin</span>
            </div>

            <div class="card-body d-flex flex-column">
              <h5 class="product-name">Cincin Perak Minimalis</h5>
              <p class="product-desc text-muted small">
                Cincin perak 925 dengan finishing halus, desain minimalis yang
                timeless dan nyaman dipakai setiap hari.
              </p>

              <div class="product-meta mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="product-price">Rp 220.000</span>
                  <span class="stok-text">
                    <i class="bi bi-archive me-1"></i>Stok: 28
                  </span>
                </div>
                <div class="product-rating mb-3">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <span class="ms-1 small text-muted">(5.0)</span>
                </div>
                <div class="d-flex gap-2">
                  <button class="btn btn-primary btn-sm btn-beli w-50">
                    <i class="bi bi-cart-plus me-1"></i>Beli
                  </button>
                  <button class="btn btn-outline-danger btn-sm btn-wishlist w-50">
                    <i class="bi bi-heart me-1"></i>Wishlist
                  </button>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- END CARD 2 -->


        <!-- ============================
             CARD 3: Gelang Emas
             ============================ -->
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="product-card card h-100">

            <div class="card-img-wrapper">
              <img
                src="assets/gelang.jpg"
                alt="Gelang Emas Lapis"
                class="img-fluid product-img"
              />
              <span class="product-badge">Gelang</span>
            </div>

            <div class="card-body d-flex flex-column">
              <h5 class="product-name">Gelang Emas Lapis</h5>
              <p class="product-desc text-muted small">
                Gelang lapis emas dengan motif anyam yang cantik, tahan lama
                dan tidak mudah pudar meski dipakai lama.
              </p>

              <div class="product-meta mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="product-price">Rp 310.000</span>
                  <span class="stok-text">
                    <i class="bi bi-archive me-1"></i>Stok: 15
                  </span>
                </div>
                <div class="product-rating mb-3">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <span class="ms-1 small text-muted">(4.0)</span>
                </div>
                <div class="d-flex gap-2">
                  <button class="btn btn-primary btn-sm btn-beli w-50">
                    <i class="bi bi-cart-plus me-1"></i>Beli
                  </button>
                  <button class="btn btn-outline-danger btn-sm btn-wishlist w-50">
                    <i class="bi bi-heart me-1"></i>Wishlist
                  </button>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- END CARD 3 -->

      </div>
      <!-- END ROW PRODUK -->


      <!-- ---- Ringkasan Statistik Toko ---- -->
      <div class="row g-3 mt-4">

        <div class="col-12 col-md-4">
          <div class="stat-mini d-flex align-items-center gap-3 p-3">
            <div class="stat-mini-icon">
              <i class="bi bi-box-seam"></i>
            </div>
            <div>
              <div class="stat-mini-number">128</div>
              <div class="stat-mini-label">Total Produk</div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="stat-mini stat-mini--gold d-flex align-items-center gap-3 p-3">
            <div class="stat-mini-icon">
              <i class="bi bi-stack"></i>
            </div>
            <div>
              <div class="stat-mini-number">2.540</div>
              <div class="stat-mini-label">Total Stok Unit</div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="stat-mini d-flex align-items-center gap-3 p-3">
            <div class="stat-mini-icon">
              <i class="bi bi-tags"></i>
            </div>
            <div>
              <div class="stat-mini-number">8</div>
              <div class="stat-mini-label">Kategori Produk</div>
            </div>
          </div>
        </div>

      </div>
      <!-- END STATISTIK MINI -->

    </div>
  </section>
  <!-- END SECTION PRODUK & STATISTIK -->


  <!-- =============================================
       SECTION FORM INPUT DATA AKSESORIS
       Hanya tampil jika sudah login (PHP Session).
       Jika belum login, tampilkan pesan dengan link login.
       ============================================= -->
  <section id="kelola" class="form-section py-5">
    <div class="container">

      <div class="section-header text-center mb-5">
        <h2 class="section-title">Kelola Aksesoris</h2>
        <p class="section-subtitle">Tambahkan produk aksesoris baru ke dalam sistem</p>
      </div>

      <?php if (isset($_SESSION['user'])): ?>
      <!-- Sudah login: tampilkan form tambah produk -->
      <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
          <div class="form-card card p-4 p-md-5">

            <h5 class="form-card-title mb-4">
              <i class="bi bi-plus-circle me-2"></i>Form Tambah Produk
            </h5>

            <form class="needs-validation" id="formAksesoris" novalidate>

              <!-- FIELD 1: Nama Aksesoris -->
              <div class="mb-4">
                <label for="namaAksesoris" class="form-label">
                  <i class="bi bi-tag me-1"></i>Nama Aksesoris
                </label>
                <input
                  type="text"
                  class="form-control custom-input"
                  id="namaAksesoris"
                  placeholder="Contoh: Gelang Perak Minimalis"
                  required
                />
                <div class="invalid-feedback">Nama aksesoris wajib diisi.</div>
              </div>

              <!-- FIELD 2: Harga Jual -->
              <div class="mb-4">
                <label for="hargaJual" class="form-label">
                  <i class="bi bi-currency-dollar me-1"></i>Harga Jual (Rp)
                </label>
                <input
                  type="number"
                  class="form-control custom-input"
                  id="hargaJual"
                  placeholder="Contoh: 75000"
                  min="1"
                  step="1000"
                  required
                />
                <div class="invalid-feedback">Harga jual wajib diisi dan harus lebih dari 0.</div>
              </div>

              <!-- FIELD 3: Stok -->
              <div class="mb-4">
                <label for="stokProduk" class="form-label">
                  <i class="bi bi-archive me-1"></i>Jumlah Stok
                </label>
                <input
                  type="number"
                  class="form-control custom-input"
                  id="stokProduk"
                  placeholder="Contoh: 50"
                  min="0"
                  required
                />
                <div class="invalid-feedback">Stok wajib diisi (minimal 0).</div>
              </div>

              <!-- FIELD 4: Kategori -->
              <div class="mb-4">
                <label for="kategori" class="form-label">
                  <i class="bi bi-grid me-1"></i>Kategori Produk
                </label>
                <select class="form-select custom-input" id="kategori" required>
                  <option value="" selected disabled>-- Pilih Kategori --</option>
                  <option value="Gelang">Gelang</option>
                  <option value="Kalung">Kalung</option>
                  <option value="Anting">Anting</option>
                  <option value="Cincin">Cincin</option>
                  <option value="Bros">Bros</option>
                  <option value="Jepit Rambut">Jepit Rambut</option>
                  <option value="Dompet Mini">Dompet Mini</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
                <div class="invalid-feedback">Silakan pilih kategori produk.</div>
              </div>

              <!-- FIELD 5: Deskripsi (Opsional) -->
              <div class="mb-4">
                <label for="deskripsi" class="form-label">
                  <i class="bi bi-card-text me-1"></i>Deskripsi Singkat
                  <span class="text-muted small">(opsional)</span>
                </label>
                <textarea
                  class="form-control custom-input"
                  id="deskripsi"
                  rows="3"
                  placeholder="Deskripsikan produk secara singkat..."
                ></textarea>
              </div>

              <!-- Tombol Submit -->
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-submit">
                  <i class="bi bi-save me-2"></i>Simpan Produk
                </button>
              </div>

              <!-- Tombol Reset -->
              <div class="d-grid mt-2">
                <button type="reset" class="btn btn-reset">
                  <i class="bi bi-arrow-counterclockwise me-2"></i>Reset Form
                </button>
              </div>

            </form>

            <!-- Alert sukses: tersembunyi secara default, ditampilkan oleh script.js -->
            <div id="alertSukses" class="alert alert-success mt-4 d-none" role="alert">
              <i class="bi bi-check-circle-fill me-2"></i>
              <strong>Berhasil!</strong> Data aksesoris berhasil ditambahkan ke sistem.
            </div>

          </div>
        </div>
      </div>

      <?php else: ?>
      <!-- Belum login: tampilkan pesan dan tombol login -->
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
          <div class="form-card card p-4 p-md-5 text-center">
            <div class="mb-3">
              <i class="bi bi-lock-fill" style="font-size: 3rem; color: #C2607A; opacity: 0.6;"></i>
            </div>
            <h5 class="form-card-title mb-3">Akses Terbatas</h5>
            <p class="text-muted mb-4">
              🔒 Silakan <a href="login.php" style="color: #C2607A; font-weight: 600;">login</a>
              terlebih dahulu untuk menambahkan produk aksesoris baru ke dalam sistem.
            </p>
            <a href="login.php" class="btn btn-submit">
              <i class="bi bi-box-arrow-in-right me-2"></i>Login Sekarang
            </a>
          </div>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </section>
  <!-- END SECTION FORM -->


  <!-- =============================================
       FOOTER
       ============================================= -->
  <footer class="site-footer py-4">
    <div class="container text-center">
      <div class="mb-2">
        <i class="bi bi-gem me-1" style="color: #F4A7B9;"></i>
        <strong style="color: #F4A7B9;">TokoAksesoris</strong>
      </div>
      <p class="footer-text mb-0">
        &copy; 2025 Sistem Pengelolaan Toko Aksesoris. Hak cipta dilindungi.
      </p>
    </div>
  </footer>
  <!-- END FOOTER -->


  <!-- Bootstrap 5 JS Bundle (WAJIB di atas script.js agar modal bisa bekerja) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script utama kita (dark mode, beli, wishlist, validasi form) -->
  <script src="js/script.js"></script>

</body>
</html>