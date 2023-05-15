<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerFeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserListController;
use App\Models\Category;
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

Route::middleware('admin_auth')->group(function () {
    Route::get('/', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    // Admin
    Route::middleware('admin_auth')->group(function () {
        // Category
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'listPage'])->name('category#listPage');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('editPage/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
            Route::post('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
        });

        // Admin account
        Route::prefix('adminPanel')->group(function () {
            Route::get('changePassword', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password', [AdminController::class, 'passwordChange'])->name('admin#passwordChange');
            Route::get('accountInfo', [AdminController::class, 'info'])->name('admin#info');
            Route::get('edit', [AdminController::class, 'adminEdit'])->name('admin#edit');
            Route::post('updateAccountInfo/{id}', [AdminController::class, 'updateAccountInfo'])->name('admin#updateAccount');
            Route::get('adminsList', [AdminController::class, 'adminList'])->name('admin#adminsList');
            Route::get('admins/delete/{id}', [AdminController::class, 'adminsDelete'])->name('admins#delete');
            Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('role/{id}', [AdminController::class, 'role'])->name('admin#role');
            Route::get('user/list', [UserListController::class, 'userList'])->name('admin#userList');
            Route::get('user/list/delete/{id}', [UserListController::class, 'userlistDelete'])->name('userList#delete');
            Route::get('user/list/edit/{id}', [UserListController::class, 'userListEdit'])->name('userList#edit');
            Route::post('user/list/update/{id}', [UserListController::class, 'userListUpdate'])->name('userList#Update');
            Route::get('customer/message', [CustomerFeedbackController::class, 'customerFeedback'])->name('customer#feedback');
            Route::get('customer/feedback/view/{id}', [CustomerFeedbackController::class, 'feedbackView'])->name('feedback#view');
        });

        // Menu
        Route::prefix('menu')->group(function () {
            Route::get('list', [ProductController::class, 'menuList'])->name('menu#list');
            Route::get('createPage', [ProductController::class, 'createPage'])->name('menu#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('menu#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('menu#delete');
            Route::get('details/{id}', [ProductController::class, 'details'])->name('menu#details');
            Route::get('editPage/{id}', [ProductController::class, 'editPage'])->name('menu#editPage');
            Route::post('update', [ProductController::class, 'update'])->name('menu#update');
            Route::get('order/list', [OrderListController::class, 'orderList'])->name('menu#orderList');
        });

        // order list view
        Route::prefix('products')->group(function() {
            Route::get('order/list/{orderCode}', [OrderListController::class, 'orderListInfo'])->name('products#info');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('admin/order/changeStatus', [AjaxController::class, 'adminOrderChangeStatus'])->name('ajax#adminOrderChangeStatus');
            Route::get('adminPanel/userList', [AjaxController::class, 'adminPanelUserList'])->name('ajax#adminPanelUserList');
        });
    });

    Route::middleware('user_auth')->group(function () {
        // User
        Route::prefix('user')->group(function () {
            Route::get('home', [UserController::class, 'userHomePage'])->name('user#homePage');
            Route::get('account/profile', [UserController::class, 'userProfile'])->name('user#userProfile');
            Route::get('account/editProfile', [UserController::class, 'editUserProfile'])->name('user#editProfile');
            Route::post('edit/{id}', [UserController::class, 'edit'])->name('user#edit');
            Route::get('account/changePassword', [UserController::class, 'changePasswordPage'])->name('user#changePassword');
            Route::post('account/changePassword', [UserController::class, 'changePassword'])->name('user#userChangePassword');
            Route::get('order/history', [OrderController::class, 'orderHistory'])->name('user#orderHistory');
            Route::get('contactUs', [ContactController::class, 'contactUs'])->name('user#contactUs');
            Route::post('user/contact', [ContactController::class, 'contact'])->name('user#contact');
        });

        // detail and filter
        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'detailPage'])->name('pizza#detailPage');
            Route::get('filter/{id}', [UserController::class, 'filter'])->name('pizza#filter');
            Route::get('cartPage', [CartController::class, 'cartPage'])->name('pizza#cartPage');
        });

        // ajax
        Route::prefix('ajax')->group(function () {
            Route::get('getData', [AjaxController::class, 'getData'])->name('ajax#getdata');
            Route::get('cartData', [AjaxController::class, 'cartData'])->name('ajax#cartdata');
            Route::get('orderList', [AjaxController::class, 'orderList'])->name('ajax#orderList');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('order/clear', [AjaxController::class, 'orderClear'])->name('ajax#orderClear');
            Route::get('all/clear', [AjaxController::class, 'allClear'])->name('ajax#cartAllClear');
            Route::get('pizza/view', [AjaxController::class, 'pizzaView'])->name('pizza#view');
        });
    });
});

// For error

// for clear cache command => php artisan config:clear
// php artisan cache:clear
// php artisan config:cache * 3
// for vendor => delete vendor and install again
// command => composer install
// composer update
