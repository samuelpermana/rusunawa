<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Admin\TipeKamarController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\SewaController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Mahasiswa\UserController;
use App\Http\Controllers\Mahasiswa\CekKamarController;
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

Route::get('/', [LandingPageController::class, 'dashboard']);
Route::get('/choose-auth', function () {
    return view('choose_auth');
})->name('choose_auth');

Route::get('/cek-kamar', [CekKamarController::class, 'index'])->name('cek_kamars');
Route::get('register/{kamarId}', [CekKamarController::class, 'showRegistrationForm'])->name('register');
Route::post('register/{kamarId}', [CekKamarController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware('auth', 'role:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/mahasiswa', [UserManageController::class, 'index'])->name('admin.mahasiswa.index');
    Route::get('/mahasiswa/create', [UserManageController::class, 'create'])->name('admin.mahasiswa.create');
    Route::post('/mahasiswa', [UserManageController::class, 'store'])->name('admin.mahasiswa.store');
    Route::get('/mahasiswa/{mahasiswa}/edit', [UserManageController::class, 'edit'])->name('admin.mahasiswa.edit');
    Route::put('/mahasiswa/{mahasiswa}', [UserManageController::class, 'update'])->name('admin.mahasiswa.update');    
    Route::delete('/mahasiswa/{mahasiswa}', [UserManageController::class, 'destroy'])->name('admin.mahasiswa.destroy');

    Route::get('/tipe-kamar', [TipeKamarController::class, 'index'])->name('admin.tipe_kamar.index');
    Route::get('/tipe-kamar/create', [TipeKamarController::class, 'create'])->name('admin.tipe_kamar.create');
    Route::post('/tipe-kamar', [TipeKamarController::class, 'store'])->name('admin.tipe_kamar.store');
    Route::get('/tipe-kamar/{tipe_kamar}/edit', [TipeKamarController::class, 'edit'])->name('admin.tipe_kamar.edit');
    Route::put('/tipe-kamar/{tipe_kamar}', [TipeKamarController::class, 'update'])->name('admin.tipe_kamar.update');    
    Route::delete('/tipe-kamar/{tipe_kamar}', [TipeKamarController::class, 'destroy'])->name('admin.tipe_kamar.destroy');

    Route::get('/kamar', [KamarController::class, 'index'])->name('admin.kamar.index');
    Route::get('/kamar/create', [KamarController::class, 'create'])->name('admin.kamar.create');
    Route::post('/kamar', [KamarController::class, 'store'])->name('admin.kamar.store');
    Route::get('/kamar/{kamar}/edit', [KamarController::class, 'edit'])->name('admin.kamar.edit');
    Route::put('/kamar/{kamar}', [KamarController::class, 'update'])->name('admin.kamar.update');    
    Route::delete('/kamar/{kamar}', [KamarController::class, 'destroy'])->name('admin.kamar.destroy');
    
    Route::get('sewa', [SewaController::class, 'index'])->name('admin.sewa.index');
    Route::get('sewa/{id}/edit', [SewaController::class, 'edit'])->name('admin.sewa.edit');
    Route::put('sewa/{id}', [SewaController::class, 'update'])->name('admin.sewa.update');
    Route::post('sewa/{id}/send-notification', [SewaController::class, 'sendNotification'])->name('admin.sewa.send_notification');
    Route::get('sewa/{sewa}/notifications', [SewaController::class, 'showNotifications'])->name('admin.sewa.notifications');
    Route::delete('/sewa/{sewa}', [SewaController::class, 'destroy'])->name('admin.sewa.destroy');
    
    Route::delete('/notifications/{notificationId}', [SewaController::class, 'deleteNotifications'])->name('admin.notifications.delete');

    Route::post('/sewa/create', [AdminController::class, 'createSewa'])->name('admin.sewa.create');

    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('admin.bookings.show');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('admin.bookings.edit');
    Route::post('/bookings/{id}/update', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::post('/bookings/{id}/delete', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');

    Route::get('payments', [PaymentController::class, 'index'])->name('admin.payments.index');
    Route::post('payments/{id}/update-status', [PaymentController::class, 'updateStatus'])->name('admin.payments.updateStatus');
    Route::delete('/payment/{payment}', [PaymentController::class, 'destroy'])->name('admin.payment.destroy');

}); 

Route::middleware('auth', 'role:user')->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    // Route for uploading payment and agreement proof
    Route::post('/upload-payment', [UserController::class, 'uploadPayment'])->name('upload.payment');
    Route::post('/upload-payment-proof', [UserController::class, 'uploadPaymentProof'])->name('user.uploadPaymentProof');

    // Route for deleting user account
    Route::post('/delete-account', [UserController::class, 'deleteAccount'])->name('delete.account');
});

