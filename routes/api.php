<?php


/*START AUTH*/

Route::group(['prefix' => 'auth', 'as' => 'auth.', 'middleware' => ['throttle:50,1', 'api'],
    'namespace' => 'App\Http\Controllers\Api\V1\Auth'], function () {

    Route::post('login', 'LoginController@process')
        ->name('login');

    Route::post('verification', 'VerificationController@check')
        ->name('verification');

    Route::post('resend', 'ResendController')
        ->name('resend');

    Route::post('forgot', 'ForgotController@forgot')
        ->name('forgot');

    Route::post('update-password', 'ForgotController@update_password')
        ->name('update-password');

    Route::post('logout', 'LoginController@logout')
        ->name('logout')->middleware('auth:sanctum');

});

/*END AUTH*/


/*START USER*/

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['throttle:50,1', 'api', 'auth:sanctum'],
    'namespace' => 'App\Http\Controllers\Api\V1\User'], function () {

    Route::get('profile', 'ProfileController@info')
        ->name('profile');

    Route::put('update-profile', 'ProfileController@update_info')
        ->name('update-profile');;

});

/*END USER*/
