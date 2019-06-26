<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(function (){
    Route::post('/get-customer', 'Api\CustomersController@searchCustomer');
    Route::post('/post-physical-verification', 'Api\TransportController@physicalVerification');
    Route::post('/get-dms', 'Api\CustomersController@searchDms');
    Route::post('/add-lead', 'Api\CustomersController@addLead');
    Route::get('/get-customers', 'Api\CustomersController@getCustomers');
    Route::get('/all-vessels', 'Api\CustomersController@getAllVessels');
    Route::get('/get-vessel-detail/{id}', 'Api\CustomersController@getVesselDetail');
    Route::get('/all-leads','Api\CustomersController@getAllLeads');
    Route::get('/single-lead/{id}','Api\CustomersController@getSingleLead');
    Route::get('/single-lead/{id}','Api\CustomersController@getSingleLead');
});;
