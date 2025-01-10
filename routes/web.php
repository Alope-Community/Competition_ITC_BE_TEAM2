<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\userManagementController;
use App\Http\Controllers\admin\communityManagementController;
use App\Http\Controllers\admin\volunteerController;
use App\Http\Controllers\admin\donationController;
use App\Http\Controllers\admin\testimonialController;
use App\Http\Controllers\admin\authController;

use App\Http\Controllers\user\authControllerAPI;
use App\Http\Controllers\user\volunteerControllerAPI;
use App\Http\Controllers\user\donationControllerAPI;
use App\Http\Controllers\user\testimonialControllerAPI;
use App\Http\Controllers\user\programControllerAPI;

Route::resource('/admin/auth', authController::class);
Route::resource('/admin/userManagement', userManagementController::class);
Route::resource('/admin/communityManagement', communityManagementController::class);
Route::resource('/admin/volunteer', volunteerController::class);
Route::resource('/admin/donation', donationController::class);
Route::resource('/admin/testimonial', testimonialController::class);

Route::post('api/user/auth/signup', [authControllerAPI::class, 'signup'])->name('user.signup');
Route::post('api/user/auth/signin', [authControllerAPI::class, 'signin'])->name('user.signin');
Route::post('api/user/auth/signout', [authControllerAPI::class, 'signout'])->name('user.signout');
Route::resource('api/user/volunteerAPI', volunteerControllerAPI::class);
Route::resource('api/user/donationAPI', donationControllerAPI::class);
Route::resource('api/user/testimonialAPI', testimonialControllerAPI::class);
Route::get('api/user/program/searchAPI', [programControllerAPI::class, 'search'])->name('search.program');