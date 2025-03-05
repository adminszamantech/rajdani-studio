<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\MissionVissionController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// frontend route
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('home.gallery');
Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile');
Route::get('/mission-vission', [HomeController::class, 'missionVission'])->name('home.missionVission');
Route::match(['get','post'],'/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/service/{id}', [HomeController::class, 'services'])->name('home.service');
Route::get('/service/{id}/detsils', [HomeController::class, 'servicesDetails'])->name('home.serviceDetails');
Route::get('/project/{id}', [HomeController::class, 'projects'])->name('home.project');
Route::get('/project/{id}/detsils', [HomeController::class, 'projectsDetails'])->name('home.projectDetails');
Route::get('/message', [HomeController::class, 'message'])->name('home.message');

//admin route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');

    Route::resource('service-categories',ServiceCategoryController::class);
    Route::resource('services',ServiceController::class);
    Route::resource('project-categories',ProjectCategoryController::class);
    Route::resource('projects',ProjectController::class);
    Route::resource('sliders',SliderController::class);
    Route::resource('testimonials',TestimonialController::class);
    Route::resource('galleries',GalleryController::class);
    Route::resource('mission-vissions',MissionVissionController::class);
    Route::resource('messages',MessageController::class);
    Route::resource('profiles',AdminProfileController::class);
    Route::resource('contacts',ContactController::class);

    Route::match(['get','post'],'/website-settings',[SettingController::class,'website_setting'])->name('websiteSetting');
    Route::match(['get','post'],'/profile-settings',[SettingController::class,'profile_setting'])->name('profileSetting');
});

require __DIR__.'/auth.php';

Route::get('/clear', function () {
    Artisan::call('cache:clear'); Artisan::call('config:clear'); Artisan::call('config:cache'); Artisan::call('view:clear'); Artisan::call('route:clear'); Artisan::call('optimize:clear'); Artisan::call('storage:link');
    return "Cleared!";
});
