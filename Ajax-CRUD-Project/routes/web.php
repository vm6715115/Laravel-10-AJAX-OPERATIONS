<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-students', function () {
    return view('studentform');
});

Route::post('add-students', [StudentController::class,'addstudent'])->name('addstudent');

Route::get('/get-students', function () {
    return view('students');
});

Route::get('/get-all-students', [StudentController::class,'getStudents'])->name('getStudents');

Route::get('/editUser/{id}', [StudentController::class,'getStudentData']);

Route::post('updatedata', [StudentController::class,'updateStudents'])->name('updateStudent');

Route::get('delete-data/{id}', [StudentController::class,'deleteData']);