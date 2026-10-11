# Electronics & Gadget Store Inventory Management System (Laravel)

Sistem Manajemen Inventaris Toko Elektronik berbasis **Laravel 10** dan **MySQL** dengan antarmuka modern **Tailwind CSS**. Project ini merupakan hasil migrasi dan refactoring arsitektural dari project PHP Native Pertemuan 4 (P4) menuju arsitektur modern MVC Laravel pada Pertemuan 5 (P5).

---

## 🏛️ Arsitektur MVC & Alur Kerja Request

Aplikasi ini mengimplementasikan alur baku MVC Laravel:
```text
Request (Browser) 
   ↓
Route (routes/web.php) 
   ↓
Controller (ProductController.php) 
   ↓
Model & Eloquent (Product.php & Category.php) 
   ↓
Database (MySQL - inventory_laravel) 
   ↓
Response / Blade View (resources/views/products/...)
```

### Penjelasan Pembagian Tanggung Jawab:
1. **Route (`routes/web.php`):** Mendaftarkan resource route RESTful (`Route::resource('products', ProductController::class)`).
2. **Controller (`app/Http/Controllers/ProductController.php`):** Menangani logika alur, validasi input form, pengambilan data dengan filter/pencarian, dan mengarahkan response/redirect.
3. **Model (`app/Models/Product.php` & `Category.php`):** Mengelola representasi entitas data, aturan mass-assignment (`$fillable`), dan relasi Eloquent (`Category hasMany Product`, `Product belongsTo Category`).
4. **View (`resources/views/`):** Menyajikan antarmuka pengguna berbasis Blade template inheritance (`layouts/app.blade.php`), Blade component (`<x-alert>`), dan format output yang aman dari serangan XSS.

---

## 🚀 Fitur Utama
- **Katalog Produk (CRUD Lengkap):** Menambah, melihat detail, memperbarui, dan menghapus produk.
- **Relasi Database (Eloquent Relationship):** Hubungan one-to-many antara Kategori dan Produk.
- **Pencarian & Filter Interaktif:** Cari produk berdasarkan Nama atau SKU, serta filter berdasarkan Kategori.
- **Pengurutan (Sorting):** Pengurutan dinamis berdasarkan Nama, SKU, Harga, dan Stok (Ascending & Descending).
- **Pagination Cerdas:** Mempertahankan parameter filter dan pencarian melalui `withQueryString()`.
- **Aturan Bisnis Stok (P4):** Indikator peringatan dini stok menipis (*low stock warning badge*) saat `stock <= minimum_stock`.
- **Validasi Form & CSRF:** Perlindungan token `@csrf` dan pesan error validasi berbahasa Indonesia yang informatif.

---

## 🛠️ Persyaratan Sistem & Tech Stack
- PHP >= 8.1
- Composer 2.x
- MySQL / MariaDB (XAMPP 8.2)
- Laravel Framework 10.x
- Tailwind CSS & FontAwesome Icons CDN

---

## 📦 Panduan Instalasi & Menjalankan Project

### 1. Masuk ke Direktori Project
```bash
cd C:\xampp\htdocs\inventory-laravel
```

### 2. Konfigurasi Environment (`.env`)
Pastikan pengaturan database di file `.env` sudah sesuai dengan MySQL XAMPP Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrasi Database & Seeding Data Awal
Jalankan perintah ini untuk membangun tabel dan memasukkan data sampel produk elektronik:
```bash
php artisan migrate:fresh --seed
```

### 4. Menjalankan Server Aplikasi
```bash
php artisan serve
```
Akses aplikasi melalui browser di: **http://127.0.0.1:8000** atau **http://127.0.0.1:8000/products**

---

## 📋 Daftar Route (Resource RESTful)
| Method | URI | Nama Route | Fungsi |
|---|---|---|---|
| `GET` | `/products` | `products.index` | Menampilkan katalog produk + search + filter |
| `GET` | `/products/create` | `products.create` | Menampilkan formulir tambah produk |
| `POST` | `/products` | `products.store` | Memvalidasi dan menyimpan produk baru |
| `GET` | `/products/{product}` | `products.show` | Menampilkan detail spesifikasi produk |
| `GET` | `/products/{product}/edit` | `products.edit` | Menampilkan formulir edit produk |
| `PUT/PATCH` | `/products/{product}` | `products.update` | Memvalidasi dan memperbarui data produk |
| `DELETE` | `/products/{product}` | `products.destroy` | Menghapus data produk dari sistem |
