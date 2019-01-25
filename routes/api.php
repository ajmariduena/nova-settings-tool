<?php

use Illuminate\Support\Facades\Route;
use Ajmariduena\SettingsTool\Http\Controllers\SettingsToolController;

Route::get('/', [SettingsToolController::class, 'read']);

Route::post('/', [SettingsToolController::class, 'write']);
