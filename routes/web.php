<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\client\HomeController;
use Illuminate\Support\Facades\Auth;


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

Route::get("/", [UserController::class, 'home'])->name('client.home');
Route::get("/login", [AuthController::class, 'getLogin'])->name('login');
Route::post("/login", [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::get("/dang-ky", [AuthController::class, 'getSignup']);
Route::post("/signup", [AuthController::class, 'store'])->name('user.dangky');
Route::get("/logout", [AuthController::class, 'Logout'])->name('logout');
Route::get("/profile", [AuthController::class, 'profile']);
Route::post("/profile", [AuthController::class, 'profile'])->name('changeProfile');
//hiện bảng recovery
Route::get("/recovery", [AuthController::class, 'recovery']);

//
Route::post("/sendmail", [AuthController::class, 'sendEmail'])->name('sendmail');
Route::get("/recovery-code", [AuthController::class, 'recovery']);

Route::get("/checkcode", [AuthController::class, 'viewcheckcode']);
Route::post("/checkcode", [AuthController::class, 'checkcode'])->name('checkcode');


Route::middleware('checkAdmin')->prefix('admin')->group(function () {
    Route::get("/index", [UserController::class, 'index']);
    Route::prefix('categories')->group(function () {
        Route::get("/index", [CategoryController::class, 'show']);
        Route::get("/create", [CategoryController::class, 'create']);
        Route::post("/create", [CategoryController::class, 'store'])->name('category-create');
        Route::get("/delete/{id}", [CategoryController::class, 'delete']);
        Route::get("/edit/{id}", [CategoryController::class, 'edit']);
        Route::put("/update", [CategoryController::class, 'update'])->name('category-update');
    });
    //user
    Route::prefix('users')->group(function () {
        Route::get("/index", [UserController::class, 'show'])->name('users.show');
        Route::post("/index", [UserController::class, 'search'])->name('users.search');
        Route::get("/create", [UserController::class, 'create'])->name('users.create');
        Route::post("/create", [UserController::class, 'store'])->name('user.post');
        Route::get("/delete/{id}", [UserController::class, 'delete']);
        Route::get("/edit/{id}", [UserController::class, 'edit']);
        Route::put("/update", [UserController::class, 'update'])->name('user.update');
        Route::get("/permise", [UserController::class, 'permise'])->name('users.permise');
        Route::middleware('checkAdminPermission')->get("/permise1", [UserController::class, 'permise_admin'])->name('users.permise1');
    });
    //posts
    Route::prefix('posts')->group(function () {
        Route::get("/index", [PostController::class, 'show'])->name('posts.show');
        Route::get("/create", [PostController::class, 'create']);
        Route::post("/create", [PostController::class, 'store'])->name('post-create');
        Route::get("/delete/{id}", [PostController::class, 'delete']);
        Route::get("/edit/{id}", [PostController::class, 'edit']);
        Route::put("/update", [PostController::class, 'update'])->name('posts.update');
        Route::get("/update-stt/{id}", [PostController::class, 'updatestt'])->name('posts.updatestt');
        Route::post("/index", [PostController::class, 'search'])->name('posts.search');
    });
});
///////////
Route::post("/create", [HomeController::class, 'store'])->name('user_post');
Route::get("/category/{id}", [HomeController::class, 'showCategory'])->name('client.showCategory');
Route::get("/post-detail/{id}", [HomeController::class, 'showPostDetail'])->name('client.postDetail');
Route::post("/search-post", [HomeController::class, 'searchPost'])->name('client.searchPost');
