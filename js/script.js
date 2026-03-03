// ==========================================
// 1. FITUR DARK MODE (LocalStorage & DOM)
// ==========================================
const btnTheme = document.getElementById('btn-theme');
const body = document.body;

// Cek apakah ada simpanan tema di browser?
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    btnTheme.innerHTML = '<i class="bi bi-sun-fill me-1"></i>Mode Terang';
}

btnTheme.addEventListener('click', function () {
    body.classList.toggle('dark-mode');

    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        btnTheme.innerHTML = '<i class="bi bi-sun-fill me-1"></i>Mode Terang';
    } else {
        localStorage.removeItem('theme');
        btnTheme.innerHTML = '<i class="bi bi-moon-fill me-1"></i>Mode Gelap';
    }
});


// ==========================================
// 2. FITUR BELI / KURANGI STOK (Event Listener & DOM)
// ==========================================
function aktifkanTombolBeli() {
    // Clone tombol untuk menghapus event listener lama (jika ada)
    const tombolBeli = document.querySelectorAll('.btn-beli');
    tombolBeli.forEach(function (button) {
        button.replaceWith(button.cloneNode(true));
    });

    // Pasang event listener baru ke semua tombol beli
    const tombolBaru = document.querySelectorAll('.btn-beli');
    tombolBaru.forEach(function (button) {
        button.addEventListener('click', function (e) {
            const cardBody = e.target.closest('.card-body');
            const stokElement = cardBody.querySelector('.stok-text');

            // Ambil angka stok dari teks "Stok: 42"
            let stok = parseInt(stokElement.innerText.replace("Stok: ", ""));

            const namaBarang = cardBody.querySelector('.product-name').innerText;

            if (stok > 0) {
                stok--;
                stokElement.innerText = "Stok: " + stok;
                alert("✅ Berhasil membeli " + namaBarang + "!");
            } else {
                alert("❌ Stok " + namaBarang + " sudah habis!");
                e.target.disabled = true;
                e.target.innerText = "Habis";
                e.target.classList.remove('btn-primary');
                e.target.classList.add('btn-secondary');
            }
        });
    });
}
aktifkanTombolBeli();


// ==========================================
// 3. FITUR WISHLIST (SessionStorage & DOM)
// ==========================================
let wishlist = JSON.parse(sessionStorage.getItem('wishlist')) || [];

// Update angka counter wishlist di navbar
function updateWishlistCount() {
    document.getElementById('wishlist-count').innerText = wishlist.length;
}

// Tambah produk ke wishlist saat tombol ❤ diklik
document.querySelectorAll('.btn-wishlist').forEach(function (button) {
    button.addEventListener('click', function (e) {
        const cardBody = e.target.closest('.card-body');
        const namaBarang = cardBody.querySelector('.product-name').innerText;

        if (!wishlist.includes(namaBarang)) {
            wishlist.push(namaBarang);
            sessionStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
            alert("❤ " + namaBarang + " ditambahkan ke Wishlist!");
        } else {
            alert("⚠ " + namaBarang + " sudah ada di Wishlist!");
        }
    });
});

// Render isi wishlist ke dalam modal
function tampilkanWishlist() {
    const daftarWishlist = document.getElementById('daftar-wishlist');
    daftarWishlist.innerHTML = '';

    if (wishlist.length === 0) {
        daftarWishlist.innerHTML = '<li class="list-group-item text-center text-muted">Wishlist masih kosong.</li>';
    } else {
        wishlist.forEach(function (item) {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerHTML = '❤ ' + item;
            daftarWishlist.appendChild(li);
        });
    }
}

// Panggil tampilkanWishlist() otomatis setiap modal dibuka
const wishlistModal = document.getElementById('wishlistModal');
wishlistModal.addEventListener('show.bs.modal', function () {
    tampilkanWishlist();
});

// Kosongkan semua wishlist
function hapusWishlist() {
    wishlist = [];
    sessionStorage.removeItem('wishlist');
    updateWishlistCount();
    tampilkanWishlist();
}

// Inisialisasi counter saat halaman pertama kali dibuka
updateWishlistCount();


// ==========================================
// 4. FITUR VALIDASI FORM (DOM & Event)
// ==========================================
const formAksesoris = document.getElementById('formAksesoris');

if (formAksesoris) {
    formAksesoris.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (formAksesoris.checkValidity()) {
            // Ambil nilai input
            const nama     = document.getElementById('namaAksesoris').value;
            const harga    = parseInt(document.getElementById('hargaJual').value);
            const stok     = document.getElementById('stokProduk').value;
            const kategori = document.getElementById('kategori').value;

            // Tampilkan alert sukses DOM
            const alertSukses = document.getElementById('alertSukses');
            alertSukses.innerHTML =
                '<i class="bi bi-check-circle-fill me-2"></i>' +
                '<strong>Berhasil!</strong> Produk <em>' + nama + '</em> (Kategori: ' + kategori +
                ', Stok: ' + stok + ', Harga: Rp ' + harga.toLocaleString('id-ID') + ') berhasil ditambahkan.';
            alertSukses.classList.remove('d-none');

            // Reset form setelah 2.5 detik
            setTimeout(function () {
                formAksesoris.reset();
                formAksesoris.classList.remove('was-validated');
                alertSukses.classList.add('d-none');
            }, 2500);
        }

        formAksesoris.classList.add('was-validated');
    });
}