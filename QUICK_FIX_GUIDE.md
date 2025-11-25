# ⚡ Quick Fix Guide - Mixed Content Error

## 🎯 Problem
Login tidak bisa dari devices lain karena mixed content error:
```
Blocked loading mixed active content "http://ujikomabang.up.railway.app/admin/login"
```

## ✅ Solution (3 Steps)

### Step 1: Update Railway Environment Variables
Di Railway Dashboard → Variables, set:
```bash
APP_URL=https://ujikomabang.up.railway.app
APP_ENV=production
```

### Step 2: Deploy Ulang
Code sudah di-fix di 3 files:
1. ✅ `app/Providers/AppServiceProvider.php` - Force HTTPS URLs
2. ✅ `bootstrap/app.php` - Trust proxies
3. ✅ `.env` - Updated APP_URL

Push ke Railway:
```bash
git add .
git commit -m "Fix: Force HTTPS for Railway deployment"
git push railway main
```

### Step 3: Clear Cache di Railway
Setelah deploy selesai, jalankan di Railway console:
```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
```

## 🧪 Test Login

### Admin Login
- URL: https://ujikomabang.up.railway.app/admin/login
- Email: admin@galeri-dzik.com
- Password: admin123

### User Login
- URL: https://ujikomabang.up.railway.app/login
- Email: user@galeri-dzik.com
- Password: user123

## ✅ Expected Result
- ✅ No mixed content error
- ✅ Login works dari semua devices
- ✅ HTTPS lock icon muncul
- ✅ Session persist

## 🔧 If Still Not Working

1. **Clear browser cache** dan cookies
2. **Check Railway logs**: `railway logs`
3. **Verify environment variables** di Railway Dashboard
4. **Test dengan incognito mode**

---

**Status**: ✅ Fixed  
**Files Changed**: 3  
**Deploy Required**: Yes
