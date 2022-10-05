
<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Manager\AdminHRController;
use App\Http\Controllers\Admin\Manager\AdminCustomerController;
use App\Http\Controllers\Admin\Manager\AdminProductController;
use App\Http\Controllers\Admin\Manager\AdminSaleOffController;
use App\Http\Controllers\Admin\Manager\AdminCategoryController;


Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])->name('admin.login');
Route::match(['post'], '/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->group(function () {
    Route::prefix('')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('admin.home');
        Route::get('', function () {
            return redirect()->route('admin.home');
        });

        // Manage Admin Account route
        Route::resource('hr', AdminHrController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.hr',
                'create' => 'admin.hr.create',
                'store' => 'admin.hr.store',
                'edit' => 'admin.hr.edit',
                'update' => 'admin.hr.update',
                'destroy' => 'admin.hr.destroy'
            ]);
            Route::get('saleoff/search', [AdminProductController::class, 'search'])->name('admin.saleoff.search');

        // Manage User Account route
        Route::resource('customer', AdminCustomerController::class)
            ->except(['show', 'create', 'store'])
            ->names([
                'index' => 'admin.customer',
                'edit' => 'admin.customer.edit',
                'update' => 'admin.customer.update',
                'destroy' => 'admin.customer.destroy'
            ]);

        // Manage SaleOff route
        Route::resource('saleoff', AdminSaleOffController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.saleoff',
                'create' => 'admin.saleoff.create',
                'store' => 'admin.saleoff.store',
                'edit' => 'admin.saleoff.edit',
                'update' => 'admin.saleoff.update',
                'destroy' => 'admin.saleoff.destroy'
            ]);
            Route::get('saleoff/search', [AdminProductController::class, 'search'])->name('admin.saleoff.search');

        Route::resource('product', AdminProductController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.product',
                'create' => 'admin.product.create',
                'store' => 'admin.product.store',
                'edit' => 'admin.product.edit',
                'update' => 'admin.product.update',
                'destroy' => 'admin.product.destroy'
            ]);
        Route::get('product/search', [AdminProductController::class, 'search'])->name('admin.product.search');

        Route::resource('category', AdminCategoryController::class)
            ->except(['show'])
            ->names([
                'index' => 'admin.category',
                'create' => 'admin.category.create',
                'store' => 'admin.category.store',
                'edit' => 'admin.category.edit',
                'update' => 'admin.category.update',
                'destroy' => 'admin.category.destroy'
            ]);
    });
});
