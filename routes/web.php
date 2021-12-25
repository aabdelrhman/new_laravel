<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

   //                  ===============   Routes Front   =================
    Route::middleware(['web'])->group(function () {
        Route::get('/' , [FrontController::class , 'index'])->name('Front.index');
        Route::get('/shop' , [FrontController::class , 'shop'])->name('Front.shop');
        Route::get('/shop/brand/{id}' , [FrontController::class , 'shop_brand'])->name('Front.shop.brand');
        Route::get('/shop/section/{id}' , [FrontController::class , 'shop_section'])->name('Front.shop.section');
        Route::post('/shop' , [FrontController::class , 'shop_price_limit'])->name('Front.price.limit');
    });
    Route::middleware(['auth:web'])->group(function () {

    });
    //                  ===============  END Routes Front   =================
    //                  ===============  Routes Admin   =================
    Route::prefix('admin')->group(function () {
        // Routes login admin
        Route::middleware(['guest:admin'])->group(function () {
            Route::get('/login', [AdminLoginController::class , 'getLogin'])->name('getLogin');
            Route::post('/login', [AdminLoginController::class , 'adminLogin'])->name('adminLogin');
            // google login
            Route::get('/google_login/{driver}' , [AdminLoginController::class , 'redirect_login'])->name('login.google');
            Route::get('/callback' , [AdminLoginController::class , 'callback'])->name('callback.google');
        });
        Route::get('/logout', [AdminLoginController::class , 'logout'])->name('admin.logout');
        // route verification
        Route::get('account/verify/{token}', [AdminController::class, 'verifyAccount'])->name('user.verify');

        // ---------------------------------------------------------------------------------------------

        Route::middleware(['auth:admin' , 'is_verify_email'])->group(function () {
            // --------------- Routes auth admin -------------------------------
            Route::get('/' , [AdminLoginController::class , 'dashboard'])->name('Dashboard');
            Route::resource('section', SectionController::class);  // Routes Section
            // Route Export data sections Excel
            Route::get('export-excel-csv-file/{slug}', [SectionController::class, 'exportSectionExcl'])->name('export.sections');
            // Route import data section Excel
            Route::post('import-excel-csv-file', [SectionController::class, 'importSectionExcel'])->name('importSectionExcel');
            // Mark notification as read
            Route::get('markRead/{id}' , [SectionController::class , 'markRead'])->name('markRead');
            Route::resource('brand', BrandController::class);  // Routes Brand
            Route::resource('product' , ProductController::class);  // Routes Product
            // Route Show Product Images
            Route::get('image/{id}' , [ProductController::class , 'showImages'])->name('showImages');
            // Route Delete Product Images
            Route::get('imageDelete/{id}/{image_id}' , [ProductController::class , 'imageDelete'])->name('imageDelete');
            // Route add Product Images
            Route::Post('imageAdd/{id}' , [ProductController::class , 'imageAdd'])->name('imageAdd');
            // Route Archif Product
            Route::get('archif' , [ProductController::class , 'archif'])->name('product.archif');
            // Route Delete Product
            Route::get('delete_archif/{id}' , [ProductController::class , 'deleteArchif'])->name('deleteArchif');
            // Route restore Product
            Route::get('restore_archif/{id}' , [ProductController::class , 'restoreArchif'])->name('restoreArchif');
            Route::resource('roles' , RoleController::class);  // Routes Roles
            Route::resource('admins' , AdminController::class);  // Routes Admins
            Route::resource('offers' , OfferController::class);  // Routes Offers
            route::get('ajaxGetProduct/{section_id}/{brand_id}' , [OfferController::class , 'ajaxGetProduct']); //ajax get product route
        });
    });
   //                  ===============  End  Routes Admin   =================
});


