# Galeri Sekolah SMKN 4 Bogor - Backend Web Gallery System

Sistem backend web gallery sekolah yang dibangun dengan Laravel 12, menyediakan fitur lengkap untuk mengelola galeri foto sekolah dengan sistem autentikasi dan otorisasi.

## 🚀 Fitur Utama

### 🔐 Autentikasi & Otorisasi
- **Login & Register**: Sistem autentikasi lengkap dengan validasi
- **Role-based Access Control**: Admin dan User dengan permission berbeda
- **Session Management**: Keamanan session yang robust

### 🖼️ Manajemen Galeri
- **CRUD Gallery**: Create, Read, Update, Delete galeri foto
- **Kategori**: Pengelompokan galeri berdasarkan kategori
- **Upload Gambar**: Support berbagai format gambar (JPEG, PNG, JPG, GIF)
- **Featured Gallery**: Sistem galeri unggulan
- **Search & Filter**: Pencarian dan filter berdasarkan kategori

### 👥 Dashboard
- **Admin Dashboard**: Statistik lengkap, monitoring user dan galeri
- **User Dashboard**: Dashboard personal untuk setiap user
- **Analytics**: View count, user activity tracking

### 🎨 UI/UX Modern
- **Responsive Design**: Mobile-first approach
- **Tailwind CSS**: Styling modern dan konsisten
- **Interactive Elements**: Hover effects, transitions, dan animations
- **Font Awesome Icons**: Icon set yang lengkap

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP 8.2+)
- **Database**: SQLite (dapat diubah ke MySQL/PostgreSQL)
- **Frontend**: Blade Templates + Tailwind CSS
- **JavaScript**: jQuery + Alpine.js
- **Authentication**: Laravel built-in auth system
- **File Storage**: Laravel Storage dengan symbolic link

## 📋 Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- Web server (Apache/Nginx) atau Laravel Sail
- Extensions PHP: BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd dzikriujikom
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

### 6. Create Storage Link
```bash
php artisan storage:link
```

### 7. Start Development Server
```bash
php artisan serve
```

## 👤 Akun Default

Setelah menjalankan seeder, tersedia akun default:

### Admin
- **Email**: admin@galeri-dzik.com
- **Password**: admin123
- **Role**: Administrator

### User Demo
- **Email**: user@galeri-dzik.com
- **Password**: user123
- **Role**: User

## 📁 Struktur Database

### Tabel Users
- `id` - Primary Key
- `name` - Nama lengkap user
- `username` - Username unik
- `email` - Email unik
- `role` - Role user (admin/user)
- `phone` - Nomor telepon (opsional)
- `address` - Alamat (opsional)
- `password` - Password terenkripsi
- `timestamps` - Created/Updated timestamps

### Tabel Categories
- `id` - Primary Key
- `name` - Nama kategori
- `slug` - URL slug unik
- `description` - Deskripsi kategori
- `color` - Warna kategori (hex)
- `is_active` - Status aktif kategori
- `timestamps` - Created/Updated timestamps

### Tabel Galleries
- `id` - Primary Key
- `title` - Judul galeri
- `description` - Deskripsi galeri
- `image` - Path gambar utama
- `thumbnail` - Path thumbnail
- `category_id` - Foreign key ke categories
- `user_id` - Foreign key ke users
- `location` - Lokasi (opsional)
- `event_date` - Tanggal event (opsional)
- `is_featured` - Status unggulan
- `is_active` - Status aktif
- `views` - Jumlah view
- `timestamps` - Created/Updated timestamps

## 🔐 API Endpoints

### Authentication
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `GET /register` - Halaman register
- `POST /register` - Proses register
- `POST /logout` - Logout

### Dashboard
- `GET /dashboard` - Dashboard berdasarkan role

### Gallery Management
- `GET /gallery` - Daftar semua galeri
- `GET /gallery/create` - Form tambah galeri
- `POST /gallery` - Simpan galeri baru
- `GET /gallery/{id}` - Detail galeri
- `GET /gallery/{id}/edit` - Form edit galeri
- `PUT /gallery/{id}` - Update galeri
- `DELETE /gallery/{id}` - Hapus galeri
- `POST /gallery/{id}/toggle-featured` - Toggle featured status
- `GET /gallery-search` - Search galeri

### Category Management (Admin Only)
- `GET /categories` - Daftar kategori
- `GET /categories/create` - Form tambah kategori
- `POST /categories` - Simpan kategori baru
- `GET /categories/{id}` - Detail kategori
- `GET /categories/{id}/edit` - Form edit kategori
- `PUT /categories/{id}` - Update kategori
- `DELETE /categories/{id}` - Hapus kategori
- `POST /categories/{id}/toggle-active` - Toggle active status

### Profile Management
- `GET /profile` - Halaman profile
- `POST /profile` - Update profile

## 🎨 Customization

### Menambah Kategori Baru
1. Edit `database/seeders/CategorySeeder.php`
2. Tambahkan kategori baru ke array `$categories`
3. Jalankan `php artisan db:seed --class=CategorySeeder`

### Mengubah Tema Warna
1. Edit file `resources/views/layouts/app.blade.php`
2. Ganti class Tailwind CSS sesuai kebutuhan
3. Atau edit file CSS custom

### Menambah Fitur Baru
1. Buat migration: `php artisan make:migration create_new_table`
2. Buat model: `php artisan make:model NewModel`
3. Buat controller: `php artisan make:controller NewController`
4. Buat views di folder yang sesuai
5. Tambahkan routes di `routes/web.php`

## 🔒 Security Features

- **CSRF Protection**: Semua form dilindungi CSRF token
- **SQL Injection Protection**: Menggunakan Eloquent ORM
- **XSS Protection**: Output escaping otomatis
- **File Upload Security**: Validasi file type dan size
- **Authentication Guards**: Session-based authentication
- **Authorization**: Policy-based authorization system

## 📱 Responsive Design

Sistem dirancang dengan mobile-first approach:
- **Mobile**: 1 kolom layout
- **Tablet**: 2-3 kolom layout
- **Desktop**: 4 kolom layout
- **Touch-friendly**: Optimized untuk touch devices

## 🚀 Deployment

### Production Server
1. Set `APP_ENV=production` di `.env`
2. Set `APP_DEBUG=false` di `.env`
3. Optimize Laravel: `php artisan optimize`
4. Set proper file permissions
5. Configure web server (Apache/Nginx)

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=galeri_dzik
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## 🐛 Troubleshooting

### Common Issues

#### Migration Error
```bash
php artisan migrate:fresh --seed
```

#### Storage Link Error
```bash
php artisan storage:link
```

#### Permission Error
```bash
chmod -R 755 storage bootstrap/cache
```

#### Composer Autoload Error
```bash
composer dump-autoload
```

## 📞 Support

Untuk bantuan dan support:
- Buat issue di repository
- Hubungi developer melalui email
- Dokumentasi lengkap tersedia di folder `docs/`

## 📄 License

Proyek ini dilisensikan di bawah MIT License. Lihat file `LICENSE` untuk detail lebih lanjut.

## 🙏 Credits

- **Laravel Team** - Framework PHP yang luar biasa
- **Tailwind CSS** - Utility-first CSS framework
- **Font Awesome** - Icon library
- **Alpine.js** - Lightweight JavaScript framework

---

**Dibuat dengan ❤️ untuk Galeri Sekolah SMKN 4 Bogor**
