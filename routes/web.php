<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromptsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GreatController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

//管理画面表示
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//ログインしているユーザを取得して管理画面に表示
Route::get('/dashboard', [ProfileController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin');



//管理画面から各画面へ遷移
Route::get('/dashboard/adminuser', function () {
    return view('usermanage');
})->middleware(['auth', 'verified'])->name('adminuser');

// Route::get('/dashboard/prompts', function () {
//     return view('prompts');
// })->middleware(['auth', 'verified'])->name('prompts');
// ----------------------------------------------------------------------------------------------------------------------------
//ユーザー系
//ユーザ一覧取得
Route::get('/dashboard/adminuser', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('adminuser');
//ユーザ登録
Route::post('/dashboard/adminuser', [UserController::class, 'store'])
    ->name('customer.store');
//ユーザ編集
Route::get('/customer/{id}/edit', [UserController::class, 'edit'])
    ->name('customer.edit');
Route::put('/customer/{id}', [UserController::class, 'update'])
    ->name('customer.update');
//ユーザ削除
Route::delete('/customer/{id}', [UserController::class, 'destroy'])
    ->name('customer.destroy');

//-------------------------------------------------------------------------------------------------------------------------------
//プロンプト一覧
Route::get('/dashboard/prompts', [PromptsController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('prompts');
//プロンプト登録
Route::post('/dashboard/prompts', [PromptsController::class, 'store'])
    ->name('prompts.store');

//プロンプト編集
Route::get('/prompts/{id}/edit', [PromptsController::class, 'edit'])
    ->name('prompts.edit');
Route::put('/prompts/{id}', [PromptsController::class, 'update'])
    ->name('prompts.update');

//プロンプト管理画面
Route::get('/settings', [SettingsController::class, 'edit'])
    ->name('settings.edit');
Route::post('/settings', [SettingsController::class, 'update'])
    ->name('settings.update');

//プロンプト削除
Route::delete('/prompts/{id}', [PromptsController::class, 'destroy'])
    ->name('prompts.destroy');

//-------------------------------------------------------------------------------------------------------------------------------
//イラスト作成
//表示
Route::get('/dashboard/image', [ImageController::class, 'index'])
    ->name('image.index');
Route::post('/dashboard/image', [ImageController::class, 'store'])
    ->name('image.store');

Route::get('/dashboard/image/{id}', [ImageController::class, 'getPromptData']);




//-------------------------------------------------------------------------------------------------------------------------------

//イベント
Route::get('/dashboard/events', function () {
    return view('events');
})->middleware(['auth', 'verified'])->name('events');

//--------------------------------------------------------------------------------------------------------------------------------

//偉人管理
Route::get('/dashboard/greatmanaged', [GreatController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('greatmanaged');
//偉人登録
Route::post('/dashboard/greatmanaged', [GreatController::class, 'store'])
    ->name('greatmanaged.store');
//偉人編集
Route::get('/greatmanaged/{id}/edit', [GreatController::class, 'edit'])
    ->name('greatmanaged.edit');
Route::put('/greatmanaged/{id}', [GreatController::class, 'update'])
    ->name('greatmanaged.update');
//偉人削除
Route::delete('/greatmanaged/{id}', [GreatController::class, 'destroy'])
    ->name('greatmanaged.delete');

//--------------------------------------------------------------------------------------------------------------------------------

//クイズ一覧
Route::get('/dashboard/quiz', function () {
    return view('quiz');
})->middleware(['auth', 'verified'])->name('quiz');

//--------------------------------------------------------------------------------------------------------------------------------

//アクセス一覧
Route::get('/dashboard/access', function () {
    return view('access');
})->middleware(['auth', 'verified'])->name('access');
    




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
