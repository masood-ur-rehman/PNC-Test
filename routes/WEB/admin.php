<?php
/**
 * Created by PhpStorm.
 * User: masood
 * Date: 1/21/2020
 * Time: 6:49 PM
 */

Route::group([
    'namespace'=>'web\admin', 'as'=>'admin::'

], function(){
    Route::middleware(['auth'])->group(function () {
        Route::resource('company', 'CompaniesController');
        Route::resource('employee', 'EmployeeController');
    });
});
