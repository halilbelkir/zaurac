<?php

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

    Route::get('/', function () {return view('front.index');})->name('index');
    Route::get('/hakkımızda', function () {return view('front.about');})->name('about');
    Route::get('/referanslarimiz', function () {return view('front.clients');})->name('clients');
    Route::get('/iletisim', function () {return view('front.contact');})->name('contact');
    Route::get('/projelerimiz', function () {return view('front.projects.index');})->name('projects.list');
    Route::get('/projelerimiz/{seflink}', function () {return view('front.projects.detail');})->name('projects.detail');
    Route::get('/hizmetlerimiz', function () {return view('front.services.index');})->name('services.list');
    Route::get('/hizmetlerimiz/{seflink}', function () {return view('front.services.detail');})->name('services.detail');
    Route::get('/zauracblog', function () {return view('front.blog.index');})->name('blog.list');
    Route::get('/zauracblog/{seflink}', function () {return view('front.blog.detail');})->name('blog.detail');
