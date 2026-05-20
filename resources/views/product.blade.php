<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Produk — TokoAksesoris</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>

  <!-- =============================================
       NAVBAR
       ============================================= -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="mainNavbar">
    <div class="container">

      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
        <i class="bi bi-gem fs-4" style="color: #FFD6E3;"></i>
        <span>TokoAksesoris</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="bi bi-house-door me-1"></i>Beranda
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('products') }}">
              <i class="bi bi-box-seam me-1"></i>Produk
            </a>
          </li>
        </ul>

        <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
          @if(session()->has('user'))
            <span class="navbar-user-badge">
              <i class="bi bi-person-circle me-1"></i>
              {{ session('user') }}
            </span>
            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">
              <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
          @else
            <a href="{{ route('login') }}" class="btn btn-warning btn-sm fw-semibold">
              <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
          @endif
        </div>
      </div>
    </div>
  </nav>
  <!-- END NAVBAR -->


  <!-- =============================================
       SECTION PRODUK
       ============================================= -->
  <section class="stats-section py-5">
    <div class="container">

      <!-- Header + Tombol Tambah -->
      <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
          <h2 class="section-title text-start" style="text-align:left!important;">
            Daftar Produk Aksesoris
          </h2>
          <p class="section-subtitle">Semua produk yang tersimpan di database</p>
        </div>

        @if(session()->has('user'))
          <button
            type="button"
            class="btn btn-submit"
            data-bs-toggle="modal"
            data-bs-target="#tambahProdukModal"
          >
            <i class="bi bi-plus-circle me-1"></i>Tambah Produk
          </button>
        @endif
      </div>

      {{-- Alert sukses setelah tambah produk --}}
      @if(session('success'))
        <div class="alert alert-success mb-4" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
      @endif

      <!-- Grid Kartu Produk dari Database -->
      <div class="row g-4" id="container-produk">
        @foreach($products as $item)
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="product-card card h-100">

              <div class="card-img-wrapper d-flex align-items-center justify-content-center"
                   style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); height: 180px;">
                <i class="bi bi-gem" style="font-size: 4rem; color: #C2607A; opacity: 0.4;"></i>
              </div>

              <div class="card-body d-flex flex-column">

                {{-- Badge Kategori --}}
                <span class="product-badge mb-2" style="position:static; display:inline-block; width:fit-content;">
                  {{ $item->category->category_name }}
                </span>

                <h5 class="product-name">{{ $item->product_name }}</h5>

                {{-- Badge Brand --}}
                <p class="small mb-2" style="color: var(--color-muted);">
                  <i class="bi bi-award me-1"></i>{{ $item->brand->nama_brand }}
                </p>

                <div class="product-meta mt-auto">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="product-price">
                      Rp {{ number_format($item->product_price, 0, ',', '.') }}
                    </span>
                    <span class="stok-text">
                      <i class="bi bi-archive me-1"></i>Stok: {{ $item->product_stock }}
                    </span>
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
        @endforeach

        {{-- Tampilkan pesan jika produk kosong --}}
        @if($products->isEmpty())
          <div class="col-12 text-center py-5">
            <i class="bi bi-inbox" style="font-size: 3rem; color: var(--color-muted);"></i>
            <p class="mt-3 text-muted">Belum ada produk. Silakan tambahkan produk baru.</p>
          </div>
        @endif

      </div>
      <!-- END GRID PRODUK -->

    </div>
  </section>


  <!-- =============================================
       MODAL TAMBAH PRODUK
       Hanya muncul jika sudah login
       ============================================= -->
  @if(session()->has('user'))
  <div class="modal fade" id="tambahProdukModal" data-bs-backdrop="static" data-bs-keyboard="false"
       tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header" style="background-color: #FFF0F4; border-bottom-color: #F4A7B9;">
          <h1 class="modal-title fs-5" id="tambahProdukModalLabel" style="color: #C2607A; font-family: Georgia, serif;">
            <i class="bi bi-plus-circle me-2"></i>Tambah Produk
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('products.store') }}" method="POST">
          @csrf

          <div class="modal-body">

            {{-- Nama Produk --}}
            <div class="mb-3">
              <label for="product_name" class="form-label">
                <i class="bi bi-tag me-1"></i>Nama Produk
              </label>
              <input
                type="text"
                class="form-control custom-input"
                id="product_name"
                name="product_name"
                placeholder="Contoh: Anting Mutiara Elegan"
                required
              />
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
              <label for="category_id" class="form-label">
                <i class="bi bi-grid me-1"></i>Kategori
              </label>
              <select class="form-select custom-input" id="category_id" name="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach($category as $cat)
                  <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                @endforeach
              </select>
            </div>

            {{-- Brand --}}
            <div class="mb-3">
              <label for="brand_id" class="form-label">
                <i class="bi bi-award me-1"></i>Brand
              </label>
              <select class="form-select custom-input" id="brand_id" name="brand_id" required>
                <option value="">Pilih Brand</option>
                @foreach($brand as $br)
                  <option value="{{ $br->brand_id }}">{{ $br->nama_brand }}</option>
                @endforeach
              </select>
            </div>

            {{-- Harga --}}
            <div class="mb-3">
              <label for="product_price" class="form-label">
                <i class="bi bi-currency-dollar me-1"></i>Harga Produk (Rp)
              </label>
              <input
                type="number"
                class="form-control custom-input"
                id="product_price"
                name="product_price"
                placeholder="Contoh: 150000"
                min="1"
                required
              />
            </div>

            {{-- Stok --}}
            <div class="mb-3">
              <label for="product_stock" class="form-label">
                <i class="bi bi-archive me-1"></i>Stok Produk
              </label>
              <input
                type="number"
                class="form-control custom-input"
                id="product_stock"
                name="product_stock"
                placeholder="Contoh: 50"
                min="0"
                required
              />
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-reset" data-bs-dismiss="modal">
              <i class="bi bi-x-circle me-1"></i>Kembali
            </button>
            <button type="submit" class="btn btn-submit">
              <i class="bi bi-check-circle me-1"></i>Simpan Produk
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
  @endif
  <!-- END MODAL -->


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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>