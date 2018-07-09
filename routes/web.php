<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/')->middleware('redirectToCurrencies');
    Route::get('/currencies', function(\App\Services\CurrencyRepositoryInterface $currencyRepository) {
        $activeCurrencies = $currencyRepository->findAll();
        $currencies = [];
        foreach ($activeCurrencies as $currency) {
            $currencies[] = $currency;
        }

        return view('popular_currencies', compact('currencies'));
    })->name('admin_currency_list');
});

