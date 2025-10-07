# 🚀 Panduan API Postman - Galeri Sekolah SMKN 4 Bogor

## 📋 **Informasi Dasar**

- **Base URL**: `http://localhost/dzikriujikom/public/api`
- **Content-Type**: `application/json`
- **Authentication**: Session-based (Laravel default)

## 🔐 **Endpoint Authentication**

### 1. **Login Admin**
```
POST /auth/login
```

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
    "username": "admin",
    "password": "password123"
}
```

### 2. **Register User Baru (Admin Only)**
```
POST /auth/register
```

**Headers:**
```
Content-Type: application/json
Accept: application/json
Cookie: [session cookie dari login]
```

**Body (JSON):**
```json
{
    "name": "User Baru",
    "username": "userbaru",
    "email": "userbaru@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone": "08123456789",
    "address": "Jl. Contoh No. 123",
    "role": "user"
}
```

### 3. **Get Profile User**
```
GET /auth/profile
```

### 4. **Logout**
```
POST /auth/logout
```

## 📱 **Cara Setup di Postman**

### **Step 1: Buat Collection Baru**
1. Buka Postman
2. Klik "New" → "Collection"
3. Beri nama: "Galeri Sekolah API"

### **Step 2: Setup Environment Variables**
1. Klik "Environments" → "New"
2. Beri nama: "Local Development"
3. Tambahkan variable:
   - `base_url`: `http://localhost/dzikriujikom/public/api`
   - `session_cookie`: (akan diisi otomatis setelah login)

### **Step 3: Buat Request Login**
1. **Method**: POST
2. **URL**: `{{base_url}}/auth/login`
3. **Headers**:
   ```
   Content-Type: application/json
   Accept: application/json
   ```
4. **Body** (raw JSON):
   ```json
   {
       "username": "admin",
       "password": "password123"
   }
   ```

### **Step 4: Buat Request Register**
1. **Method**: POST
2. **URL**: `{{base_url}}/auth/register`
3. **Headers**:
   ```
   Content-Type: application/json
   Accept: application/json
   Cookie: {{session_cookie}}
   ```

## 🔧 **Troubleshooting**

### **Error 419: CSRF Token Mismatch**
- Pastikan sudah login terlebih dahulu
- Check session cookie masih valid

### **Error 401: Unauthorized**
- Pastikan sudah login
- Check session cookie tidak expired

### **Error 403: Forbidden**
- Pastikan user yang login adalah admin
- Check role user di database