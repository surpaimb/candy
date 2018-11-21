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

/* Home */
Route::get('/', 'HomeController@index')->name('home');
Route::post('/vat', 'HomeController@updateVat')->name('vat');
Route::post('/currency', 'HomeController@updateCurrency')->name('currency');
Route::post('/language', 'HomeController@updateLanguage')->name('language');

/* Auth */
Route::get('register', 'Auth\RegisterController@index')->name('register')->middleware('guest');
Route::post('register', 'Auth\RegisterController@register')->middleware('guest');
Route::get('login', 'Auth\LoginController@index')->name('login')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->middleware('guest');
Route::get('forgotten-password', 'Auth\ForgottenPasswordController@index')->name('forgotten-password')->middleware('guest');
Route::post('forgotten-password', 'Auth\ForgottenPasswordController@sendReset')->middleware('guest');
Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@index')->middleware('guest');
Route::post('password/reset', 'Auth\ResetPasswordController@resetPassword')->middleware('guest');

/* Auth Logged In*/
Route::get('logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth.api');
Route::get('account', 'Auth\AccountController@index')->name('account-dashboard')->middleware('auth.api');
Route::get('account/details', 'Auth\AccountController@showDetails')->name('account-details')->middleware('auth.api');
Route::post('account/details', 'Auth\AccountController@postDetails')->name('post-account-details')->middleware('auth.api');
Route::get('account/orders', 'Auth\AccountController@showOrders')->name('account-orders')->middleware('auth.api');
Route::get('account/order/{id}', 'Auth\AccountController@showOrderDetails')->name('account-order-details')->middleware('auth.api');
Route::get('account/password', 'Auth\AccountController@showPassword')->name('showa-account-password')->middleware('auth.api');
Route::post('account/password', 'Auth\AccountController@changePassword')->name('account-password')->middleware('auth.api');

/* Basket */
Route::get('basket', 'BasketController@show')->name('show-basket');
Route::get('basket/get', 'BasketController@get')->name('get-basket');
Route::post('basket/update', 'BasketController@update')->name('update-basket');
Route::post('basket/discount', 'BasketController@discount')->name('discount-basket');
Route::post('basket/remove-discount', 'BasketController@removeDiscount')->name('remove-discount-basket');

/* Checkout */
Route::get('checkout', 'CheckoutController@show')->name('show-checkout');
Route::post('checkout/delivery-address', 'CheckoutController@postDeliveryAddress')->name('post-delivery-address');
Route::post('checkout/delivery-method', 'CheckoutController@postDeliveryMethod')->name('post-delivery-method');
Route::post('checkout/contact-details', 'CheckoutController@postContactDetails')->name('post-contact-details');
Route::post('checkout/billing-address', 'CheckoutController@postBillingAddress')->name('post-billing-address');
Route::post('checkout/process', 'CheckoutController@proccessOrder')->name('proccess-order');
Route::get('checkout/confirmation', 'CheckoutController@showConfirmation')->name('show-confirmation');
Route::get('checkout/payment-types', 'CheckoutController@getPaymentTypes')->name('payment-types');

/* Categories */
Route::resource('categories', 'CategoryController');

/* Products */
Route::get('product/{slug}', 'ProductController@show')->name('get-product');

/* Search */
Route::post('search', 'SearchController@search');
Route::get('search', 'SearchController@index');

/* Contact */
Route::post('contact/enquiry', 'ContactController@enquiry');
Route::post('contact/feedback', 'ContactController@feedback');

/* Tests */
Route::get('test', 'TestController@getIndex');
Route::get('test2', 'TestController@getIndex2');
Route::get('sendconfirmation', 'TestController@sendconfirmation');

Route::post('trade-request', 'ContactController@trade');


/* Wildcard (KEEP AT END) */
Route::get('{view}', 'PageController@index');
Route::get('tips-advice/{view}', 'PageController@tipsAdvice');