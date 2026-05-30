# Troubleshooting & Tips - Kebab Blast

Solusi untuk masalah umum dan tips penggunaan project Kebab Blast.

---

## 🐛 Masalah Umum

### 1. Gambar Produk Tidak Muncul

**Masalah:** Gambar yang diupload tidak tampil di halaman.

**Solusi:**
```bash
php artisan storage:link
```

**Penjelasan:** Command ini membuat symbolic link dari `storage/app/public` ke `public/storage`.

**Cek apakah sudah linked:**
```bash
php artisan about
# Lihat bagian Storage
```

---

### 2. Route Not Found / 404

**Masalah:** Route admin atau route lain tidak ditemukan.

**Solusi:**
```bash
php artisan route:clear
php artisan route:cache
```

**Atau untuk development:**
```bash
php artisan route:clear
# Jangan cache di development
```

**Cek route yang tersedia:**
```bash
php artisan route:list
php artisan route:list --path=admin
```

---

### 3. Config Error / Middleware Error

**Masalah:** Error terkait config atau middleware tidak terdaftar.

**Solusi:**
```bash
php artisan config:clear
php artisan cache:clear
```

**Untuk clear semua cache:**
```bash
php artisan optimize:clear
```

---

### 4. View Error / Blade Error

**Masalah:** Error di view atau perubahan view tidak muncul.

**Solusi:**
```bash
php artisan view:clear
```

---

### 5. Database Error / Migration Error

**Masalah:** Error saat migration atau data tidak sesuai.

**Solusi - Reset Database:**
```bash
php artisan migrate:fresh --seed
```

**⚠️ WARNING:** Command ini akan **menghapus semua data** dan membuat ulang database!

**Alternatif - Rollback & Migrate:**
```bash
php artisan migrate:rollback
php artisan migrate
php artisan db:seed
```

---

### 6. Permission Denied (Upload File)

**Masalah:** Error permission saat upload gambar.

**Solusi Windows:**
```bash
icacls storage /grant Users:F /T
icacls bootstrap\cache /grant Users:F /T
```

**Solusi Linux/Mac:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

### 7. Port 8000 Sudah Digunakan

**Masalah:** `php artisan serve` error karena port 8000 sudah dipakai.

**Solusi - Gunakan port lain:**
```bash
php artisan serve --port=8001
```

Akses di: `http://localhost:8001`

---

### 8. Styling Tidak Muncul / CSS Tidak Load

**Masalah:** Tailwind CSS tidak load atau styling berantakan.

**Solusi:**
```bash
npm run build
```

**Untuk development (auto reload):**
```bash
npm run dev
```

**Jika masih error:**
```bash
npm install
npm run build
```

---

### 9. Composer Dependencies Error

**Masalah:** Error saat `composer install` atau package tidak ditemukan.

**Solusi:**
```bash
composer install --no-cache
composer dump-autoload
```

**Update dependencies:**
```bash
composer update
```

---

### 10. NPM Dependencies Error

**Masalah:** Error saat `npm install` atau vite tidak ditemukan.

**Solusi:**
```bash
npm install --force
```

**Atau hapus node_modules:**
```bash
rmdir /s /q node_modules  # Windows
rm -rf node_modules       # Linux/Mac
npm install
```

---

## 🔐 Masalah Authentication

### Token Tidak Valid / Unauthorized

**Masalah:** API return 401 Unauthorized.

**Solusi:**
1. Pastikan token disertakan di header
2. Format: `Authorization: Bearer {token}`
3. Token masih valid (belum logout)
4. User masih ada di database

**Test token:**
```bash
# Di Postman/Thunder Client
GET http://localhost:8000/api/cart
Headers: Authorization: Bearer {your-token}
```

---

### Session Expired / Logout Otomatis

**Masalah:** User logout otomatis saat refresh.

**Solusi:**
```bash
php artisan config:clear
php artisan cache:clear
```

**Cek session config di `.env`:**
```
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

---

### Admin Tidak Bisa Akses Dashboard

**Masalah:** Admin redirect atau 403 Forbidden.

**Solusi:**
1. Pastikan user memiliki `role = 'admin'`
2. Check di database:
```sql
SELECT * FROM users WHERE email = 'admin@kebabblast.com';
```
3. Update role jika perlu:
```sql
UPDATE users SET role = 'admin' WHERE email = 'admin@kebabblast.com';
```

---

## 📤 Masalah Upload Gambar

### File Too Large

**Masalah:** Error "The image must not be greater than 2048 kilobytes."

**Solusi:**
1. Compress gambar sebelum upload
2. Atau ubah max size di validation:

```php
// app/Http/Requests/StoreProductRequest.php
'image' => 'nullable|image|mimes:jpeg,jpg,png|max:5120', // 5MB
```

---

### Invalid File Type

**Masalah:** Error "The image must be a file of type: jpeg, jpg, png."

**Solusi:**
1. Pastikan file adalah gambar (jpeg/jpg/png)
2. Jangan upload file lain (pdf, doc, dll)

---

### Gambar Tidak Tersimpan

**Masalah:** Upload berhasil tapi gambar tidak ada di storage.

**Solusi:**
```bash
# Pastikan storage link sudah dibuat
php artisan storage:link

# Cek permission folder
icacls storage /grant Users:F /T  # Windows
chmod -R 775 storage               # Linux/Mac
```

---

## 🔍 Masalah Search & Pagination

### Search Tidak Bekerja

**Masalah:** Search produk tidak return hasil.

**Solusi:**
1. Pastikan query parameter benar: `?search=kebab`
2. Check controller menggunakan LIKE query
3. Case-insensitive search

---

### Pagination Error

**Masalah:** Pagination links tidak muncul atau error.

**Solusi:**
```bash
php artisan view:clear
```

**Atau publish pagination views:**
```bash
php artisan vendor:publish --tag=laravel-pagination
```

---

## 💾 Masalah Database

### Connection Refused

**Masalah:** Error "Connection refused" atau "Access denied".

**Solusi:**
1. Pastikan MySQL/XAMPP running
2. Check credentials di `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_e_commerce
DB_USERNAME=root
DB_PASSWORD=
```

---

### Table Not Found

**Masalah:** Error "Table 'xxx' doesn't exist".

**Solusi:**
```bash
php artisan migrate
```

**Jika masih error:**
```bash
php artisan migrate:fresh --seed
```

---

### Foreign Key Constraint Error

**Masalah:** Error saat delete produk yang ada di cart.

**Solusi:**
Ini normal behavior karena foreign key constraint. Hapus cart items dulu atau gunakan `onDelete('cascade')` di migration.

---

## 🎨 Masalah UI/UX

### Responsive Tidak Bekerja

**Masalah:** Layout berantakan di mobile.

**Solusi:**
```bash
npm run build
```

Pastikan Tailwind classes sudah benar.

---

### Hover Effect Tidak Bekerja

**Masalah:** Hover effect tidak muncul.

**Solusi:**
1. Clear browser cache (Ctrl + Shift + R)
2. Rebuild assets:
```bash
npm run build
```

---

## 🚀 Tips Development

### 1. Development Mode
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server (auto reload CSS)
npm run dev
```

### 2. Clear All Cache
```bash
php artisan optimize:clear
```

Ini akan clear:
- Config cache
- Route cache
- View cache
- Event cache
- Compiled cache

### 3. Debug Mode
Di `.env`:
```
APP_DEBUG=true  # Development
APP_DEBUG=false # Production
```

### 4. Log Errors
Check error di:
```
storage/logs/laravel.log
```

### 5. Database GUI
Gunakan tools seperti:
- phpMyAdmin (XAMPP)
- MySQL Workbench
- TablePlus
- DBeaver

---

## 📊 Tips Production

### 1. Optimize untuk Production
```bash
# Cache config
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoload
composer install --optimize-autoloader --no-dev
```

### 2. Environment Production
Di `.env`:
```
APP_ENV=production
APP_DEBUG=false
```

### 3. Security
- Gunakan HTTPS
- Set APP_KEY yang kuat
- Jangan expose `.env`
- Set proper file permissions
- Enable CSRF protection
- Validate all inputs

---

## 🧪 Tips Testing

### Test API dengan cURL
```bash
# Register
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Test","email":"test@test.com","password":"password123","password_confirmation":"password123"}'

# Login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@test.com","password":"password123"}'

# Get Products
curl http://localhost:8000/api/products

# Get Cart (with token)
curl http://localhost:8000/api/cart \
  -H "Authorization: Bearer {your-token}"
```

---

## 📝 Checklist Sebelum Presentasi

- [ ] Database sudah di-seed
- [ ] Storage link sudah dibuat
- [ ] Assets sudah di-build
- [ ] Server berjalan lancar
- [ ] Admin login berfungsi
- [ ] User login berfungsi
- [ ] CRUD produk berfungsi
- [ ] Upload gambar berfungsi
- [ ] Cart berfungsi
- [ ] API berfungsi
- [ ] Responsive di mobile
- [ ] No error di console
- [ ] No error di log

---

## 🆘 Masih Error?

### 1. Check Laravel Log
```
storage/logs/laravel.log
```

### 2. Check Browser Console
Press F12 → Console tab

### 3. Check Network Tab
Press F12 → Network tab → Lihat request yang error

### 4. Enable Debug Mode
```
APP_DEBUG=true
```

### 5. Fresh Install
```bash
# Backup .env
copy .env .env.backup

# Fresh install
composer install
npm install
php artisan migrate:fresh --seed
php artisan storage:link
npm run build
```

---

## 💡 Command Cheat Sheet

```bash
# Server
php artisan serve
php artisan serve --port=8001

# Database
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed

# Cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# Storage
php artisan storage:link

# Assets
npm run dev
npm run build

# Info
php artisan about
php artisan route:list
php artisan route:list --path=admin

# Make
php artisan make:controller NameController
php artisan make:model Name
php artisan make:migration create_table_name
php artisan make:request NameRequest
```

---

**Troubleshooting Guide - Kebab Blast** 🌯🔥

**Version:** 1.1.0  
**Last Updated:** May 22, 2026

**Jika masih ada masalah, cek dokumentasi Laravel:** https://laravel.com/docs
