# 🧥 Aplikasi Inventory Pakaian  
### *Manajemen Stok Pakaian – Role Admin, Karyawan, dan Pimpinan*

Aplikasi Inventory Pakaian ini dibangun menggunakan **CodeIgniter 3** dengan database **MySQL** serta tampilan berbasis **HTML, CSS, JavaScript, dan Bootstrap**. Sistem ini dirancang untuk mengelola dan memonitor stok pakaian secara efisien dengan akses multi-role.

---

## 📌 Fitur Utama

### 🧑‍💼 Admin
- Mengelola data pakaian  
- Mengelola kategori pakaian  
- Mengelola stok masuk dan keluar  
- Kelola data pengguna (karyawan & pimpinan)  
- Mengelola laporan inventory  
- Export laporan ke PDF/Excel (jika tersedia)

### 👕 Karyawan
- Input stok masuk  
- Input stok keluar  
- Melihat stok terbaru  
- Searching & filtering data pakaian  

### 🧑‍⚖️ Pimpinan
- Melihat laporan inventory  
- Monitoring stok real-time  
- Melihat grafik kebutuhan & pengeluaran stok  

---

## 🛠️ Teknologi yang Digunakan

| Bagian         | Teknologi                       |
|----------------|----------------------------------|
| Backend        | CodeIgniter 3                    |
| Frontend       | HTML, CSS, JavaScript, Bootstrap |
| Database       | MySQL                            |
| Grafik (opsional) | Chart.js atau lainnya         |

---

## 📂 Struktur Direktori (Ringkas)

```
/application
    /controllers
    /models
    /views
/assets
    /css
    /js
    /images
/database
    inventory.sql
/uploads
    /pakaian
```

---

## 📥 Instalasi & Setup

### 1️⃣ Clone Repository
```bash
git clone https://github.com/username/inventory-pakaian.git
```

### 2️⃣ Pindahkan Project ke Server Local
Taruh di folder:
```
htdocs/ (XAMPP) atau public_html (hosting)
```

### 3️⃣ Import Database
- Buka **phpMyAdmin**
- Buat database baru
- Import file:
```
database/inventory.sql
```

### 4️⃣ Konfigurasi Database

**application/config/database.php**
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'inventory',
    'dbdriver' => 'mysqli'
);
```

### 5️⃣ Atur Base URL

**application/config/config.php**
```php
$config['base_url'] = 'http://localhost/inventory-pakaian/';
```

---

## 📦 Modul Utama di Dalam Sistem

- **Master Data Pakaian**  
  Input, edit, hapus data pakaian lengkap dengan foto, kategori, dan harga.

- **Stok Masuk & Keluar**  
  Mencatat setiap perubahan stok secara real-time.

- **Kategori Pakaian**  
  Mengelompokkan produk agar lebih mudah dikelola.

- **Manajemen User**  
  Role: Admin, Karyawan, Pimpinan.

- **Laporan Inventory**  
  Rekap stok masuk, keluar, dan sisa stok.

---

## 🔐 Akun Login Default

| Role      | Username | Password |
|-----------|----------|----------|
| Admin     | admin    | admin    |
| Karyawan  | karyawan | karyawan |
| Pimpinan  | pimpinan | pimpinan |

> Untuk keamanan lebih, segera ganti password setelah login.

---

## 🖼️ Screenshot (Opsional)

Kamu dapat menambahkan screenshot halaman penting, seperti:
- Dashboard
- Data pakaian
- Form stok masuk & keluar
- Laporan inventory

---

## 📝 Lisensi

Project ini dapat digunakan dan dikembangkan bebas sesuai kebutuhan.

---

## 💡 Kontribusi

Pull request sangat diterima.  
Jika menemukan bug atau ingin request fitur, silakan buat *issue*.

---

### ⭐ Jangan lupa beri **Star** pada repo ini jika bermanfaat!
