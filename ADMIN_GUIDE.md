# Admin Dashboard Guide - Kebab Blast

Panduan lengkap untuk menggunakan Admin Dashboard Kebab Blast.

---

## 🔐 Login Admin

```
Email: admin@kebabblast.com
Password: admin123
URL: http://localhost:8000/admin/dashboard
```

Atau klik "Dashboard Admin" di dropdown user setelah login.

---

## 📊 Dashboard

**URL:** `/admin/dashboard`

### Statistik Cards
- **Total Produk** - Jumlah semua produk
- **Total User** - Jumlah user (role: user)
- **Item Keranjang** - Total item di semua keranjang
- **Pendapatan Simulasi** - Sum(quantity × price) dari semua cart

### Quick Actions
- Tambah Produk
- Kelola Produk
- Data User

---

## 🛠️ Kelola Produk

**URL:** `/admin/produk`

### Fitur
- ✅ List semua produk dalam tabel
- ✅ Search produk by nama
- ✅ Pagination (10 per halaman)
- ✅ Edit produk
- ✅ Hapus produk (dengan konfirmasi)
- ✅ Tambah produk baru

### Tabel Produk
Menampilkan:
- Gambar produk (atau emoji jika kosong)
- Nama produk
- Harga (format Rupiah)
- Stok (badge hijau/merah)
- Action buttons (Edit & Hapus)

### Search
1. Ketik nama produk di search box
2. Klik "Cari"
3. Hasil muncul
4. Kosongkan untuk reset

---

## ➕ Tambah Produk

**URL:** `/admin/produk/tambah`

### Form Input
- **Nama Produk** (required)
- **Harga** (required, numeric, min: 0)
- **Stok** (required, integer, min: 0)
- **Deskripsi** (optional)
- **Gambar** (optional, max: 2MB, jpeg/jpg/png)

### Upload Gambar
1. Klik "Choose File"
2. Pilih gambar (max 2MB)
3. Preview otomatis muncul
4. Submit form
5. Gambar tersimpan di `storage/app/public/products`

### Validasi
Semua error messages dalam Bahasa Indonesia:
- "Nama produk wajib diisi"
- "Harga harus berupa angka"
- "Stok minimal 0"
- "Format gambar harus jpeg, jpg, atau png"
- "Ukuran gambar maksimal 2MB"

---

## ✏️ Edit Produk

**URL:** `/admin/produk/{id}/edit`

### Fitur
- Form pre-filled dengan data produk
- Tampilkan gambar saat ini
- Upload gambar baru (optional)
- Preview gambar baru
- Validasi sama seperti tambah produk

### Workflow
1. Klik "Edit" di list produk
2. Form muncul dengan data produk
3. Edit data yang perlu diubah
4. Upload gambar baru (optional, kosongkan jika tidak ingin ubah)
5. Preview gambar baru muncul
6. Klik "Update Produk"
7. Gambar lama otomatis dihapus jika upload baru

---

## 🗑️ Hapus Produk

### Workflow
1. Klik "Hapus" di list produk
2. Konfirmasi popup: "Yakin ingin menghapus produk ini?"
3. Klik "OK" untuk konfirmasi
4. Produk dihapus dari database
5. Gambar dihapus dari storage
6. Notifikasi sukses muncul

---

## 👥 Data User

**URL:** `/admin/user`

### Tampilan
Tabel menampilkan:
- Nama user
- Email
- Role (badge biru)
- Jumlah item di keranjang (badge orange)
- Tanggal terdaftar

### Pagination
10 user per halaman

### Empty State
Jika belum ada user, tampil pesan "Belum Ada User"

---

## 🛒 Monitoring Keranjang

**URL:** `/admin/keranjang`

### Tampilan
Tabel menampilkan:
- **User:** Nama & email
- **Produk:** Gambar & nama produk
- **Harga Satuan:** Format Rupiah
- **Quantity:** Badge orange (2x, 3x, dll)
- **Subtotal:** Quantity × Harga (format Rupiah)
- **Tanggal:** Kapan item ditambahkan

### Pagination
15 item per halaman

### Empty State
Jika belum ada item, tampil pesan "Belum Ada Item Keranjang"

### Query Optimization
Menggunakan eager loading:
```php
CartItem::with(['user', 'product'])->latest()->paginate(15);
```

---

## 🎨 UI/UX

### Sidebar (Desktop)
- Fixed di kiri
- Active state dengan background orange
- Icons untuk setiap menu
- Logout button di bawah

### Top Bar
- Page title
- User name
- Admin badge (orange)

### Alert Notifications
- Success: Background hijau
- Error: Background merah
- Muncul di bawah top bar
- Auto dismiss (bisa ditambahkan)

### Responsive
- **Desktop (> 768px):** Sidebar visible, full width tables
- **Mobile (< 768px):** Sidebar hidden, scrollable tables

---

## 🔒 Security & Authorization

### Middleware
```php
Route::middleware(['auth', 'admin'])
```

### AdminMiddleware
```php
// Check authentication
if (!auth()->check()) {
    return redirect()->route('login');
}

// Check role
if (auth()->user()->role !== 'admin') {
    abort(403);
}
```

### 403 Forbidden Page
User biasa yang coba akses admin akan melihat:
- Error 403
- "Akses Ditolak"
- "Anda tidak memiliki akses ke halaman ini"
- Button "Kembali ke Beranda"

### Authorization Checks
- User hanya bisa edit/delete produk sebagai admin
- Cart items ownership checked
- File upload validated

---

## 📤 Upload Gambar

### Storage Configuration
```
Path: storage/app/public/products
Public URL: /storage/products/{filename}
```

### Setup Storage Link
```bash
php artisan storage:link
```

### Validation
- **Max Size:** 2MB (2048 KB)
- **Format:** jpeg, jpg, png
- **Optional:** Bisa kosong

### Preview Gambar
JavaScript untuk preview:
```javascript
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}
```

### Delete Gambar
Gambar otomatis dihapus saat:
- Update produk dengan gambar baru
- Hapus produk

```php
if ($product->image) {
    Storage::disk('public')->delete($product->image);
}
```

---

## 🎯 Workflow Admin

### Menambah Produk Baru
1. Login sebagai admin
2. Klik "Dashboard Admin" di navbar
3. Klik "Tambah Produk" atau menu "Produk"
4. Klik "+ Tambah Produk"
5. Isi form (nama, harga, stok, deskripsi)
6. Upload gambar (optional)
7. Preview gambar muncul
8. Klik "Simpan Produk"
9. Redirect ke list produk
10. Notifikasi "Produk berhasil ditambahkan"

### Mengedit Produk
1. Masuk ke "Kelola Produk"
2. Klik "Edit" pada produk
3. Form muncul dengan data produk
4. Edit data yang diperlukan
5. Upload gambar baru (optional)
6. Klik "Update Produk"
7. Redirect ke list produk
8. Notifikasi "Produk berhasil diperbarui"

### Menghapus Produk
1. Masuk ke "Kelola Produk"
2. Klik "Hapus" pada produk
3. Konfirmasi popup muncul
4. Klik "OK"
5. Produk & gambar dihapus
6. Notifikasi "Produk berhasil dihapus"

### Monitoring User & Keranjang
1. Klik menu "User" untuk data user
2. Klik menu "Keranjang" untuk monitoring
3. Lihat statistik di dashboard

---

## 🐛 Troubleshooting

### Gambar tidak muncul
```bash
php artisan storage:link
```

### Permission denied saat upload
```bash
# Windows
icacls storage /grant Users:F /T

# Linux/Mac
chmod -R 775 storage
```

### Route admin tidak ditemukan
```bash
php artisan route:clear
php artisan route:cache
```

### Middleware error
```bash
php artisan config:clear
php artisan cache:clear
```

Lihat **[TROUBLESHOOTING.md](TROUBLESHOOTING.md)** untuk solusi lengkap.

---

## 🎓 Untuk Presentasi PKL

### Demo Flow
1. **Login Admin**
   - Show credentials
   - Explain role system

2. **Dashboard Overview**
   - Explain statistik cards
   - Show quick actions

3. **CRUD Produk**
   - Tambah produk dengan gambar
   - Show preview
   - Edit produk
   - Hapus dengan konfirmasi

4. **Monitoring**
   - Show data user
   - Show keranjang
   - Explain eager loading

5. **Security Demo**
   - Logout admin
   - Login user biasa
   - Try akses admin → 403 Forbidden
   - Explain middleware

### Penjelasan Teknis
- **Middleware:** AdminMiddleware untuk authorization
- **Form Request:** StoreProductRequest & UpdateProductRequest
- **File Upload:** Storage facade dengan validation
- **Eager Loading:** with() untuk optimize query
- **Pagination:** paginate() untuk performance
- **Role System:** Simple role field di users table

---

## 📊 Database

### Migration: add_role_to_users_table
```php
Schema::table('users', function (Blueprint $table) {
    $table->string('role')->default('user')->after('email');
});
```

### Seeder Update
```php
User::create([
    'name' => 'Admin Kebab Blast',
    'email' => 'admin@kebabblast.com',
    'password' => Hash::make('admin123'),
    'role' => 'admin',
]);
```

---

## 🔐 Role System

### Roles
- **admin** - Full access ke admin dashboard
- **user** - Access ke fitur user biasa

### Default Role
Semua user baru = 'user'

### Check Role
```php
// Blade
@if(auth()->user()->role === 'admin')
    // Admin content
@endif

// Controller
if (auth()->user()->role === 'admin') {
    // Admin logic
}
```

---

## ✅ Checklist Admin

- [ ] Login admin berhasil
- [ ] Dashboard tampil statistik
- [ ] Tambah produk berhasil
- [ ] Upload gambar berhasil
- [ ] Preview gambar works
- [ ] Edit produk berhasil
- [ ] Hapus produk berhasil
- [ ] Search produk works
- [ ] Pagination works
- [ ] Data user tampil
- [ ] Monitoring keranjang tampil
- [ ] User biasa tidak bisa akses admin
- [ ] 403 page muncul
- [ ] Responsive mobile & desktop

---

## 📝 Notes

- Admin bisa akses semua fitur user
- User biasa tidak bisa akses admin
- Gambar produk optional
- Pagination otomatis
- Search case-insensitive
- Konfirmasi sebelum hapus
- Notifikasi sukses/error
- Responsive mobile & desktop
- Semua teks dalam Bahasa Indonesia

---

**Admin Dashboard Guide - Kebab Blast** 🌯👨‍💼

**Version:** 1.1.0  
**Last Updated:** May 22, 2026
