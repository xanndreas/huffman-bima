<?php

use App\Http\Controllers\Api\V1\Admin\DraftApiController;
use App\Http\Controllers\Api\V1\Admin\PermissionApiController;
use App\Http\Controllers\Api\V1\Admin\RoleApiController;
use App\Http\Controllers\Api\V1\Admin\SentApiController;
use App\Http\Controllers\Api\V1\Admin\SettingApiController;
use App\Http\Controllers\Api\V1\Admin\TrashApiController;
use App\Http\Controllers\Api\V1\Admin\UserApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', PermissionApiController::class);

    // Roles
    Route::apiResource('roles', RoleApiController::class);

    // Users
    Route::apiResource('users', UserApiController::class);

    // Draft
    Route::apiResource('drafts', DraftApiController::class);

    // Setting
    Route::apiResource('settings', SettingApiController::class);

    // Sent
    Route::apiResource('sents', SentApiController::class);

    // Trash
    Route::apiResource('trashes', TrashApiController::class);
});
