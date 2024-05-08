<?php
use App\Http\Controllers\BankController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\DateSettings;
use Illuminate\Support\Facades\Route;

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
Route::get('/clear',function(){
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('clear-compiled');
    \Artisan::call('config:cache');
    dd("Cache is cleared");
});
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/', function () {
    return view('auth/login');
});
Route::middleware('auth')->group(function () {
Route::get('/dashboard', function () {
    return view('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/orders',[OrderController::class, 'view'])->name('orders.view');
Route::get('/new_order',[OrderController::class, 'add'])->name('orders.add');
Route::get('/order_edit/{id}',[OrderController::class, 'editOrder'])->name('edit_orders.view');
Route::put('/order_updating/{id}', [OrderController::class, 'updateOrder'])->name('order.update');
Route::match(['post'],'/update-payment/{id}', [OrderController::class,'updatePayment'])->name('update_paysar_payment.update');
Route::post('/store_order', [OrderController::class,'store'])->name('store_data.add');
Route::delete('/order/{id}', [OrderController::class,'delete_order'])->name('terminate_order.destroy');    
    Route::put('/password/update', [PasswordController::class, 'update'])->name('password.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
