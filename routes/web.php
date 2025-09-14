<?php

use App\Models\Adoption;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\OwnerAdoptionController;
use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\PetOwnerAdoptionController;

Route::get('admin', [AuthController::class, 'showLogin'])->name('login')->middleware('IsAuthenticated');
Route::post('admin/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('admin/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('admin/register', [AuthController::class, 'register'])->name('user.register');

Route::get('dashboard/index', [AuthController::class, 'dashboard'])->name('dashboard.show')->middleware(['auth']);

Route::resource('dashboard/users', UserController::class);

// ! Vet Routes
Route::get('dashboard/vets', [VetController::class, 'index'])->name('vets.index');
Route::get('dashboard/vets/edit/{id}', [VetController::class, 'edit'])->name('vets.edit');

Route::get('dashboard/shelter', [ShelterController::class, 'index'])->name('shelter.index');
Route::get('dashboard/shelter/edit/{id}', [ShelterController::class, 'edit'])->name('shelter.edit');

Route::resource('dashboard/appts', AppointmentController::class);
Route::get('/vet-slots/{vet}', [AppointmentController::class, 'vetSlots'])->name('vet.slots');

Route::resource('dashboard/shelter/adoption', AdoptionController::class);
Route::resource('dashboard/shelter/adoption-requests', AdoptionRequestController::class);

Route::post('adoption-requests/{id}/approve', [AdoptionRequestController::class, 'approve'])->name('adoption-requests.approve');
Route::post('adoption-requests/{id}/reject', [AdoptionRequestController::class, 'reject'])->name('adoption-requests.reject');

Route::get('adoption-requests/history', [AdoptionRequestController::class, 'history'])->name('adoption-requests.history');

// List available pets
Route::get('adoptions', [OwnerAdoptionController::class, 'index'])->name('adoptions.index');

// Submit an adoption request
Route::post('adoption-requests', [OwnerAdoptionController::class, 'store'])->name('adoption-requests.add');

// View their own requests
Route::get('adoption-requests/my', [OwnerAdoptionController::class, 'myRequests'])->name('adoption-requests.my');



//! Zain Health Record
Route::resource('dashboard/health-records', HealthRecordController::class);
Route::delete('/dashboard/health-records/pet/{id}', [HealthRecordController::class, 'petDestroy'])->name('health-records.pet.destroy');

//! Zain Products
// Route::get('dashboard/products', [ProductController::class, 'index'])->name('product.index');
// Route::post('dashboard/addToCart/{id}', [ProductController::class, 'add'])->name('product.add');
// Route::resource('products', ProductController::class);

Route::resource('dashboard/products', ProductController::class);
// Route::get('shop', [ProductController::class, 'shop'])->name('shop.index')->middleware('auth');

Route::resource('dashboard/orders', OrderController::class);


//! Zain Profile
Route::resource('profile', ProfileController::class);
Route::put('/profile/{id}/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.uploadAvatar');
Route::delete('/profile/{id}/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.removeAvatar');

Route::resource('dashboard/pets', PetController::class);

Route::middleware('auth')->group(function () {
  
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

   
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{orderItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});


Route::prefix('dashboard')->group(function () {
    Route::get('articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::post('articles', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('articles/{id}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('articles/{id}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('articles/{id}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
});



Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/articles', [PublicController::class, 'article'])->name('articles');
Route::get('/article/{id}', [PublicController::class, 'articleShow'])->name('article.show');


