<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::resource('tasks', TaskController::class, ['only' => ['index', 'store', 'update', 'destroy']]);
