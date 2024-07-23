<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanTaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});
Route::group(['middleware'=>'auth'],function (){
    Route::resource('plans',PlanController::class);
    Route::post('/tasks/{plan}',[PlanTaskController::class,'store'])->name('tasks.store');
    Route::patch('/tasks/{task}',[PlanTaskController::class,'update'])->name('tasks.update');
    Route::delete('/tasks/{task}',[PlanTaskController::class,'delete'])->name('tasks.delete');
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
