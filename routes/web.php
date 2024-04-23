<?php

use App\Http\Controllers\Download;
use Illuminate\Support\Facades\Route;

Route::get('/test', [Download::class, 'download']);
