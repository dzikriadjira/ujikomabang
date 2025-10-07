# Setup Foto SMKN 4 Bogor

## Status Saat Ini: ✅ GAMBAR SUDAH MUNCUL
- Homepage menggunakan foto default dari Unsplash
- Carousel berfungsi normal dengan 3 slide
- Background tidak lagi abu-abu

## Untuk Menggunakan Foto Asli SMKN 4 Bogor:

### 1. Siapkan 3 Foto:
- **`smkn4bogor-lapangan.jpg`** - Foto lapangan basket biru-kuning
- **`smkn4bogor-upacara.jpg`** - Foto upacara bendera  
- **`smkn4bogor-gedung.jpg`** - Foto gedung sekolah

### 2. Simpan Foto di Folder Ini:
- Pastikan nama file sama persis
- Format: JPG/JPEG
- Resolusi: Minimal 1920x1080

### 3. Ganti JavaScript di `resources/views/home.blade.php`:
```javascript
// Ganti dari:
background: 'https://images.unsplash.com/...'

// Menjadi:
background: '{{ asset("images/smkn4bogor-lapangan.jpg") }}'
background: '{{ asset("images/smkn4bogor-upacara.jpg") }}'
background: '{{ asset("images/smkn4bogor-gedung.jpg") }}'
```

### 4. Setelah Foto Diganti:
- Refresh halaman homepage
- Background akan otomatis menggunakan foto asli SMKN 4 Bogor
- Carousel tetap berfungsi normal

## Keuntungan Setup Ini:
- ✅ **Saat ini**: Gambar sudah muncul (tidak abu-abu)
- ✅ **Nanti**: Bisa ganti ke foto asli SMKN 4 Bogor
- ✅ **Carousel**: Selalu berfungsi dengan baik
- ✅ **Responsive**: Bekerja di semua ukuran layar

## Troubleshooting:
- Jika foto asli tidak muncul: periksa nama file dan format
- Jika background abu-abu: gunakan foto default dulu
- Jika carousel error: refresh halaman dengan Ctrl+F5
