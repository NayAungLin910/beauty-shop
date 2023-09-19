<?php

use App\Livewire\Account\Account;
use App\Livewire\Admin\Statistics;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Blog\CreateBlog;
use App\Livewire\Blog\EditBlog;
use App\Livewire\Blog\ViewBlog;
use App\Livewire\Cart\DammCart;
use App\Livewire\Home;
use App\Livewire\Invoice\ViewInvoice;
use App\Livewire\Product\CreateProduct;
use App\Livewire\Product\EditProduct;
use App\Livewire\Product\ViewProduct;
use App\Livewire\Profile;
use App\Livewire\Public\Blog\SingleBlog;
use App\Livewire\Public\Blog\ViewBlog as BlogViewBlog;
use App\Livewire\Public\Product\SingleProduct;
use App\Livewire\Public\Product\ViewProduct as ProductViewProduct;
use App\Livewire\Tag\Tag;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;

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

Route::get('/', Home::class)->name('home');

// for normal user only
Route::middleware(['authOnly'])->group(function () {

    // carts
    Route::prefix('carts')->as('carts.')->group(function () {
        // Route::get('/', ViewCart::class)->name('view');
        Route::get('/', DammCart::class)->name('view');
    });

    // invoices
    Route::prefix('invoices')->as('invoices.')->group(function () {
        Route::get('/', ViewInvoice::class)->name('view');
        Route::get('/download/{id}', function ($id) {

            $invoice = Invoice::where('id', $id)->with('orders')->first();

            $dompdf = new Dompdf();

            $dompdf->loadHtml(view('invoice.single-invoice', compact('invoice')));

            $dompdf->setPaper('A4', 'landscape');

            $dompdf->render();

            $dompdf->stream('invoice.pdf');
        })->name('download');
    });
});

Route::prefix('products')->as('products.')->group((function () {
    Route::get('/', ProductViewProduct::class)->name('view');
    Route::get('/pre-values/{tagId?}', ProductViewProduct::class)->name('view-pre');
    Route::get('/view/{id}', SingleProduct::class)->name('single');
}));

Route::prefix('blogs')->as('blogs.')->group((function () {
    Route::get('/view/{id}', SingleBlog::class)->name('single');
    Route::get('/', BlogViewBlog::class)->name('view');
}));

Route::middleware(['notAuth'])->prefix('auth')->as('auth.')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['userOrAdmin'])->prefix('user')->as('user.')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::post('/logout', function (Request $request) {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')->with('success', 'You have logged out successfully!');
        }
    })->name('logout');
});

Route::middleware(['adminOnly'])->prefix('admin/dashboard')->as('admin.')->group(function () {
    Route::get('/', Statistics::class)->name('statistics');

    // tags
    Route::get('/tags', Tag::class)->name('tags');

    // products
    Route::prefix('products')->as('products.')->group(function () {
        Route::get('/create', CreateProduct::class)->name('create');
        Route::get('/', ViewProduct::class)->name('view');
        Route::get('/edit/{id}', EditProduct::class)->name('edit');
    });

    // blogs
    Route::prefix('blogs')->as('blogs.')->group(function () {
        Route::get('/create', CreateBlog::class)->name('create');
        Route::get('/', ViewBlog::class)->name('view');
        Route::get('/edit/{id}', EditBlog::class)->name('edit');
    });

    // accounts
    Route::get('/accounts', Account::class)->name('accounts');
});
