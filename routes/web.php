<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\HeaderCategoryController as AdminHeaderCategoryController;
use App\Http\Controllers\Admin\SubHeaderCategoryController as AdminSubHeaderCategoryController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\PopupController as AdminPopupController;
use App\Http\Controllers\Admin\PromoController as AdminPromoController;
use App\Http\Controllers\Admin\MisiVisiController as AdminMisiVisiController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductGalleryController as AdminProductGalleryController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\TestimonyController as AdminTestimonyController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\MisiVisiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TentangKamiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use function Clue\StreamFilter\fun;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'details'])->name('categories-details');
Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [DetailController::class, 'add'])->name('detail-add');
Route::get('/tentang-kami', TentangKamiController::class)->name('tentangkami');
Route::get('/kontak', KontakController::class)->name('kontak');
Route::get('/visi-misi', MisiVisiController::class)->name('visi-misi');



Route::group(['middleware' => ['auth', 'notAdmin']], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
    Route::get('/success', [CartController::class, 'success'])->name('success');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])->middleware('storeOpen')->name('dashboard-product');
    Route::get('/dashboard/product/create', [DashboardProductController::class, 'create'])->middleware('storeOpen')->name('dashboard-product-create');
    Route::post('/dashboard/product', [DashboardProductController::class, 'store'])->middleware('storeOpen')->name('dashboard-product-store');
    Route::get('/dashboard/product/{id}', [DashboardProductController::class, 'details'])->middleware('storeOpen')->name('dashboard-product-details');
    Route::put('/dashboard/product/{product:id}', [DashboardProductController::class, 'update'])->middleware('storeOpen')->name('dashboard-product-update');
    Route::post('/dashboard/product/{product:id}/add-image', [DashboardProductController::class, 'addImage'])->middleware('storeOpen')->name('dashboard-product-update-add-image');
    Route::delete('/dashboard/product/photos/{id}', [DashboardProductController::class, 'deletephoto'])->middleware('storeOpen')->name('dashboard-product-delete-photo');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::get('/dashboard/transaction/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');
    Route::post('/dashboard/transaction/{id}', [DashboardTransactionController::class, 'update'])->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])->name('dashboard-settings-store')->middleware('storeOpen');
    Route::put('/dashboard/settings', [DashboardSettingController::class, 'storeupdate'])->name('dashboard-settings-store-update')->middleware('storeOpen');
    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::put('/dashboard/account', [DashboardSettingController::class, 'accountupdate'])->name('dashboard-settings-account-update');
});

Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');


Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::resources(
        [
            'header-category' => AdminHeaderCategoryController::class,
            'sub-header-category' => AdminSubHeaderCategoryController::class,
            'category' => AdminCategoryController::class,
            'user' => AdminUserController::class,
            'slider' => AdminSliderController::class,
            'product' => AdminProductController::class,
            'product-gallery' => AdminProductGalleryController::class,
            'transaction' => AdminTransactionController::class,
            'news' => AdminArticleController::class,
            'testimony' => AdminTestimonyController::class,
            'contact' => AdminContactController::class,
            'popup' => AdminPopupController::class,
            'visimisi' => AdminMisiVisiController::class,
            'about' => AdminAboutController::class,
            'promo' => AdminPromoController::class,
        ]
    );
    Route::put('/product/{id}/updateFavorite', [AdminProductController::class, 'updateFavorite'])->name('product.updateFavorite');
});

Route::get("all", SearchController::class)->name('search');

Route::get('berita', [ArticleController::class, 'index'])->name('berita.index');
Route::get('berita-details/{Article:slug}', [ArticleController::class, 'show'])->name('berita.show');

Route::get('artisan', function () {
    Artisan::call('storage:link');
});



Auth::routes();;
