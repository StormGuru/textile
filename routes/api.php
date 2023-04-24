<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function()
{
  Route::post('/add/organization', [App\Http\Controllers\OrganizationController::class, 'add']);
  Route::get('user/organization',  [App\Http\Controllers\OrganizationController::class, 'userShow']);
  Route::get('polzovateli',  [App\Http\Controllers\Admin\UserController::class, 'show']);
  Route::get('news',  [App\Http\Controllers\Admin\NewsController::class, 'show']);
  Route::patch('news/update/{news}',  [App\Http\Controllers\Admin\NewsController::class, 'update']);
  Route::get('get/news/{news}',  [App\Http\Controllers\Admin\NewsController::class, 'getNews']);
  Route::patch('role/update/{id}',  [App\Http\Controllers\Admin\SetRoleAdminController::class, 'setRole']);
  Route::patch('category/update/{category}',  [App\Http\Controllers\CategoryController::class, 'update']);
  Route::delete('category/delete/{category}',  [App\Http\Controllers\CategoryController::class, 'delete']);
  Route::delete('news/delete/{news}',  [App\Http\Controllers\Admin\NewsController::class, 'delete']);
  Route::post('category/add',  [App\Http\Controllers\CategoryController::class, 'add']);
  Route::post('news/add',  [App\Http\Controllers\Admin\NewsController::class, 'add']);
  Route::patch('organization/update/{organization}',  [App\Http\Controllers\OrganizationController::class, 'update']);
  Route::patch('order/update/{order}',  [App\Http\Controllers\OrderController::class, 'update']);
  Route::delete('organization/delete/{organization}',  [App\Http\Controllers\OrganizationController::class, 'delete']);
  Route::delete('order/delete/{order}',  [App\Http\Controllers\OrderController::class, 'delete']);
}
);

Route::get('search/orgs/{text}',  [App\Http\Controllers\SearchController::class, 'searchOrgs']);
Route::get('search/orders/{text}',  [App\Http\Controllers\SearchController::class, 'searchOrders']);
Route::get('last/orders',  [App\Http\Controllers\OrderController::class, 'last']);
Route::get('last/news',  [App\Http\Controllers\Admin\NewsController::class, 'last']);
Route::post('all/orders',  [App\Http\Controllers\OrderController::class, 'allOrders']);
Route::post('all/organizations',  [App\Http\Controllers\OrganizationController::class, 'allOrganizations']);

Route::post('/setrole', [App\Http\Controllers\RoleController::class, 'setRole']);
Route::get('/category/show', [App\Http\Controllers\CategoryController::class, 'show']);
Route::post('/order/add', [App\Http\Controllers\OrderController::class, 'add']);
Route::get('/user/order', [App\Http\Controllers\OrderController::class, 'show']);
Route::get('organization/{organization}',  [App\Http\Controllers\OrganizationController::class, 'single']);
Route::get('order/{order}',  [App\Http\Controllers\OrderController::class, 'single']);
Route::get('order/count/{order}',  [App\Http\Controllers\OrderController::class, 'count']);
Route::get('organization/count/{organization}',  [App\Http\Controllers\OrganizationController::class, 'count']);
Route::get('/organization/liders', [App\Http\Controllers\OrganizationController::class, 'liders']);