<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\userManagementController;
use App\Http\Controllers\admin\communityManagementController;
use App\Http\Controllers\admin\volunteerController;
use App\Http\Controllers\admin\donationController;
use App\Http\Controllers\admin\testimonialController;

use App\Http\Controllers\user\volunteerControllerAPI;
use App\Http\Controllers\user\donationControllerAPI;
use App\Http\Controllers\user\testimonialControllerAPI;

Route::resource('/admin/userManagement', userManagementController::class);
Route::resource('/admin/comunityManagement', communityManagementController::class);
Route::resource('/admin/volunteer', volunteerController::class);
Route::resource('/admin/donation', donationController::class);
Route::resource('/admin/testimonial', testimonialController::class);

Route::resource('/user/volunteer', volunteerControllerAPI::class);
Route::resource('/user/donation', donationControllerAPI::class);
Route::resource('/user/testimonial', testimonialControllerAPI::class);