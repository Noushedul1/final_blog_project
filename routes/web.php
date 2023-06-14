<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// user routes
Route::get('/',[UserController::class,'index']);
Route::get('/posts/{id}',[UserController::class,'single_post_view'])->name('single_post_view');
Route::get('/posts/category/{category_id}',[UserController::class,'filter_by_category'])->name('filter_by_category');
Route::group(['middleware'=>'auth'],function(){
    Route::post('/posts/{id}/comment/store',[UserController::class,'comment_store'])->name('comment_store');
    Route::delete('/posts/{id}/comment/delete',[UserController::class,'comment_delete'])->name('comment.delete');
    Route::get('/questions',[UserController::class,'questions'])->name('questions');
    Route::post('/questions/store',[UserController::class,'questions_store'])->name('questions.store');
    Route::delete('/question/{id}/delete',[UserController::class,'question_delete'])->name('question.delete');
    Route::get('/questions/answers/{id}',[UserController::class,'questions_answers'])->name('question.answers');
    Route::post('/questions/answers/store/{id}',[UserController::class,'question_answer_store'])->name('question.answer.store');
    Route::delete('/questions/answers/delete/{id}',[UserController::class,'questionanswer_delete'])->name('questionAnswerDelete');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin routes
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login')->middleware('guest:admin');

Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
    // start for category
    Route::resource('admin/category',CategoryController::class);
    // end for category
    // start for post
    Route::resource('admin/post',PostController::class);
    // end for post

});


