# 🚂 Railway Deployment - HTTPS Mixed Content Fix

## 🔴 Problem
**Error**: `Blocked loading mixed active content "http://ujikomabang.up.railway.app/admin/login"`

**Cause**: Railway serves aplikasi via HTTPS, tapi Laravel masih generate URL dengan HTTP protocol, menyebabkan browser memblokir mixed content (HTTPS page loading HTTP resources).

---

## ✅ Solution Implemented

### 1. **Force HTTPS URLs in AppServiceProvider**
File: `app/Providers/AppServiceProvider.php`

```php
public function boot(): void
{
    // Force HTTPS in production (Railway, Heroku, etc.)
    if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }
    
    // Alternative: Force HTTPS if APP_URL uses https
    if (config('app.url') && str_starts_with(config('app.url'), 'https://')) {
        URL::forceScheme('https');
    }
}
```

### 2. **Update .env File**
```env
APP_URL=https://ujikomabang.up.railway.app
APP_ENV=production
```

---

## 🔧 Railway Environment Variables Setup

Di Railway Dashboard, pastikan environment variables berikut sudah di-set:

### Required Variables
```bash
APP_NAME=ujikomabang
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://ujikomabang.up.railway.app

# Database (Railway MySQL)
DB_CONNECTION=mysql
DB_HOST=YOUR_RAILWAY_MYSQL_HOST
DB_PORT=YOUR_RAILWAY_MYSQL_PORT
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=YOUR_RAILWAY_MYSQL_PASSWORD

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=.up.railway.app

# Cache
CACHE_STORE=database

# Queue
QUEUE_CONNECTION=database

# Filesystem
FILESYSTEM_DISK=public
```

### Important Notes
1. **APP_URL** harus menggunakan `https://` bukan `http://`
2. **APP_ENV** harus `production` agar force HTTPS aktif
3. **SESSION_DOMAIN** set ke `.up.railway.app` untuk cookie sharing
4. **APP_KEY** generate dengan `php artisan key:generate --show`

---

## 📋 Deployment Checklist

### Before Deploy
- [ ] Update `APP_URL` di Railway environment variables
- [ ] Set `APP_ENV=production`
- [ ] Generate dan set `APP_KEY`
- [ ] Verify database credentials
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Create storage link: `php artisan storage:link`
- [ ] Clear cache: `php artisan optimize:clear`

### After Deploy
- [ ] Test login dari browser (Chrome/Firefox)
- [ ] Test login dari mobile device
- [ ] Check browser console - tidak ada mixed content error
- [ ] Verify HTTPS lock icon di address bar
- [ ] Test all features (gallery, admin, etc.)

---

## 🧪 Testing Login

### Test dari berbagai devices:
1. **Desktop Browser**
   - Chrome: https://ujikomabang.up.railway.app/login
   - Firefox: https://ujikomabang.up.railway.app/login
   - Safari: https://ujikomabang.up.railway.app/login

2. **Mobile Browser**
   - Android Chrome
   - iOS Safari
   - Mobile Firefox

3. **Admin Login**
   - URL: https://ujikomabang.up.railway.app/admin/login
   - Email: admin@galeri-dzik.com
   - Password: admin123

4. **User Login**
   - URL: https://ujikomabang.up.railway.app/login
   - Email: user@galeri-dzik.com
   - Password: user123

---

## 🔍 Troubleshooting

### Issue: Still getting mixed content error
**Solution**:
```bash
# Clear application cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Rebuild
php artisan optimize
```

### Issue: Session not persisting
**Solution**:
```bash
# Check session table exists
php artisan migrate

# Verify SESSION_DRIVER=database in .env
# Clear browser cookies and try again
```

### Issue: CSRF token mismatch
**Solution**:
```env
# Update .env
SESSION_DOMAIN=.up.railway.app
SESSION_SECURE_COOKIE=true
```

### Issue: Login redirect to HTTP
**Solution**:
```php
// In app/Providers/AppServiceProvider.php
// Already implemented - force HTTPS scheme
URL::forceScheme('https');
```

---

## 🚀 Railway Specific Configuration

### Nixpacks Build
Railway menggunakan Nixpacks untuk build. Pastikan file berikut ada:

**nixpacks.toml** (optional, untuk custom build):
```toml
[phases.setup]
nixPkgs = ["php82", "php82Packages.composer", "nodejs_20"]

[phases.install]
cmds = [
    "composer install --no-dev --optimize-autoloader",
    "npm ci",
    "npm run build"
]

[phases.build]
cmds = [
    "php artisan config:cache",
    "php artisan route:cache",
    "php artisan view:cache"
]

[start]
cmd = "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"
```

### Procfile (alternative)
```
web: php artisan serve --host=0.0.0.0 --port=$PORT
```

---

## 🔐 Security Best Practices

### Production Environment
```env
APP_DEBUG=false
APP_ENV=production
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

### CORS Headers (if using API)
```php
// In config/cors.php
'supports_credentials' => true,
'allowed_origins' => ['https://ujikomabang.up.railway.app'],
```

---

## 📊 Monitoring

### Check Application Logs
```bash
# Railway CLI
railway logs

# Or in Railway Dashboard
# Go to Deployments > View Logs
```

### Common Log Patterns to Watch
- ✅ `URL::forceScheme('https')` - HTTPS forcing active
- ✅ `Session started` - Sessions working
- ❌ `CSRF token mismatch` - Check session config
- ❌ `Mixed content` - Check APP_URL

---

## 🎯 Expected Results

After implementing these fixes:

✅ **Login works** dari semua devices dan jaringan  
✅ **No mixed content errors** di browser console  
✅ **HTTPS lock icon** muncul di address bar  
✅ **Sessions persist** across requests  
✅ **CSRF protection** berfungsi dengan baik  
✅ **All routes** generate HTTPS URLs  

---

## 📞 Support

Jika masih ada masalah:

1. Check Railway logs: `railway logs`
2. Check browser console untuk error messages
3. Verify environment variables di Railway Dashboard
4. Test dengan `curl -I https://ujikomabang.up.railway.app` untuk check headers
5. Clear browser cache dan cookies

---

**Last Updated**: November 26, 2025  
**Status**: ✅ Fixed - Ready for Production
