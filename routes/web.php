<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\GooglesController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\PostersController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CollapsesController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\AmazingsController;
use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Users\DashboardController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\ChatsController;
use App\Http\Controllers\Users\MarketsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Users\CartsController;
use App\Http\Controllers\Users\FavouritesController;
use App\Http\Controllers\Users\SocialShareButtonsController;
use App\Http\Controllers\Admin\DiscountsController;
use App\Http\Controllers\Admin\OrdersController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\EmailsController;
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

Route::get('/',[IndexController::class,'index'])->name('index');

Route::get('google',[GooglesController::class,'next'])->name('googles.next');
Route::get('google-callback',[GooglesController::class,'handle']);
Route::post('register-withgoogle',[GooglesController::class,'register'])->name('googles.register');
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth','admin']);

Route::post('comment',[IndexController::class,'comment'])->name('index.comment');
Route::post('reply/{comment}',[IndexController::class,'reply'])->name('index.reply');

// admin
Route::middleware(['auth','admin','verified'])->prefix('admin')->group(function () {
   Route::resource('categories',CategoriesController::class)->except('show');
   Route::resource('tags',TagsController::class)->except('show');
   Route::resource('posters',PostersController::class)->except('show');
   Route::resource('sliders',SlidersController::class)->except('show');
   Route::resource('brands',BrandsController::class)->except('show');
   Route::resource('products',ProductsController::class)->except('show');
   Route::resource('collapses',CollapsesController::class);
   Route::get('collapsess/{product}',[CollapsesController::class,'index2'])->name('collapses.index2');
   Route::post('ckeditor/upload-image',[CollapsesController::class,'upload'])->name('collapses.upload');
   Route::resource('comments',CommentsController::class)->except(['create','store']);
   Route::resource('amazings',AmazingsController::class)->except('show');
   Route::resource('offers',OffersController::class)->except('show');
   Route::resource('users-markets',\App\Http\Controllers\Admin\MarketsController::class)->except(['create','store','show']);
   Route::resource('users',UsersController::class)->except(['create','store','create','show']);
   Route::resource('discounts',DiscountsController::class)->except('show');
   Route::resource('orders',OrdersController::class)->except(['create','store','show']);

});
// fronts
Route::get('product/{product}',[IndexController::class,'product'])->name('fronts.product');
Route::get('category/{category}',[IndexController::class,'category'])->name('fronts.category');
Route::get('products',[IndexController::class,'products'])->name('fronts.products');
Route::get('tag/{tag}',[IndexController::class,'tag'])->name('fronts.tag');
Route::get('market/{market}',[IndexController::class,'market'])->name('index.market');

Route::middleware(['auth','verified'])->prefix('dashboard/user')->group(function (){
    //fronts
   Route::get('index',[DashboardController::class,'index'])->name('dashboard.index');
   // profile
    Route::get('profile',[ProfileController::class,'index'])->name('profile.index');
    Route::put('profile/update/{user}',[ProfileController::class,'update'])->name('profile.update');
    // chat
    Route::resource('chats',ChatsController::class)->except(['index','create','show','edit','update']);
    // markets
    Route::resource('markets',MarketsController::class)->except('show');
    Route::resource('user-products',\App\Http\Controllers\Users\ProductsController::class)->except('show');
    Route::resource('user-collapses',\App\Http\Controllers\Users\CollapsesController::class)->except(['index','show']);
    Route::get('user-collapsess/{product}',[\App\Http\Controllers\Users\CollapsesController::class,'index2'])->name('user-collapses.index2');
    Route::resource('user-orders',\App\Http\Controllers\Users\OrdersController::class)->except(['create','show','edit','update','destroy']);
});
Route::middleware(['auth','verified'])->group(function (){
    Route::get('cart',[IndexController::class,'cart'])->name('fronts.cart');
    Route::post('cart-add',[CartsController::class,'add'])->name('carts.add');
    Route::post('cart-update',[CartsController::class,'update'])->name('carts.update');
    Route::post('cart-remove',[CartsController::class,'remove'])->name('carts.remove');
    Route::post('cart-remove',[CartsController::class,'remove'])->name('carts.remove');
    Route::post('cart-clear',[CartsController::class,'clear'])->name('carts.clear');
    Route::resource('favourites',FavouritesController::class)->except(['create','show','edit','update']);
    Route::get('continue-shopping',[CartsController::class,'continue'])->name('carts.continue');
    // discount
    Route::post('check-discount',[IndexController::class,'checkDiscount'])->name('index.checkDiscount');
    // Zarinpal
    Route::post('zarinpal',[CartsController::class,'request_zarinpal'])->name('carts.request_zarinpal');
    Route::get('zarinpal-callback',[CartsController::class,'zarinpal_callback'])->name('carts.zarinpal_callback');
});
Route::resource('emails',EmailsController::class);
Route::get('send-email',[EmailsController::class,'page_sendemail'])->name('emails.page_sendemail');
Route::post('ckeditor/upload-image-email',[EmailsController::class,'upload_image'])->name('emails.upload_image');
Route::post('send-email',[EmailsController::class,'send_email'])->name('emails.send_email');
