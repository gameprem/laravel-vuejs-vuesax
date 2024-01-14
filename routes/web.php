<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function (Request $request) {
    // print($request->user()->getRoleNames());
    // $users = User::role('admin')->get();
    // print($users);
    // print($request->user()->getPermissionsViaRoles());
    $getRoles = new Collection($request->user()->getRoleNames());
    $role = 'Admin';
    if ($getRoles->contains($role)) {
        return Inertia::render('Admin/Dashboard');
    }else{
        return Inertia::render('Dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/manage-products', function () {
    return Inertia::render('ManageProducts');
})->middleware(['auth', 'verified'])->name('manage-products');

Route::get('/summary-of-sales', function () {
    return Inertia::render('SummaryOfSales');
})->middleware(['auth', 'verified'])->name('summary-of-sales');

Route::get('/bill-history', function () {
    return Inertia::render('BillHistory');
})->middleware(['auth', 'verified'])->name('bill-history');

Route::middleware('auth')->group(function () {
    Route::post('/dashboard', [DashboardController::class, 'create'])->name('dashboard.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
