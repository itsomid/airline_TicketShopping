<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TicketsController;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\PurchaseController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::post('purchase/{ticket}/ticket', [PurchaseController::class, 'purchaseTicket'])->name('purchase.ticket')->middleware('auth');


Route::get('tickets/filters', [TicketsController::class, 'filter'])->name('tickets.filter')->middleware('auth');
Route::resource('tickets', TicketsController::class)->middleware('auth');

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'customer']], function () {
    Route::get('/purchased_tickets', [UsersController::class, 'purchasedTickets'])->name('user.purchased_tickets');
    Route::get('/profile/{user}/edit', [UsersController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/{user}', [UsersController::class, 'updateProfile'])->name('profile.update');

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/customers_list', [AdminController::class, 'customersList'])->name('customers_list');

    Route::get('/customer/{user}/edit_credit', [AdminController::class, 'customerEditCredit'])->name('customer.edit.credit');
    Route::post('/customer/{user}/update_credit', [AdminController::class, 'customerUpdateCredit'])->name('customer.update.credit');
    Route::get('/tickets/canceled', [AdminController::class, 'adminCanceledTickets'])->name('tickets.canceled');
    Route::get('tickets/{ticket}/refund', [PurchaseController::class, 'refund'])->name('ticket.refund');
    Route::get('tickets/{ticket}/purchasers', [AdminController::class, 'ticketPurchasers'])->name('tickets.purchasers');

});
require __DIR__ . '/auth.php';
