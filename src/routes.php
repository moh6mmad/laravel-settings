<?php

use Illuminate\Support\Facades\Route;
use Moh6mmad\LaravelSettings\Controllers\LaravelSettingsController;

Route::any('/settings/delete/{settingId}', [LaravelSettingsController::class, 'delete'])->name('settings.delete');
Route::resource('settings', LaravelSettingsController::class, [
    'names' => [
        'index' => 'settings',
        'store' => 'settings.new',
    ]
]);