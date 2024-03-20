<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MagasinController;

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
// ROUTES AUTHENTIFICATION 
Route::post('/connexion',[Authentication::class ,'login']);

// ROUTES ABOUT ARTICLE (Admin)

Route::get('/articles',[AdminController::class ,'GetArticle']);
Route::get('/articles/{id}',[AdminController::class ,'GetArticleById']);
Route::post('/articles',[AdminController::class ,'AddArticle']);
// Route::put('/articles/{id}',[AdminController::class ,'UpdateArticle']);
Route::put('/articles/{id}',[AdminController::class ,'EditArticle']);
Route::delete('/articles/{id}',[AdminController::class ,'DeleteArticle']);

// ROUTE ABOUT MAGASIN (Admin)

Route::get('/magasins',[MagasinController::class ,'GetMagasin']);
Route::get('/magasins/{id}',[MagasinController::class ,'GetMagasinById']);
Route::post('/magasins',[MagasinController::class ,'AddMagasin']);
Route::Delete('/magasin/{id}',[MagasinController::class ,'DeleteMagasin']);

// ROUTE ABOUT MAGASIN 
Route::get('/magasins/{id}/articles',[MagasinController::class ,'getMagasinsMerch']);
Route::post('/magasins/{id}/articles/add',[MagasinController::class ,'AddArticleMagasin']);
Route::get('/magasins/{MagasinId}/articles/{id}',[MagasinController::class ,'GetArticleMagasinById']);
Route::post('/magasins/{id}/commercial/add',[MagasinController::class ,'AddCommercial']);
Route::get('/magasins/{id}/commercials',[MagasinController::class ,'GetCommercials']);
Route::get('/magasins/{id}/clients',[MagasinController::class ,'GetClient']);
Route::post('/magasins/{id}/client/add',[MagasinController::class ,'AddClient']);




// todo route post article in magasin
//TODO  admin post magasin








