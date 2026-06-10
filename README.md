# Kebab Blast - Mini E-Commerce

Project Mini E-Commerce "Kebab Blast" menggunakan Laravel 12, Laravel Sanctum, Blade Template, Tailwind CSS, dan MySQL.

**Tagline:** Pedasnya Bikin Nagih 🌯🔥

---

## 📋 Fitur

### User Features
- ✅ Authentication (Register, Login, Logout)
- ✅ Browse & Detail Produk
- ✅ Shopping Cart (Add, Update, Delete)
- ✅ API & Web Interface
- ✅ Dark Mode UI dengan Orange Accent
- ✅ Responsive Design

### Admin Features
- ✅ Dashboard dengan Statistik
- ✅ CRUD Produk dengan Upload Gambar
- ✅ Search & Pagination Produk
- ✅ Data User Management
- ✅ Monitoring Keranjang
- ✅ Role-based Access Control

---

## 🚀 Quick Start

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Konfigurasi Environment
File `.env` sudah dikonfigurasi. Pastikan database sudah dibuat.

### 3. Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 4. Setup Storage & Build Assets
```bash
php artisan storage:link
npm run build
```

### 5. Jalankan Server
```bash
php artisan serve
```

Aplikasi berjalan di: `http://localhost:8000`

---

## 🔐 Login Credentials

### Admin
```
Email: admin@kebabblast.com
Password: admin123
Dashboard: http://localhost:8000/admin/dashboard
```

### User Biasa
Register di `/daftar` atau buat manual

---

## 📦 Dummy Data

Seeder membuat 5 produk:
- Kebab Original (Rp 18.000)
- Kebab Jumbo (Rp 25.000)
- Kebab Cheese (Rp 22.000)
- Burger Blast (Rp 20.000)
- Hot Dog (Rp 15.000)

---

## 🗄️ Database Schema

### users
- id, name, email, password, **role** (admin/user), timestamps

### products
- id, name, price, stock, description, image, timestamps

### cart_items
- id, user_id (FK), product_id (FK), quantity, timestamps

### Relasi
- User → hasMany → CartItem
- Product → hasMany → CartItem
- CartItem → belongsTo → User & Product

---

## 🌐 Routes

### Web Routes (User)
```
GET    /                    - Beranda
GET    /produk/{id}         - Detail Produk
GET    /masuk               - Login
POST   /masuk               - Proses Login
GET    /daftar              - Register
POST   /daftar              - Proses Register
GET    /keranjang           - Keranjang (auth)
POST   /keranjang           - Add to Cart (auth)
PATCH  /keranjang/{id}      - Update Cart (auth)
DELETE /keranjang/{id}      - Delete Cart (auth)
POST   /keluar              - Logout (auth)
```

### Web Routes (Admin)
```
GET    /admin/dashboard           - Dashboard (admin)
GET    /admin/produk              - List Produk (admin)
GET    /admin/produk/tambah       - Tambah Produk (admin)
POST   /admin/produk              - Store Produk (admin)
GET    /admin/produk/{id}/edit    - Edit Produk (admin)
PUT    /admin/produk/{id}         - Update Produk (admin)
DELETE /admin/produk/{id}         - Delete Produk (admin)
GET    /admin/user                - Data User (admin)
GET    /admin/keranjang           - Monitoring Keranjang (admin)
```

---

Quick fixes:
```bash
# Gambar tidak muncul
php artisan storage:link

# Route error
php artisan route:clear

# Config error
php artisan config:clear

# Reset database
php artisan migrate:fresh --seed
```

---

## 📊 Teknologi

- **Laravel:** 12.60.2
- **PHP:** 8.2.12
- **MySQL:** Database
- **Tailwind CSS:** Styling
- **Vite:** Build tool
- **Laravel Sanctum:** Authentication

---

## 📝 Struktur Project

```
mini-e-commerce/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/          # API Controllers
│   │   │   ├── Web/          # Web Controllers
│   │   │   └── Admin/        # Admin Controllers
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   ├── Requests/         # Form Validations
│   │   └── Resources/        # API Resources
│   └── Models/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   └── views/
│       ├── layouts/          # Layouts
│       ├── auth/             # Auth pages
│       ├── admin/            # Admin pages
│       └── errors/           # Error pages
├── routes/
│   ├── web.php
│   └── api.php
└── storage/
    └── app/public/products/  # Upload gambar
```

---
