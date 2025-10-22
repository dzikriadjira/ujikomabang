# Sistem Admin - Galeri Sekolah SMKN 4 Bogor

## Deskripsi
Sistem ini telah dimodifikasi agar hanya admin yang dapat melakukan login dan register user baru. User biasa tidak dapat mengakses sistem login maupun register.

## Fitur yang Telah Dimodifikasi

### 1. Login System
- **Hanya admin yang bisa login**: User biasa akan ditolak saat mencoba login
- **Pesan error**: Menampilkan pesan "Hanya admin yang dapat login ke sistem ini"
- **UI Update**: Halaman login menampilkan informasi bahwa hanya admin yang bisa login

### 2. Registration System
- **Admin-only access**: Hanya admin yang sudah login yang bisa mengakses halaman register
- **Role selection**: Admin dapat memilih role untuk user baru (admin/user)
- **Protected routes**: Route register dilindungi dengan middleware admin.only
- **UI Update**: Halaman register menampilkan "Admin Only" dan tombol kembali ke dashboard

### 3. Middleware Protection
- **AdminOnlyMiddleware**: Middleware baru untuk membatasi akses hanya untuk admin
- **Route protection**: Semua route register dilindungi dengan middleware admin
- **Access control**: User non-admin akan di-redirect ke dashboard dengan pesan error

### 4. Dashboard Updates
- **Admin dashboard**: Tombol "Tambah User" ditambahkan di dashboard admin
- **Navigation**: Link "Tambah User" ditambahkan di navigation bar untuk admin
- **Quick actions**: Tombol register user ditambahkan di bagian quick actions

## Cara Penggunaan

### Untuk Admin:
1. **Login**: Akses `/login` dan login dengan akun admin
2. **Register User**: Klik "Tambah User" di dashboard atau navigation
3. **Pilih Role**: Pilih role untuk user baru (admin atau user)
4. **Create User**: Isi form dan submit untuk membuat user baru

### Untuk User Biasa:
1. **Tidak bisa login**: User biasa akan ditolak saat mencoba login
2. **Tidak bisa register**: User biasa tidak dapat mengakses halaman register
3. **Access denied**: Semua akses ke fitur admin akan ditolak

## File yang Dimodifikasi

### Controllers:
- `app/Http/Controllers/AuthController.php` - Login dan register logic

### Middleware:
- `app/Http/Middleware/AdminOnlyMiddleware.php` - Middleware baru untuk admin only
- `bootstrap/app.php` - Registrasi middleware

### Routes:
- `routes/web.php` - Route protection untuk register

### Views:
- `resources/views/auth/login.blade.php` - UI update untuk login
- `resources/views/auth/register.blade.php` - UI update untuk register
- `resources/views/dashboard/admin.blade.php` - Tombol tambah user
- `resources/views/layouts/app.blade.php` - Navigation update

## Keamanan

1. **Role-based access control**: Semua fitur admin dilindungi dengan pengecekan role
2. **Middleware protection**: Route register dilindungi dengan multiple middleware
3. **Session validation**: Login hanya valid untuk user dengan role admin
4. **CSRF protection**: Semua form dilindungi dengan CSRF token

## Testing

### Test Case 1: Admin Login
1. Akses `/login`
2. Login dengan akun admin
3. Seharusnya berhasil dan redirect ke dashboard

### Test Case 2: User Login (Should Fail)
1. Akses `/login`
2. Login dengan akun user biasa
3. Seharusnya ditolak dengan pesan error

### Test Case 3: Admin Register User
1. Login sebagai admin
2. Akses `/register` atau klik "Tambah User"
3. Seharusnya bisa mengakses dan membuat user baru

### Test Case 4: User Access Register (Should Fail)
1. Login sebagai user biasa
2. Coba akses `/register`
3. Seharusnya di-redirect ke dashboard dengan pesan error

## Catatan Penting

- Pastikan ada minimal satu user admin di database
- Role user harus berupa string 'admin' atau 'user' (case sensitive)
- Semua perubahan sudah terintegrasi dengan sistem yang ada
- Backup database sebelum testing untuk keamanan
