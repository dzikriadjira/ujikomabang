
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Removed duplicate public jurusan route to avoid two Jurusan pages
// Route::get('/jurusan-public', [App\Http\Controllers\PublicJurusanController::class, 'index'])->name('public.jurusan');

// Public routes
Route::get('/', function () {
    return view('home');
});

// Public jurusan route
Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');

// Profil routes
Route::get('/profil/fasilitas', [App\Http\Controllers\PublicFasilitasController::class, 'index'])->name('profil.fasilitas');
Route::get('/profil/prestasi', [App\Http\Controllers\PublicPrestasiController::class, 'index'])->name('profil.prestasi');

// Public gallery routes (can be accessed without login)
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/search', [GalleryController::class, 'search'])->name('gallery.search');
Route::get('/gallery/{gallery}', [GalleryController::class, 'show'])->whereNumber('gallery')->name('gallery.show');

// Public interaction routes (like, dislike, comment - no login required)
Route::post('/gallery/{gallery}/like', [LikeController::class, 'toggleLike'])->whereNumber('gallery')->name('gallery.like');
Route::post('/gallery/{gallery}/dislike', [LikeController::class, 'toggleDislike'])->whereNumber('gallery')->name('gallery.dislike');
Route::post('/gallery/{gallery}/comment', [CommentController::class, 'store'])->whereNumber('gallery')->name('comment.store');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->whereNumber('comment')->name('comment.destroy');

// Authentication routes (Admin only - hidden from public)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile routes
    Route::get('/profile', function () {
        return view('admin.profile.show', ['user' => auth()->user()]);
    })->name('profile');
    
    // Alias for backward compatibility
    Route::get('/profile/show', function () {
        return redirect()->route('profile');
    })->name('profile.show');
    
    // Admin-only registration routes
    Route::middleware(['admin.only'])->group(function () {
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    });
    
    // Gallery management routes (require authentication)
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'edit'])->whereNumber('gallery')->name('gallery.edit');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->whereNumber('gallery')->name('gallery.update');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->whereNumber('gallery')->name('gallery.destroy');
    Route::post('/gallery/{gallery}/toggle-featured', [GalleryController::class, 'toggleFeatured'])->whereNumber('gallery')->name('gallery.toggle-featured');
});

// Admin routes (require admin role)
Route::middleware(['auth', 'admin'])->group(function () {
    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names('admin.users');
    
    // Interactions Management
    Route::get('/admin/interactions', [\App\Http\Controllers\Admin\InteractionController::class, 'index'])->name('admin.interactions.index');
    Route::get('/admin/interactions/{gallery}', [\App\Http\Controllers\Admin\InteractionController::class, 'show'])->name('admin.interactions.show');
    
    // Categories management
    Route::resource('categories', CategoryController::class);
    Route::post('/categories/{category}/toggle-active', [CategoryController::class, 'toggleActive'])->whereNumber('category')->name('categories.toggle-active');
    
    // Category statistics
    Route::get('/categories/stats', '\App\Http\Controllers\CategoryStatsController')->name('categories.stats');
    
    // Jurusan management
    Route::resource('admin/jurusan', App\Http\Controllers\Admin\JurusanController::class)->names([
        'index' => 'admin.jurusan.index',
        'create' => 'admin.jurusan.create',
        'store' => 'admin.jurusan.store',
        'show' => 'admin.jurusan.show',
        'edit' => 'admin.jurusan.edit',
        'update' => 'admin.jurusan.update',
        'destroy' => 'admin.jurusan.destroy',
    ]);
    
    // Fasilitas management
    Route::resource('admin/fasilitas', App\Http\Controllers\Admin\FasilitasController::class)->names([
        'index' => 'admin.fasilitas.index',
        'create' => 'admin.fasilitas.create',
        'store' => 'admin.fasilitas.store',
        'show' => 'admin.fasilitas.show',
        'edit' => 'admin.fasilitas.edit',
        'update' => 'admin.fasilitas.update',
        'destroy' => 'admin.fasilitas.destroy',
    ]);
    
    // Prestasi management
    Route::resource('admin/prestasi', App\Http\Controllers\Admin\PrestasiController::class)->names([
        'index' => 'admin.prestasi.index',
        'create' => 'admin.prestasi.create',
        'store' => 'admin.prestasi.store',
        'show' => 'admin.prestasi.show',
        'edit' => 'admin.prestasi.edit',
        'update' => 'admin.prestasi.update',
        'destroy' => 'admin.prestasi.destroy',
    ]);
});
