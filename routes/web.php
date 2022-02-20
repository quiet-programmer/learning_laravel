<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

// $posts = [
//     1 => [
//         'title' => 'Intro to Laravel',
//         'content' => 'This is a short intro to Laravel',
//         'is_new' => true
//     ],
//     2 => [
//         'title' => 'Intro to PHP',
//         'content' => 'This is a short intro to PHP',
//         'is_new' => false
//     ],
//     3 => [
//         'title' => 'Intro to GoLang',
//         'content' => 'This is a short intro to GoLang',
//         'is_new' => false
//     ],
//     4 => [
//         'title' => 'Intro to Java',
//         'content' => 'This is a short intro to Java',
//         'is_new' => true
//     ]
// ];

Auth::routes();

Route::get('/', [HomeController::class, 'home'])->name('home.index');
// ->middleware('auth');
// Route::get('/home', [HomeController::class, 'home'])->name('home.index');
Route::get('/contacts', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/secret', [HomeController::class, 'secret'])
        ->name('home.secret')
        ->middleware('can:home.secret,');

Route::get('/single', AboutController::class);

Route::resource('posts', PostController::class);
// ->only(['index', 'show', 'create', 'store', 'edit', 'update']);

// Route::get('/posts', function() use($posts) {
//     dd(request()->all());
//     return view('post.index', ['posts' => $posts]);
// })->name('posts.index');

// Route::get('/posts/{id}', function($id) use($posts) {
//     abort_if(!isset($posts[$id]), 404);
//     return view('post.show', ['post' => $posts[$id]]);
// })->name('posts.show'); // this is the calling of the name of a route

// // this is an optional parameter.
// // optional parameters must have a default value.
// Route::get('/recent_post/{days_ago?}', function($daysAgo = 2) {
//     return 'this is post from ' . $daysAgo . ' days ago';
// })->name('recent_post');

// Route::prefix('/fun')->name('fun.')->group(function() use($posts) {

//     Route::get('/response', function() use($posts) {
//         return response($posts, 201)->header('Content-Type', 'application/json')->cookie('MY_COOKIE', 'eat cookie', 3600);
//     })->name('response');
    
//     Route::get('/redirect', function() {
//         return redirect('/contacts');
//     })->name('redirect');
    
//     Route::get('/back', function() {
//         return back();
//     })->name('back');
    
//     Route::get('/named-route', function() {
//         return redirect()->route('posts.show', ['id' => 1]);
//     })->name('named-route');
    
//     Route::get('/away', function() {
//         return redirect()->away('https://google.com');
//     })->name('away');
    
//     Route::get('/json', function() use($posts) {
//         return response()->json($posts);
//     })->name('json');
    
//     Route::get('/download', function() {
//         return response()->download(public_path('/shot.png'), 'screenshot0001.png');
//     })->name('download');
// });
