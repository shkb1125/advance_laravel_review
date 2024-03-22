<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SessionController;
use App\Models\Person;
use App\Models\Product;
use App\Http\Controllers\PenController;

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

Route::get('/', [AuthorController::class, 'index']);

Route::get('/add', [AuthorController::class, 'add']);
Route::post('/add', [AuthorController::class, 'create']);

// データ編集ページの表示
Route::get('/edit', [AuthorController::class, 'edit']);
// データ更新
Route::post('/edit', [AuthorController::class, 'update']);
// データ削除用ページの表示
Route::get('/delete', [AuthorController::class, 'delete']);
// データ削除
Route::post('/delete', [AuthorController::class, 'remove']);

Route::get('/find', [AuthorController::class, 'find']);
Route::post('/find', [AuthorController::class, 'search']);

Route::get('/author/{author}', [AuthorController::class, 'bind']);

Route::get('/verror', [AuthorController::class, 'verror']);

Route::prefix('book')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::get('/add', [BookController::class, 'add']);
    Route::post('/add', [BookController::class, 'create']);
});

Route::get('/relation', [AuthorController::class, 'relate']);

Route::get('/session', [SessionController::class,'getSes']);
Route::post('/session', [SessionController::class,'postSes']);

Route::get('/softdelete', function () {
    Person::find(1)->delete();
});

Route::get('softdelete/get', function () {
    $person = Person::onlyTrashed()->get();
    dd($person);
});

Route::get('softdelete/store', function () {
    $result = Person::onlyTrashed()->restore();
    echo $result;
});

Route::get('softdelete/absolute', function () {
    $result = Person::onlyTrashed()->forceDelete();
    echo $result;
});

Route::get('uuid', function () {
    $products = Product::all();
    foreach($products as $product){
        echo $product . '<br>';
    }
});

// 複数代入
Route::get('fill', [PenController::class,'fillPen']);
Route::get('create', [PenController::class,'createPen']);
Route::get('insert', [PenController::class,'insertPen']);