<?php

use App\Http\Controllers\AssignmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AssignmentController::class, 'index'])->name('assignments.index');
Route::post('/meetings/{meeting}/upload', [AssignmentController::class, 'store'])->name('assignments.upload');
Route::get('/submissions/{submission}/download', [AssignmentController::class, 'download'])->name('assignments.download');
Route::delete('/submissions/{submission}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');

