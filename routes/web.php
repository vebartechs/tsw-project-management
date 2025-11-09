<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\dashboard\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes ==============================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Protected Routes ==============================
Route::middleware(['auth'])->group(function () {

    // Dashboard------------------
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Employee Routes---------------
    Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employee/list', 'index')->name('employee.index');
    Route::get('/employee/create/{id?}', 'create')->name('employee.create');
    Route::post('/employee/store', 'store')->name('employee.store');
    Route::delete('/employee/{id}/delete', 'destroy')->name('employee.destroy');
    });
    
    // Customer Routes---------------
    Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer/list', 'index')->name('customer.index');
    Route::get('/customer/create/{id?}', 'create')->name('customer.create');
    Route::post('/customer/store', 'store')->name('customer.store');
    Route::delete('/customer/{id}/delete', 'destroy')->name('customer.destroy');

    // Ajax customer
    Route::get('/customer/search-customer', 'searchCustomer')->name('customer.searchCustomer');
    });


    // Project Routes---------------


    Route::controller(ProjectController::class)->group(function () {
    Route::get('/project/list', 'index')->name('project.index');
    Route::get('/project/select-customer', 'selectCustomer')->name('project.selectCustomer');
    Route::get('/project/create/{customer_id}/{project_id?}', 'create')->name('project.create');
    Route::post('/project/store', 'store')->name('project.store');
    Route::get('/project/show/{id}', 'show')->name('project.show');
    Route::delete('/project/{id}/delete', 'destroy')->name('project.destroy');

    });

   

    

});

