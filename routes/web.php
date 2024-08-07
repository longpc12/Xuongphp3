<?php

use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\OderContrpller;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductCartController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Middleware\checkAdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\User\VnPayController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::controller(AuthController::class)->group(function () {
// Route::middleware('auth')->group(
//     function () {
//         Route::get('/home', function () {
//             return view('auth.home');
//         });

//         Route::middleware('auth.checkAdmin')->group(
//             function () {
//                 Route::get('/admin', function () {
//                     return 'đây là trang admin';
//                 });

//             }
//         );


//     }
// );

// //     Route::prefix('auth')
// //         ->name('auth.')
// //         ->group(function () {
// //             Route::get('showLogin',            'showFormLogin')->name('showLogin');
// //             Route::post('login',               'login')->name('login');
// //             Route::get('showFormregister',     'showFormRegister')->name('showFormregister');
// //             Route::post('register',            'register')->name('register');
// //             Route::post('logout',              'logout')->name('logout');
// //         });
// });




Auth::routes();


Route::get('/error', function () {
    return view('error.error-503');
})->name('error');


// Route ADMIN

// Route::middleware(['auth', 'auth.checkAdmin'])
//     ->prefix('admins')
//     ->as('admins.')
//     ->group(function () {

//         Route::get('/dashboard', function () {
//             return view('admins.dashboard');
//         })->name('dashboard');
//         Route::controller(CategoryController::class)->group(function () {
//             Route::prefix('/category')
//                 ->as('category.')
//                 ->group(function () {
//                     Route::get('/', 'index')->name('index');
//                     Route::get('create', 'create')->name('create');
//                     Route::post('store', 'store')->name('store');
//                     Route::get('show/{id}', 'show')->name('show');
//                     Route::get('{id}/edit', 'edit')->name('edit');
//                     Route::put('{id}/update', 'update')->name('update');
//                     Route::delete('{id}/destroy', 'destroy')->name('destroy');
//                 });
//         });


//         Route::controller(ProductController::class)->group(function () {
//             Route::prefix('/product')
//                 ->as('products.')
//                 ->group(function () {
//                     Route::get('/', 'index')->name('index');
//                     Route::get('create', 'create')->name('create');
//                     Route::post('store', 'store')->name('store');
//                     Route::get('show/{id}', 'show')->name('show');
//                     Route::get('{id}/edit', 'edit')->name('edit');
//                     Route::put('{id}/update', 'update')->name('update');
//                     Route::delete('{id}/destroy', 'destroy')->name('destroy');
//                 });
//         });
//     });

Route::middleware(['auth', 'auth.checkAdmin'])
    ->prefix('admins')
    ->as('admins.')
    ->group(function () {

        Route::view('/dashboard', 'admins.dashboard')->name('dashboard');

        Route::resource('category', CategoryController::class)
            ->names('category');

        Route::resource('product', ProductController::class)
            ->names('products');

        Route::controller(BillController::class)->group(function () {
            Route::prefix('/qlydonhangs')
                ->as('qlydonhangs.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::put('{id}/update', 'update')->name('update');
                    Route::get('{id}/show', 'show')->name('show');
                    Route::delete('{id}/destroy', 'destroy')->name('destroy');
                });
        });

        Route::get('/statistics/index', [StatisticController::class, 'index'])->name('statistics.index');


        Route::controller(AdminCommentController::class)->group(function () {
            Route::prefix('/comments')
                ->as('comments.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('{id}/show', 'show')->name('show');
                    Route::delete('{id}/destroy', 'destroy')->name('destroy');
                });
        });
    });


Route::prefix('user')
    ->as('user.')
    ->group(function () {
        // Routes cho UserProductController
        Route::controller(UserProductController::class)->group(function () {
            // Route::get('/', 'home')->name('product.home');
            Route::get('/product/dentail/{id}', 'dentailProduct')->name('product.detail');
        });
        Route::middleware('auth')
            ->group(function () {
                // Routes cho ProductCartController
                Route::controller(ProductCartController::class)->group(function () {
                    Route::get('/listcart', 'listCart')->name('product.cart');
                    Route::post('/addtocart', 'addToCart')->name('product.addToCart');
                    Route::post('/updatecart', 'updateCart')->name('product.updateCart');
                });


                Route::controller(OrderController::class)->group(function () {
                    Route::prefix('/oders')
                        ->as('oders.')
                        ->group(function () {
                            Route::get('/', 'index')->name('index');
                            Route::get('create', 'create')->name('create');
                            Route::post('store', 'store')->name('store');
                            Route::get('show/{id}', 'show')->name('show');
                            Route::put('{id}/update', 'update')->name('update');
                        });
                });
            });
    });
Route::get('/', [HomeController::class, 'index'])->name('home');





Route::prefix('admins')->group(function () {
    Route::get('/promotions', [PromotionController::class, 'index'])->name('admins.promotions.index');
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('admins.promotions.create');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('admins.promotions.store');
    Route::get('/promotions/{promotion}/edit', [PromotionController::class, 'edit'])->name('admins.promotions.edit');
    Route::put('/promotions/{promotion}', [PromotionController::class, 'update'])->name('admins.promotions.update');
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('admins.promotions.destroy');
});



// Route::post('/cart/update', [ProductCartController::class, 'updateCart'])->name('user.product.updateCart');
Route::post('/cart/apply-voucher', [ProductCartController::class, 'applyVoucher'])->name('user.product.applyVoucher');

// In your web.php (routes file)
Route::post('/vnpay-payment', [VnpayController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/vnpay-return', [VnpayController::class, 'vnpayReturn'])->name('vnpay.return');
// Route::get('/vnpay-return', [VnpayController::class, 'vnpayReturn'])->name('vnpay.return');



Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::get('/showComments/{id}', [CommentController::class, 'show'])->name('comments.show')->middleware('auth');

// Route::get('/shop', [ProductController::class, 'shop'])->name('user.shop');
// Route::get('/shop/category/{category}', [ProductController::class, 'shopByCategory'])->name('user.shop.category');
