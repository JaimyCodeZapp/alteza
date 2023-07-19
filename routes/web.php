<?php
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

use App\Http\Middleware\CheckRolePermissions;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::post('ratings/create', [RatingController::class, 'create'])->name('rating.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => '/admin','middleware' => 'permission:admin'], function () {
        Route::get('/', function () { return to_route('dashboard'); });
        Route::get('/dashboard', function () { 
            return Inertia::render('Admin/Dashboard'); 
        })->name('dashboard');

        Route::group(['middleware' => 'permission:read_users'],function(){
            Route::get('/users', [UserController::class, 'view'])->name('users');
            Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::group(['middleware' => 'permission:edit_users'],function(){
                Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
                Route::patch('/users/edit', [UserController::class, 'update'])->name('users.update');
            });
        });

        Route::group(['middleware' => 'permission:read_roles'],function(){
            Route::get('/roles', [RoleController::class, 'view'])->name('roles');
            Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::group(['middleware' => 'permission:edit_roles'],function(){
                Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
                Route::post('/roles/insert', [RoleController::class, 'insert'])->name('roles.insert');
                Route::patch('/roles/edit', [RoleController::class, 'update'])->name('roles.update');
                Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
            });
        });

        Route::group(['middleware' => 'permission:read_permissions'],function(){
            Route::get('/permissions', [PermissionController::class, 'view'])->name('permissions');
            Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::group(['middleware' => 'permission:edit_permissions'],function(){
                Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
                Route::post('/permissions/insert', [PermissionController::class, 'insert'])->name('permissions.insert');
                Route::patch('/permissions/edit', [PermissionController::class, 'update'])->name('permissions.update');
                Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
            });
        });

        Route::group(['middleware' => 'permission:read_products'],function(){
            Route::get('/products', [AdminProductController::class, 'view'])->name('products');
            Route::get('/products/edit/{id}', [AdminProductController::class, 'edit'])->name('products.edit');
            Route::group(['middleware' => 'permission:edit_products'],function(){
                Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
                Route::post('/products/insert', [AdminProductController::class, 'insert'])->name('products.insert');
                Route::post('/products/edit', [AdminProductController::class, 'update'])->name('products.update');
                Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');
            });
        });
    });

});

require __DIR__.'/auth.php';