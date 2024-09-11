<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');


Route::match(['get', 'post'], '/form', [UserController::class, 'form']);
Route::post('/result', [UserController::class, 'result']);
Route::match(['get', 'post'], '/form1', [UserController::class, 'form1']);
Route::post('/result1', [UserController::class, 'result1']);

Route::get('/vk', [PostController::class, 'showLayout']);
Route::get('/vkbot', [PostController::class, 'showLayout1']);

Route::get('/showLoginForm', function () {
    return view('post.form1');
})->name('showLoginForm');

Route::get('/showRegistrationForm', function () {
    return view('post.form');
})->name('showRegistrationForm');

Route::get('/logout', function () {
    session()->forget('user_name');
});
Route::get('/myAccount', [UserController::class, 'showMyAccount'])->name('myAccount');

Route::get('/edit/{id}', [UserController::class, 'edit']);

Route::get('/friends', [UserController::class, 'showFriends'])->name('friends');

Route::get('/myFriends', [UserController::class, 'showMyFriends'])->name('myFriends');

Route::get('/searchFriends', [UserController::class, 'searchFriends'])->name('searchFriends');

Route::get('/searchMyFriends', [UserController::class, 'searchMyFriends'])->name('searchMyFriends');

Route::get('/notifications', [UserController::class, 'showNotifications'])->name('notifications');

Route::get('/addFriend/{senderId}', [UserController::class, 'addFriend']);

Route::get('/rejectFriend/{notificationId}', [UserController::class, 'rejectFriend']);

Route::get('/user/{id}', [UserController::class, 'showUserProfile'])->name('user.profile');

Route::get('/addToFriend/{userId}', [UserController::class, 'addToFriend']);

Route::get('/cancelFriendRequest/{userId}', [UserController::class, 'cancelFriendRequest']);

Route::get('/removeFromFriends/{friendId}', [UserController::class, 'removeFromFriends']);

Route::get('/messages', [UserController::class, 'showMessages'])->name('messages');

Route::get('/messagesDialog/{userId}', [UserController::class, 'showDialog']);

Route::get('/sendMessage/{userId}', [UserController::class, 'sendMessage']);

Route::get('/showMusic', [UserController::class, 'showMusic']);

Route::get('/showAllMusic', [UserController::class, 'showAllMusic']);

Route::get('/searchAllMusic', [UserController::class, 'searchAllMusic'])->name('searchAllMusic');

Route::get('/searchMyMusic', [UserController::class, 'searchMyMusic'])->name('searchMyMusic');

Route::get('/showPosts', [UserController::class, 'showPosts']);

Route::get('/addPosts', [UserController::class, 'addPosts']);

Route::get('/addPost', [UserController::class, 'addPost']);

Route::get('/post/{id}', [UserController::class, 'showPost']);

Route::get('/likePost', [UserController::class, 'likePost']);

Route::get('/addComment/{postId}', [UserController::class, 'addComment'])->name('addComment');