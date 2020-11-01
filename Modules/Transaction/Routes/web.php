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

Route::prefix('transaction')->middleware('validate_session')->group(function() {
    Route::get('list/{status}', 'TransactionController@index')->name('transaction.list')->middleware('feature_control:transaction_list');
    Route::get('list/{status}/table', 'TransactionController@table')->name('transaction.table')->middleware('feature_control:transaction_list,transaction_update,transaction_delete');
    Route::get('create', 'TransactionController@create')->name('transaction.create')->middleware('feature_control:transaction_create');
    Route::post('store', 'TransactionController@store')->name('transaction.store')->middleware('feature_control:transaction_create');
    Route::get('edit/{id}', 'TransactionController@edit')->name('transaction.edit')->middleware('feature_control:transaction_update');
    Route::post('update/{id}', 'TransactionController@update')->name('transaction.update')->middleware('feature_control:transaction_update');
    Route::delete('delete/{id}', 'TransactionController@delete')->name('transaction.delete')->middleware('feature_control:transaction_delete');
    
    Route::get('assign-driver/{id}', 'TransactionController@assignDriver')->name('transaction.assign.driver')->middleware('feature_control:transaction_assign_driver');
    Route::post('confirm', 'TransactionController@confirmRent')->name('transaction.confirm')->middleware('feature_control:confirm_transaction');
    Route::post('cancel', 'TransactionController@cancelRent')->name('transaction.cancel')->middleware('feature_control:cancel_transaction');
    Route::post('mark', 'TransactionController@successRent')->name('transaction.mark')->middleware('feature_control:mark_transaction');
    Route::get('requirements', 'TransactionController@requirements')->name('transaction.requirements')->middleware('feature_control:transaction_requirements');
    Route::post('requirements', 'TransactionController@updateRequirements')->name('transaction.requirements.update')->middleware('feature_control:transaction_requirements');
    Route::get('notif', 'TransactionController@getNotif')->name('transaction.notif');
});
