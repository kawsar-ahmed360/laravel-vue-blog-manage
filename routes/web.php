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
    return view('site.master');
});





route::get('/active-category-view', 'FontendController@ShowACtiveCategory');
route::post('/main_search', 'FontendController@SearchMain');
route::get('/active-brand-view', 'FontendController@ShowACtiveBrand');
route::get('/all-post-client-site', 'FontendController@ShowAllPostClientSite');
route::get('single_post/{id}', 'FontendController@SinglePost');
route::get('category_wise_post_view/{id}', 'FontendController@CategoryWisePostView');
route::get('brand_wise_post_view/{id}', 'FontendController@BrandWisePostView');

// Route::get('/home{anypath}', 'HomeController@index')->where('path', '.*');

// Route::get('/{vue_capture?}', function () {
//     return view('site.master');
// })->where('path', '.*');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::prefix('admin')->middleware('auth')->group(function () {

    route::post('/category-store', 'admin\CategoryManageController@CategoryStore')->name('CategoryStore');
    route::get('/category-index', 'admin\CategoryManageController@CategoryIndex')->name('CategoryIndex');
    route::get('/category-delete/{id}', 'admin\CategoryManageController@CategoryDelete')->name('CategoryDelete');
    route::post('/category-multi-delete', 'admin\CategoryManageController@CategoryMultiDelete')->name('CategoryMultiDelete');
    route::post('/category-multi-active', 'admin\CategoryManageController@CategoryMultiActive')->name('CategoryMultiActive');
    route::post('/category-multi-deactive', 'admin\CategoryManageController@CategoryMultiDeactive')->name('CategoryMultiDeactive');
    route::get('/category-edit/{id}', 'admin\CategoryManageController@CategoryEdit')->name('CategoryEdit');
    route::post('/category-update', 'admin\CategoryManageController@CategoryUpdate')->name('CategoryUpdate');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    route::post('/brand-store', 'admin\BrandManageController@BrandStore')->name('BrandStore');
    route::post('/brand-update', 'admin\BrandManageController@BrandUpdate')->name('BrandUpdate');
    route::get('/brand-all', 'admin\BrandManageController@BrandAll')->name('BrandAll');
    route::get('/brand-edit/{id}', 'admin\BrandManageController@BrandEdit')->name('BrandEdit');
    route::get('/brand-delete/{id}', 'admin\BrandManageController@BrandDelete')->name('BrandDelete');
    route::post('/brand-multidelete', 'admin\BrandManageController@BrandMultiDelete')->name('BrandMultiDelete');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    route::post('/size-store', 'admin\SizeManageController@SizeStore')->name('SizeStore');
    route::post('/size-update', 'admin\SizeManageController@SizeUpdate')->name('SizeUpdate');
    route::get('/size-all', 'admin\SizeManageController@SizeAll')->name('SizeAll');
    route::get('/size-edit/{id}', 'admin\SizeManageController@SizeEdit')->name('SizeEdit');
    route::get('/size-delete/{id}', 'admin\SizeManageController@SizeDelete')->name('SizeDelete');
    route::post('/size-multidelete', 'admin\SizeManageController@SizeMultiDelete')->name('SizeMultiDelete');
    route::post('/size-multiactive', 'admin\SizeManageController@SizeMultiActive')->name('SizeMultiActive');
    route::post('/size-multideactive', 'admin\SizeManageController@SizeMultiDeActive')->name('SizeMultiDeActive');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    route::post('/color-store', 'admin\ColorManageController@ColorStore')->name('ColorStore');
    route::post('/color-update', 'admin\ColorManageController@ColorUpdate')->name('ColorUpdate');
    route::get('/color-all', 'admin\ColorManageController@ColorAll')->name('ColorAll');
    route::get('/color-edit/{id}', 'admin\ColorManageController@ColorEdit')->name('ColorEdit');
    route::get('/color-delete/{id}', 'admin\ColorManageController@ColorDelete')->name('ColorDelete');
    route::post('/color-multidelete', 'admin\ColorManageController@ColorMultiDelete')->name('ColorMultiDelete');
    route::post('/color-multiactive', 'admin\ColorManageController@ColorMultiActive')->name('ColorMultiActive');
    route::post('/color-multideactive', 'admin\ColorManageController@ColorMultiDeActive')->name('ColorMultiDeActive');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    route::post('/tag-store', 'admin\TagManageController@TagStore')->name('TagStore');
    route::post('/tag-update', 'admin\TagManageController@TagUpdate')->name('TagUpdate');
    route::get('/tag-all', 'admin\TagManageController@TagAll')->name('TagAll');
    route::get('/tag-gallery', 'admin\TagManageController@TagGallery')->name('TagGallery');
    route::get('/tag-edit/{id}', 'admin\TagManageController@TagEdit')->name('TagEdit');
    route::get('/tag-delete/{id}', 'admin\TagManageController@TagDelete')->name('TagDelete');
    route::post('/tag-multidelete', 'admin\TagManageController@TagMultiDelete')->name('TagMultiDelete');
    route::post('/tag-multiactive', 'admin\TagManageController@TagMultiActive')->name('TagMultiActive');
    route::post('/tag-multideactive', 'admin\TagManageController@TagMultiDeActive')->name('TagMultiDeActive');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    route::get('/product-view-all-data', 'admin\ProductManageController@ProductAllData')->name('ProductAllData');
    route::post('/product-store', 'admin\ProductManageController@ProductStore')->name('ProductStore');
    route::post('/product-update', 'admin\ProductManageController@ProductUpdate')->name('ProductUpdate');
    route::get('/product-all', 'admin\ProductManageController@ProductAll')->name('ProductAll');
    route::get('/product-gallery', 'admin\ProductManageController@ProductGallery')->name('ProductGallery');
    route::get('/product-edit/{id}', 'admin\ProductManageController@ProductEdit')->name('ProductEdit');
    route::get('/product-delete/{id}', 'admin\ProductManageController@ProductDelete')->name('ProductDelete');
    route::post('/product-multidelete', 'admin\ProductManageController@ProductMultiDelete')->name('ProductMultiDelete');
    route::post('/product-multiactive', 'admin\ProductManageController@ProductMultiActive')->name('ProductMultiActive');
    route::post('/product-multideactive', 'admin\ProductManageController@ProductMultiDeActive')->name('ProductMultiDeActive');
});
