# Employee Management System

<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/5070ef25-bfc5-44c0-8e07-9bc0883534ef" />
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/d12f9548-2006-41f7-8e6d-df9c89c68e8f" />
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/6510bafc-554e-4849-b189-635d6ee70802" />
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/97bf44dc-3701-49b5-b53b-5cf7bc91141f" />


Dokumentasi project untuk Coding Test — PT. Asuransi Jasa Indonesia.

## Daftar Isi

- [1. ERD (Entity Relationship Diagram)](#1-erd-entity-relationship-diagram)
- [2. Dokumentasi API](#2-dokumentasi-api)
- [3. Cara Instalasi Aplikasi](#3-cara-instalasi-aplikasi)
- [4. Cara Menjalankan Aplikasi](#4-cara-menjalankan-aplikasi)

---

## 1. ERD (Entity Relationship Diagram)

Aplikasi ini memiliki 4 entitas utama yang saling berhubungan.

### a. Roles (Peran)

Menyimpan data peran pengguna, yaitu **Admin** dan **User** biasa.

| Kolom | Keterangan |
|---|---|
| `id` | Primary key |
| `name` | Nama role (admin / user) |

Satu role bisa dimiliki oleh banyak user *(relasi one-to-many ke tabel Users)*.

### b. Users (Pengguna Sistem)

Menyimpan akun yang bisa login ke sistem.

| Kolom | Keterangan |
|---|---|
| `id` | Primary key |
| `name` | Nama pengguna |
| `email` | Email (unik) |
| `password` | Password (hashed) |
| `role_id` | Foreign key ke tabel Roles — menentukan apakah user itu Admin atau User biasa |

Satu user bisa memiliki banyak catatan di tabel Activity Logs *(relasi one-to-many)*.

### c. Karyawans (Data Karyawan)

Menyimpan data master karyawan perusahaan.

| Kolom | Keterangan |
|---|---|
| `id` | Primary key |
| `employee_id` | ID karyawan (unik) |
| `name` | Nama karyawan |
| `gender` | Laki-laki / Perempuan |
| `email` | Email (unik) |
| `phone` | Nomor telepon |
| `department` | Departemen |
| `join_date` | Tanggal bergabung |
| `is_active` | Status aktif/nonaktif |
| `photo` | Foto karyawan |

> Tabel ini berdiri sendiri — tidak berelasi langsung ke tabel Users, karena data karyawan adalah data operasional perusahaan, bukan akun login.

### d. Activity Logs (Log Aktivitas)

Mencatat setiap aktivitas penting yang dilakukan user yang login: login, tambah data, update data, dan hapus data.

| Kolom | Keterangan |
|---|---|
| `id` | Primary key |
| `user_id` | Foreign key ke Users — siapa yang melakukan aksi |
| `action` | Jenis aktivitas |
| `description` | Keterangan detail |
| `created_at` | Waktu aktivitas |

Relasinya **one-to-many** dari Users ke Activity Logs — satu user bisa punya banyak log, dan kalau user tersebut dihapus, seluruh log miliknya ikut terhapus otomatis (*cascade delete*).

### Ringkasan Relasi

- Satu **Role** dipakai banyak **User** (1 admin/user bisa banyak akun dengan role sama)
- Satu **User** menghasilkan banyak **Activity Log** (jejak aktivitas yang dia lakukan)
- **Karyawan** adalah entitas independen, tidak terikat ke akun User manapun — murni data kepegawaian yang dikelola oleh Admin lewat menu Manajemen Karyawan

```
Roles (1) ──────< (N) Users (1) ──────< (N) Activity Logs

Karyawans (independen, tidak terhubung ke Users)
```

---

## 2. Dokumentasi API

**Base URL:** `http://<domain-anda>/api`
**Autentikasi:** JWT Bearer Token (`Authorization: Bearer <token>`)
**Format:** JSON request & response

### Autentikasi

| Method | Endpoint | Auth | Keterangan |
|---|---|---|---|
| POST | `/auth/login` | - | Login, body: `email`, `password` → return `access_token` |
| GET | `/auth/me` | Bearer | Profil user yang sedang login |
| POST | `/auth/logout` | Bearer | Logout (token di-blacklist) |
| POST | `/auth/refresh` | Bearer | Perpanjang token |

> Login berlaku maksimal 5 percobaan/menit per email (anti brute-force).

### Data Karyawan

| Method | Endpoint | Auth | Keterangan |
|---|---|---|---|
| GET | `/employees` | Semua user login | List karyawan (pagination 10/halaman) |
| GET | `/employees/{id}` | Semua user login | Detail 1 karyawan |
| POST | `/employees` | Admin only | Tambah karyawan |
| PUT | `/employees/{id}` | Admin only | Update karyawan |
| DELETE | `/employees/{id}` | Admin only | Hapus karyawan |

**Field body (POST/PUT):** `employee_id`, `name`, `gender` (L/P), `email`, `phone`, `department`, `join_date` (YYYY-MM-DD), `is_active` (boolean)

### Format Response

**Sukses:**
```json
{ "status": true, "message": "...", "data": { ... } }
```

**Error** — semua konsisten format `status` + `message`:

| Kode | Kondisi |
|---|---|
| 401 | Belum login / token tidak valid |
| 403 | Tidak punya izin (bukan admin) |
| 404 | Data tidak ditemukan |
| 422 | Validasi gagal (`errors` berisi detail per field) |
| 429 | Terlalu banyak percobaan |
| 500 | Error server |

**Contoh:**
```json
{ "status": false, "message": "Employee not found" }
```

---

## 3. Cara Instalasi Aplikasi

**Kebutuhan:** PHP ≥ 8.2, Composer, Node.js ≥ 18, MySQL, ekstensi PHP `sodium` aktif (untuk JWT).

```bash
# 1. Clone / salin project, lalu masuk ke foldernya
cd employee-management-system

# 2. Install dependency PHP
composer install

# 3. Salin file environment & generate app key
cp .env.example .env
php artisan key:generate

# 4. Atur koneksi database di .env
#    DB_CONNECTION=mysql
#    DB_HOST=127.0.0.1
#    DB_PORT=3306
#    DB_DATABASE=db_employee_system   (buat database ini dulu di MySQL)
#    DB_USERNAME=root
#    DB_PASSWORD=

# 5. Generate JWT secret (untuk REST API)
php artisan jwt:secret

# 6. Jalankan migration + seeder (buat tabel & data awal: role, admin, 30 karyawan contoh)
php artisan migrate --seed

# 7. Buat symlink storage (agar foto karyawan bisa diakses)
php artisan storage:link

# 8. Install dependency frontend & build asset
npm install
npm run build
```

---

## 4. Cara Menjalankan Aplikasi

### Opsi A — pakai `artisan serve` (paling mudah)

```bash
php artisan serve
```
Buka `http://127.0.0.1:8000`

### Opsi B — pakai Laragon (Apache otomatis)

Cukup jalankan Laragon (**Start All**), lalu akses lewat virtual host, contoh:
`http://employee-management-system.test`

### Mode Development

Untuk mode development (auto-reload asset saat CSS/JS diedit):

```bash
npm run dev
```

Jalankan bersamaan dengan `php artisan serve` di terminal terpisah.
