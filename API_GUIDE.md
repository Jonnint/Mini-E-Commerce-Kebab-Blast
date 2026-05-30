# API Guide - Kebab Blast

Dokumentasi lengkap API untuk project Kebab Blast.

**Base URL:** `http://localhost:8000/api`

---

## 🔐 Authentication

API menggunakan **Laravel Sanctum** untuk authentication.

### Header Authorization
```
Authorization: Bearer {your-token}
```

Token didapat dari response login/register.

---

## 📝 Response Format

Semua response menggunakan format konsisten:

### Success Response
```json
{
    "success": true,
    "message": "Berhasil",
    "data": {}
}
```

### Error Response
```json
{
    "success": false,
    "message": "Error message"
}
```

### Validation Error
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "field": ["Error message"]
    }
}
```

---

## 🔓 Public Endpoints

### 1. Register User
**POST** `/api/register`

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Berhasil mendaftar",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "role": "user"
        },
        "token": "1|xxxxxxxxxxxxxxxxxxxxx"
    }
}
```

---

### 2. Login User
**POST** `/api/login`

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Berhasil masuk",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "role": "user"
        },
        "token": "2|xxxxxxxxxxxxxxxxxxxxx"
    }
}
```

**Error (401):**
```json
{
    "success": false,
    "message": "Email atau password salah"
}
```

---

### 3. Get All Products
**GET** `/api/products`

**Response:**
```json
{
    "success": true,
    "message": "Berhasil mengambil data produk",
    "data": [
        {
            "id": 1,
            "name": "Kebab Original",
            "price": 18000,
            "stock": 50,
            "description": "Kebab klasik dengan daging sapi pilihan...",
            "image": null,
            "created_at": "2026-05-22T07:00:00.000000Z",
            "updated_at": "2026-05-22T07:00:00.000000Z"
        }
    ]
}
```

---

### 4. Get Product Detail
**GET** `/api/products/{id}`

**Response:**
```json
{
    "success": true,
    "message": "Berhasil mengambil detail produk",
    "data": {
        "id": 1,
        "name": "Kebab Original",
        "price": 18000,
        "stock": 50,
        "description": "Kebab klasik dengan daging sapi pilihan...",
        "image": null,
        "created_at": "2026-05-22T07:00:00.000000Z",
        "updated_at": "2026-05-22T07:00:00.000000Z"
    }
}
```

---

## 🔒 Protected Endpoints

Semua endpoint berikut memerlukan authentication token.

### 5. Logout
**POST** `/api/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "message": "Berhasil keluar"
}
```

---

### 6. Get Cart
**GET** `/api/cart`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "message": "Berhasil mengambil data keranjang",
    "data": {
        "items": [
            {
                "id": 1,
                "user_id": 1,
                "product_id": 1,
                "quantity": 2,
                "product": {
                    "id": 1,
                    "name": "Kebab Original",
                    "price": 18000,
                    "stock": 50
                },
                "subtotal": 36000,
                "created_at": "2026-05-22T07:00:00.000000Z",
                "updated_at": "2026-05-22T07:00:00.000000Z"
            }
        ],
        "total": 36000
    }
}
```

---

### 7. Add Item to Cart
**POST** `/api/cart/items`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "product_id": 1,
    "quantity": 2
}
```

**Response (201):**
```json
{
    "success": true,
    "message": "Berhasil menambahkan ke keranjang",
    "data": {
        "id": 1,
        "user_id": 1,
        "product_id": 1,
        "quantity": 2,
        "product": {
            "id": 1,
            "name": "Kebab Original",
            "price": 18000
        },
        "subtotal": 36000
    }
}
```

**Error - Stok Tidak Cukup (400):**
```json
{
    "success": false,
    "message": "Stok tidak cukup"
}
```

---

### 8. Update Cart Item
**PATCH** `/api/cart/items/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "quantity": 3
}
```

**Response:**
```json
{
    "success": true,
    "message": "Berhasil memperbarui keranjang",
    "data": {
        "id": 1,
        "user_id": 1,
        "product_id": 1,
        "quantity": 3,
        "product": {
            "id": 1,
            "name": "Kebab Original",
            "price": 18000
        },
        "subtotal": 54000
    }
}
```

**Error - Tidak Memiliki Akses (403):**
```json
{
    "success": false,
    "message": "Tidak memiliki akses"
}
```

---

### 9. Delete Cart Item
**DELETE** `/api/cart/items/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "message": "Berhasil menghapus item dari keranjang"
}
```

---

### 10. Clear Cart
**DELETE** `/api/cart/clear`

**Headers:**
```
Authorization: Bearer {token}
```

**Response:**
```json
{
    "success": true,
    "message": "Berhasil mengosongkan keranjang"
}
```

---

## 🧪 Testing dengan Postman/Thunder Client

### 1. Register User Baru
```
POST http://localhost:8000/api/register
Body: {
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

### 2. Login & Copy Token
```
POST http://localhost:8000/api/login
Body: {
    "email": "test@example.com",
    "password": "password123"
}
```
**Copy token dari response!**

### 3. Get Products
```
GET http://localhost:8000/api/products
```

### 4. Add to Cart
```
POST http://localhost:8000/api/cart/items
Headers: Authorization: Bearer {your-token}
Body: {
    "product_id": 1,
    "quantity": 2
}
```

### 5. View Cart
```
GET http://localhost:8000/api/cart
Headers: Authorization: Bearer {your-token}
```

### 6. Update Cart Item
```
PATCH http://localhost:8000/api/cart/items/1
Headers: Authorization: Bearer {your-token}
Body: {
    "quantity": 3
}
```

### 7. Delete Cart Item
```
DELETE http://localhost:8000/api/cart/items/1
Headers: Authorization: Bearer {your-token}
```

### 8. Logout
```
POST http://localhost:8000/api/logout
Headers: Authorization: Bearer {your-token}
```

---

## ❌ Error Codes

| Code | Message | Keterangan |
|------|---------|------------|
| 200 | OK | Request berhasil |
| 201 | Created | Resource berhasil dibuat |
| 400 | Bad Request | Validasi gagal atau stok tidak cukup |
| 401 | Unauthorized | Token tidak valid atau belum login |
| 403 | Forbidden | Tidak memiliki akses |
| 404 | Not Found | Resource tidak ditemukan |
| 422 | Unprocessable Entity | Validasi error |
| 500 | Server Error | Error server |

---

## 🔍 Validation Rules

### Register
- **name:** required, string, max 255
- **email:** required, email, unique
- **password:** required, min 8, confirmed

### Login
- **email:** required, email
- **password:** required

### Add to Cart
- **product_id:** required, exists:products,id
- **quantity:** required, integer, min 1

### Update Cart
- **quantity:** required, integer, min 1

---

## 🛡️ Security

### Token Management
- Token disimpan di database (personal_access_tokens)
- Token dihapus saat logout
- Token tidak expire (bisa diatur jika perlu)

### Authorization
- Setiap user hanya bisa akses cart miliknya
- Middleware `auth:sanctum` untuk protected routes
- Check ownership sebelum update/delete

### Validation
- Semua input divalidasi
- Stock checking sebelum add to cart
- Product existence checking

---

## 💡 Tips

### Menyimpan Token
```javascript
// Simpan token setelah login
localStorage.setItem('token', response.data.token);

// Gunakan token di request
headers: {
    'Authorization': `Bearer ${localStorage.getItem('token')}`
}
```

### Handle Error
```javascript
try {
    const response = await fetch('/api/cart/items', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ product_id: 1, quantity: 2 })
    });
    
    const data = await response.json();
    
    if (!data.success) {
        alert(data.message);
    }
} catch (error) {
    console.error('Error:', error);
}
```

---

## 📊 Rate Limiting

Saat ini tidak ada rate limiting. Bisa ditambahkan jika diperlukan:

```php
Route::middleware(['throttle:60,1'])->group(function () {
    // 60 requests per minute
});
```

---

## 🎯 Best Practices

1. **Selalu gunakan HTTPS di production**
2. **Simpan token dengan aman**
3. **Handle error dengan baik**
4. **Validasi input di client & server**
5. **Logout saat selesai**
6. **Jangan expose token di URL**
7. **Set token expiration di production**

---

**API Documentation - Kebab Blast** 🌯🔥

**Version:** 1.1.0  
**Last Updated:** May 22, 2026
