<?php

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

Route::get('/', 'DashboardController@index')->name('root');

Route::resource('broker-accounts', 'BrokerAccountController');
Route::resource('user-accounts', 'UserAccountController');
Route::resource('quotes', 'QuoteController')
    ->only(['index']);
Route::resource('records', 'RecordController')
    ->except(['edit', 'update']);
Route::resource('off-days', 'OffDayController')
    ->except(['show']);
Route::resource('deposits', 'DepositController')
    ->except(['show', 'edit', 'update']);
Route::resource('withdraws', 'WithdrawController')
    ->except(['show', 'edit', 'update']);