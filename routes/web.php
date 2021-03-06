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

Route::redirect('/', '/products');

Route::resources([
  'products' => 'ProductController',
  'sellers' => 'SellerController',
  'sales' => 'SaleController'
]);

Route::get('/products-index-exception', 'ProductExceptionController@index')
  ->name('products.index.exception');

Route::get('/sellers-index-exception', 'SellerExceptionController@index')
  ->name('sellers.index.exception');

Route::get('/sales-index-exception', 'SaleExceptionController@index')
  ->name('sales.index.exception');
