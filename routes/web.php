<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::get('/pzn',function () {
    return 'Hello Iqbal Menggala';
});
Route::redirect('/youtube','/pzn');
Route::fallback(function () {
    return "404 by Iqbal Menggala";
});

Route::view('/hello','hello',['name' => 'Iqbal']);
Route::get('/hello-again',function () {
    return view('hello',['name' => 'Iqbal']);
});
Route::view('/hello-world','hello.world',['name' => 'Iqbal']);
Route::get('/hello-world',function () {
    return view('hello.world',['name' => 'Iqbal']);
});

Route::get('/products/{id}',function ($productId) {
    return "Product $productId";
})->name('product.detail');
Route::get('/products/{id}/{item}',function ($productId,$itemId) {
    return "Product $productId Item $itemId";
})->name('product.item.detail');
Route::get('/categories/{id}',function ($categoriesId) {
    return "Categories $categoriesId";
})->where('id','[0-9]+')->name('category.detail');
Route::get('/user/{id?}',function (string $userId = '404') {
    return "User $userId";
});
Route::get('/conflict/iqbal',function () {
    return "Conflict Iqbal Menggala";
});
Route::get('/conflict/{name}',function (string $name) {
    return "Conflict $name";
});
Route::get('/produk/{id}',function (string $productId) {
    $link = route('product.detail',['id' => $productId]);
    return "Link $link";
});
Route::get('/produk-redirect/{id}',function (string $id) {
    return redirect()->route('product.detail',['id' => $id]);
});

Route::get('/controller/hello/request',[HelloController::class, 'request']);
Route::get('/controller/hello/{name}',[HelloController::class, 'hello']);

Route::get('/input/hello',[InputController::class, 'hello']);
Route::post('/input/hello',[InputController::class, 'hello']);
Route::post('/input/hello/first',[InputController::class, 'helloFirst']);
Route::post('/input/hello/input',[InputController::class, 'helloInput']);
Route::post('/input/hello/array',[InputController::class, 'arrayInput']);
Route::get('/input/query/string',[InputController::class, 'queryString']);
Route::get('/input/query/string/array',[InputController::class, 'queryStringArray']);
Route::post('/input/type', [InputController::class, 'inputType']);
Route::post('/input/filter/only', [InputController::class, 'inputOnly']);
Route::post('/input/filter/except', [InputController::class, 'inputExcept']);
Route::post('/input/filter/merge', [InputController::class, 'inputMerge']);

Route::post('/file/upload',[FileController::class, 'upload'])->withoutMiddleware([VerifyCsrfToken::class]);

Route::prefix('/response')->group(function () {
    Route::get('/hello',[ResponseController::class, 'response']);
    Route::get('/header',[ResponseController::class, 'header']);
    Route::get('/type/view',[ResponseController::class, 'responseView']);
    Route::get('/type/json',[ResponseController::class, 'responseJson']);
    Route::get('/type/file',[ResponseController::class, 'responseFile']);
    Route::get('/type/download',[ResponseController::class, 'responseDownload']);
});

Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set','createCookie');
    Route::get('/cookie/get','getCookie');
    Route::get('/cookie/clear','clearCookie');
});


Route::get('/redirect/to',[RedirectController::class, 'redirectTo']);
Route::get('/redirect/from',[RedirectController::class, 'redirectFrom']);
Route::get('/redirect/name',[RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}',[RedirectController::class, 'redirectHello'])->name('redirect-hello');
Route::get('/redirect/named',function () {
    return url()->route('redirect-hello', ['name' => 'iqbal']);
    // return route('redirect-hello', ['name' => 'iqbal']);
    // return URL::route('redirect-hello', ['name' => 'iqbal']);
});
Route::get('/redirect/action',[RedirectController::class, 'redirectAction']);
Route::get('/redirect/away',[RedirectController::class, 'redirectAway']);

Route::middleware('contoh:qwerty,401')->prefix('/middleware')->group(function () {
    Route::get('/api',function () {
    return "OK";
    });
    Route::get('/group',function () {
    return "GROUP";
    });
});

Route::get('/url/action', function () {
    // return action([FormController::class, 'form'],[]);
    // return url()->action([FormController::class, 'form'],[]);
    return URL::action([FormController::class, 'form']);
});
Route::get('/form',[FormController::class, 'form']);
Route::post('/form',[FormController::class, 'submitForm']);

Route::get('/url/current', function () {
    return URL::full(); 
});

Route::get('/session/create',[SessionController::class, 'createSession']);
Route::get('/session/get',[SessionController::class, 'getSession']);

Route::get('/error/sample', function () {
    throw new Exception("Error Sample");
});
Route::get('/error/manual', function () {
    report(new Exception("Error Sample"));
    return "OK";
});
Route::get('/error/validation', function () {
    throw new ValidationException("Error Sample");
});

Route::get('/abort/400', function () {
    abort(400, 'Ups Validation Error');
});