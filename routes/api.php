<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('add/article',[AdminController::class ,'AddArticle']);
Route::get('/article',[AdminController::class ,'GetArticle']);
Route::get('/article/{id}',[AdminController::class ,'GetArticleById']);
Route::get('/article/{id}/modifier',[AdminController::class ,'UpdateArticle']);
Route::post('/article/{id}/modifier',[AdminController::class ,'EditArticle']);
Route::post('/connexion',[Authentication::class ,'login']);




