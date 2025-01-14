<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\userManagementController;
use App\Http\Controllers\admin\communityManagementController;
use App\Http\Controllers\admin\volunteerController;
use App\Http\Controllers\admin\donationController;
use App\Http\Controllers\admin\testimonialController;
use App\Http\Controllers\admin\authController;

use App\Http\Controllers\community\communityVolunteerController;
use App\Http\Controllers\community\communityDonationController;

use App\Http\Controllers\user\authControllerAPI;
use App\Http\Controllers\user\volunteerControllerAPI;
use App\Http\Controllers\user\donationControllerAPI;
use App\Http\Controllers\user\testimonialControllerAPI;
use App\Http\Controllers\user\programControllerAPI;

Route::get('/login', [authController::class, 'index'])->name('login.index');
Route::post('/login', [authController::class, 'authenticate'])->name('login');
Route::get('/register', [authController::class, 'create'])->name('register');
Route::post('/register', [authController::class, 'signup'])->name('register');
Route::get('/logout', [authController::class, 'logout'])->name('logout');

//Admin
Route::resource('/admin/userManagement', userManagementController::class)->middleware('auth');
Route::resource('/admin/communityManagement', communityManagementController::class)->middleware('auth');
Route::resource('/admin/volunteer', volunteerController::class)->middleware('auth');
Route::resource('/admin/donation', donationController::class)->middleware('auth');
Route::resource('/admin/testimonial', testimonialController::class)->middleware('auth');

//Community
Route::resource('/community/communityVolunteer', communityVolunteerController::class)->middleware('auth');
Route::resource('/community/communityDonation', communityDonationController::class)->middleware('auth');

//API User
Route::get('api/user/auth/signup', [authControllerAPI::class, 'signup'])->name('user.signup');
Route::get('api/user/auth/signin', [authControllerAPI::class, 'signin'])->name('user.signin');

Route::resource('api/user/volunteerAPI', volunteerControllerAPI::class);
Route::post('api/user/volunteerAPI/register', [volunteerControllerAPI::class, 'volunteerRegister'])->name('volunteer.register');
Route::resource('api/user/donationAPI', donationControllerAPI::class);
Route::post('api/user/donationAPI/register', [donationControllerAPI::class, 'donationRegister'])->name('donation.register');
Route::resource('api/user/testimonialAPI', testimonialControllerAPI::class);

Route::get('api/user/profile', [authControllerAPI::class, 'getuser'])->name('user.profile');
Route::get('api/user/auth/signout', [authControllerAPI::class, 'signout'])->name('user.signout');
Route::get('api/user/program/searchAPI', [programControllerAPI::class, 'search'])->name('search.program');