<?php
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get("/allpost", [PostController::class, "index"]);
Route::get("/showArticle/{id}", [PostController::class, "show"]);
Route::post("/postsArticle", [PostController::class, "store"]);
Route::delete("/deleteArticle/{id}", [PostController::class, "destroy"]);
Route::put("/updateArticle/{id}", [PostController::class, "update"]);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
