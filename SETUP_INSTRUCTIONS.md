# 🚀 SMKN 4 Bogor - Setup Instructions

## 📋 **Requirements:**
- PHP 8.2+ 
- Composer
- Node.js & NPM
- SQLite (default) atau MySQL/PostgreSQL

## 🔧 **Setup Steps:**

### 1. **Install Dependencies:**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 2. **Environment Setup:**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. **Database Setup:**
```bash
# Run migrations (creates tables)
php artisan migrate

# Run seeders (populates with sample data)
php artisan db:seed
```

### 4. **Storage Setup:**
```bash
# Create storage link
php artisan storage:link
```

### 5. **Build Assets:**
```bash
# Build frontend assets
npm run build
```

### 6. **Start Servers:**
```bash
# Terminal 1: Start Laravel server
php artisan serve --port=9000

# Terminal 2: Start Vite dev server (optional for development)
npm run dev -- --port=9001
```

## 🌐 **Access URLs:**
- **Public Site**: http://localhost:9000
- **Admin Login**: http://localhost:9000/admin/login
- **Dashboard**: http://localhost:9000/dashboard

## 👤 **Default Admin Account:**
- **Username**: admin
- **Password**: password123

## 📁 **Project Structure:**
```
├── app/Http/Controllers/     # Controllers
├── app/Models/              # Eloquent Models
├── database/migrations/     # Database migrations
├── database/seeders/        # Database seeders
├── resources/views/         # Blade templates
├── routes/                  # Route definitions
└── public/                  # Public assets
```

## 🎯 **Features:**
- ✅ **Gallery Management** (CRUD)
- ✅ **Category Management** (CRUD)
- ✅ **User Management** (Admin only)
- ✅ **Jurusan Management** (CRUD)
- ✅ **Fasilitas Management** (CRUD)
- ✅ **Prestasi Management** (CRUD)
- ✅ **Public Pages** (Dynamic content)
- ✅ **Admin Dashboard** (Statistics & Quick actions)
- ✅ **Responsive Design** (Mobile-first)

## 🔧 **Troubleshooting:**

### **Port Already in Use:**
```bash
# Check what's using port 9000
lsof -i :9000

# Kill process if needed
kill -9 <PID>

# Or use different port
php artisan serve --port=9001
```

### **Database Issues:**
```bash
# Reset database
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status
```

### **Permission Issues:**
```bash
# Fix storage permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

## 📞 **Support:**
Jika ada masalah, cek:
1. PHP version: `php -v`
2. Composer: `composer -V`
3. Node.js: `node -v`
4. Database connection: `php artisan migrate:status`

---
**Happy Coding! 🎉**
