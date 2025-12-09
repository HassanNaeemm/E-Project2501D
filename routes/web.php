<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
Route::get('/', function () {
    return view('index');
});



Route::get('/admindashboard', function () {
    return view('admin.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
       if(Auth::user()->role == "User")
       {
 return view('index');
       }
       else
       {
        return view('admin.index');
       }
    })->name('dashboard');
    Route::get('/contact', function () {
    return view('contact');
});
Route::get('/blogs', function () {
    return view('blogs');
});
});

Route::middleware([AdminMiddleware::class])->group(function(){
Route::get('/user',[AdminController::class,('getcontacts')]);


Route::post('/insertdata',[UserController::class,('insertdata')]);


Route::post('/delete/{userid}',[AdminController::class,('deletedata')]);
Route::post('/updateuser/{userid}',[AdminController::class,('getupdaterecord')]);

Route::post('/updaterecord/{userid}',[AdminController::class,('edits')]);

Route::get('contacts/export/', [AdminController::class, 'export']);
Route::get('contacts/pdf',[AdminController::class,('download')]);


Route::get('/uploadcategory',function(){
    return view('admin.productcategory');
});
Route::get('/uploadproduct',[AdminController::class,('fetchcategory')]);
Route::post('/addcategory',[AdminController::class,('addcategory')]);
Route::post('/insertproduct',[AdminController::class,('uploadproduct')]);
});

Route::get('/getappointments',[AdminController::class,('getappointments')]);
Route::get('/getusers',[AdminController::class,('getallusers')]);
Route::post('/updaterole/{id}',[AdminController::class,('updaterole')]);
Route::get('/testajax',function(){
    return view('testajax');
});
Route::post('/insdata',[AdminController::class,('insertdata')]);
Route::get('/getdata',[AdminController::class,('getuserdata')]);