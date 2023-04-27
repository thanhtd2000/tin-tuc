<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\client\HomeController;




Route::get('clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
});
Route::get("/", [HomeController::class, 'home'])->name('client.home');
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
    Route::get("/index", [DashBoardController::class, 'index'])->name('admin.index');
    Route::prefix('categories')->group(function () {
        Route::get("/index", [CategoryController::class, 'index']);
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
        Route::get("/delete/{id}", [PostController::class, 'delete'])->name('delete-post')->middleware('CheckIsAdmin');
        Route::get("/edit/{id}", [PostController::class, 'edit'])->name('posts.edit')->middleware('CheckIsAdmin');
        Route::put("/update", [PostController::class, 'update'])->name('posts.update');
        Route::get("/update-stt/{id}&&{status}", [PostController::class, 'updatestt'])->name('posts.updatestt');
        Route::post("/index", [PostController::class, 'search'])->name('posts.search');
        Route::delete("/deleteMultiple", [PostController::class, 'deleteMultiple'])->name('delete.Mulposts');
    });
    Route::prefix('comments')->group(function () {
        Route::get("/index", [CommentController::class, 'index'])->name('comments.index');
        Route::get("/delete/{id}", [CommentController::class, 'delete'])->name('delete.comments')->middleware('CheckIsAdmin');
        Route::post("/index", [CommentController::class, 'search'])->name('comments.search');
        Route::get("/update_stt/{id}&&{status}", [CommentController::class, 'update_stt'])->name('comments.update_stt');
        Route::delete("/deleteMultiple", [CommentController::class, 'deleteMultiple'])->name('delete.Mulcomments');
    });
});
// home controller
Route::post("/create", [HomeController::class, 'store'])->name('user_post');
Route::get("/category/{id}", [HomeController::class, 'showCategory'])->name('client.showCategory');
Route::get("/post-detail/{id}", [HomeController::class, 'showPostDetail'])->name('client.postDetail');
Route::post("/search-post", [HomeController::class, 'searchPost'])->name('client.searchPost');
Route::post("/user-comment", [HomeController::class, 'storeComment'])->name('client.userComment');
Route::get("/user-delete-comment/{id}", [HomeController::class, 'deleteComment'])->name('client.deleteComment');
Route::post('/posts/{post}/like&user_id', [PostController::class, 'like'])->name('posts.like');
Route::get('/post-created', [HomeController::class, 'showPostCreated'])->name('client.postCreated');
Route::get('/edit-post-created/{id}', [HomeController::class, 'editPostCreated'])->name('client.editPostCreated');
Route::put('/edit-post-created/{id}', [HomeController::class, 'updatePostCreated'])->name('client.updatePostCreated');
Route::get("/deletePostCreated/{id}", [HomeController::class, 'deletePostCreated'])->name('client.deletePostCreated');
Route::get("/show-profile", [HomeController::class, 'showProfile'])->name('client.showProfile');
Route::get("/edit-profile/{id}", [HomeController::class, 'editProfile'])->name('client.editProfile');
Route::post("/update-profile/{id}", [HomeController::class, 'updateProfile'])->name('client.updateProfile');
Route::get("/update_stt/{id}", [HomeController::class, 'updateNotification'])->name('client.updateNotification');
Route::get("/contact", [HomeController::class, 'contact'])->name('client.contact');
Route::get("/gioi-thieu", [HomeController::class, 'introduce'])->name('client.introduce');
Route::get("/update_all_stt/{user_id}", [HomeController::class, 'updateAllNotification'])->name('client.updateAllNotification');
