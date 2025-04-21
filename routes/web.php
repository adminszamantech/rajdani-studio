<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;


// frontend route
Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/about-us', [HomeController::class, 'profile'])->name('home.profile');
Route::match(['get','post'],'/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/project/{id}', [HomeController::class, 'projects'])->name('home.project');
Route::get('/project/{id}/detsils', [HomeController::class, 'projectsDetails'])->name('home.projectDetails');
Route::get('/career', [HomeController::class, 'career'])->name('home.career');
Route::get('/job-post-details/{jobPost}', [HomeController::class, 'job_post_details'])->name('home.jobPostDetails');
Route::post('/job-apply', [HomeController::class, 'job_apply'])->name('home.jobApply');

//admin route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::resource('project-categories',ProjectCategoryController::class);
    Route::resource('projects',ProjectController::class);
    Route::resource('sliders',SliderController::class);
    Route::resource('clients',ClientController::class);
    Route::resource('messages',MessageController::class);
    Route::resource('profiles',AdminProfileController::class);
    Route::resource('testimonials',TestimonialController::class);
    Route::resource('contacts',ContactController::class);
    Route::resource('job-posts',JobPostController::class);
    Route::get('job-applied-lists/{jobPost}',[JobPostController::class,'job_applied_lists'])->name('jobAppliedLists');
    Route::get('job-applied-status',[JobPostController::class,'job_applied_status'])->name('jobAppliedStatus');
    Route::match(['get','post'],'/website-settings',[SettingController::class,'website_setting'])->name('websiteSetting');
    Route::match(['get','post'],'/profile-settings',[SettingController::class,'profile_setting'])->name('profileSetting');
});

require __DIR__.'/auth.php';

Route::get('/clear', function () {
    Artisan::call('cache:clear'); Artisan::call('config:clear'); Artisan::call('config:cache'); Artisan::call('view:clear'); Artisan::call('route:clear'); Artisan::call('optimize:clear'); Artisan::call('storage:link');
    return "Cleared!";
});
