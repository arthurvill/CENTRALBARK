<?php

// Facades
use Illuminate\Support\Facades\{Artisan,Auth,Route};

// Shared Restful Controllers
use App\Http\Controllers\All\{
    DownloadResultController,
    ProfileController,
    TmpImageUploadController
};

// Admin Restful Controllers
use App\Http\Controllers\Admin\{
    DashboardController,
    ActivityLogController,
    BookingController as AdminBookingController,
    CategoryController,
    CustomerController,
    GeneralReportController,
    PaymentMethodController,
    PetController,
    PrescriptionController,
    PrintController,
    ResultController as AdminResultController,
    ScheduleController,
    ServiceCategoryController,
    ServiceController,
    SettingsController,
    StaffController,
    UserController,
    VaccinationHistoryController
};

use App\Http\Controllers\Staff\{
    ActivityLogController as StaffActivityLogController,
    BookingController as StaffBookingController,
    CategoryController as StaffCategoryController,
    CustomerController as StaffCustomerController,
    DashboardController as StaffDashboardController,
    GeneralReportController as StaffGeneralReportController,
    PetController as StaffPetController,
    PrescriptionController as StaffPrescriptionController,
    PrintController as StaffPrintController,
    ResultController as StaffResultController,
    ScheduleController as StaffScheduleController,
    ServiceCategoryController as StaffServiceCategoryController,
    ServiceController as StaffServiceController,
    UserController as StaffUserController,
    VaccinationHistoryController as StaffVaccinationHistoryController
};

// Auth Restful Controller
use App\Http\Controllers\Auth\{
    AuthController
};

// Customer Restful Controller
use App\Http\Controllers\Customer\{
    BookingController,
    PetController as CustomerPetController,
    ResultController,
    ScheduleController as CustomerScheduleController,
    ServiceController as CustomerServiceController
};

// Main
use App\Http\Controllers\Main\{
    PagesController
};


// caching
Route::get('/cache', function () {
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    return 'cache';
});

Route::get('/symlink', function () {
    symlink('/home/u414782032/hpvc/storage/app/public', '/home/u414782032/domains/sitedomain.xyz/public_html/sub_hpvc/storage');
});


// Guest
Route::group(['as' => 'main.'],function() {

     Route::controller(PagesController::class)->group(function () {
        Route::get('/', 'home')->name('pages.home');
        Route::get('/about', 'about')->name('pages.about');
        Route::get('/faqs', 'faqs')->name('pages.faqs');
    });

});


// Admin 
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'],function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard.index');

    /** Start Pet Management */
        Route::resource('categories', CategoryController::class);
        Route::resource('pets', PetController::class);
        Route::resource('pets.vaccination_histories', VaccinationHistoryController::class);
    /** End Pet Management */

    /** Start User Management */
        Route::resource('staffs', StaffController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('users', UserController::class);
    /** End User Management */

    /** Start Service Management */
        Route::resource('service_categories', ServiceCategoryController::class);
        Route::resource('services', ServiceController::class);
    /** End Service Management */

    /** Start Appointment / Booking Management */
        Route::resource('schedules', ScheduleController::class);
        Route::resource('payment_methods', PaymentMethodController::class);
        Route::resource('bookings', AdminBookingController::class);
        //Route::get('/bookings/{booking}/results/{result}', AdminResultController::class)->name('bookings.results.show');
        Route::resource('bookings.results', AdminResultController::class);
        Route::resource('bookings.prescriptions', PrescriptionController::class);
    /** End Appointment / Booking Management */


    Route::get('general_reports', GeneralReportController::class)->name('general_reports.index');

    Route::get('activity_logs', ActivityLogController::class)->name('activity_logs.index');

    Route::resource('settings', SettingsController::class);

    Route::get('print', PrintController::class)->name('print.handle');

});


// Staff
Route::group(['middleware' => ['auth', 'staff'], 'prefix' => 'staff', 'as' => 'staff.'],function() {
    Route::get('dashboard', StaffDashboardController::class)->name('dashboard.index');


    /** Start Pet Management */
       Route::resource('categories', StaffCategoryController::class);
       Route::resource('pets', StaffPetController::class);
       Route::resource('pets.vaccination_histories', StaffVaccinationHistoryController::class);
   /** End Pet Management */

   /** Start User Management */
       Route::resource('customers', StaffCustomerController::class);
       Route::resource('users', StaffUserController::class);
       
   /** End User Management */

   
    /** Start Service Management */
        Route::resource('service_categories', StaffServiceCategoryController::class);
        Route::resource('services', StaffServiceController::class);
    /** End Service Management */


     /** Start Appointment / Booking Management */
        Route::resource('schedules', StaffScheduleController::class);
        Route::resource('bookings', StaffBookingController::class);
        Route::resource('bookings.results', StaffResultController::class);
        Route::resource('bookings.prescriptions', StaffPrescriptionController::class);
    /** End Appointment / Booking Management */

    Route::get('general_reports', StaffGeneralReportController::class)->name('general_reports.index');

    Route::get('activity_logs', StaffActivityLogController::class)->name('activity_logs.index');

    Route::get('print', StaffPrintController::class)->name('print.handle');
   
});


// Customer
Route::group(['middleware' => ['auth', 'customer'], 'prefix' => 'customer', 'as' => 'customer.'],function() {
    Route::get('clinic/services', CustomerServiceController::class)->name('services.index');
    Route::get('clinic/services/{service}/schedules', CustomerScheduleController::class)->name('services.schedules.index');
    Route::resource('clinic/services.schedules.bookings', BookingController::class)->only('create', 'store');
    Route::resource('bookings', BookingController::class)->only('index', 'show');
    Route::get('bookings/{booking}/results/{result}', ResultController::class)->name('bookings.results.show');


    Route::resource('pets', CustomerPetController::class);

});


// Auth
Route::group(['middleware' => ['auth']],function() {
    Route::delete('tmp_upload/revert', [TmpImageUploadController::class, 'revert']);     // TMP FILE UPLOAD
    Route::resource('tmp_upload', TmpImageUploadController::class);
    Route::resource('profile', ProfileController::class)->parameter('profile', 'user');

    Route::get('/download/{result}', DownloadResultController::class)->name('results.download');

});


// Custom Authentication
Route::group(['as' => 'auth.'], function () {

    // Auth Routes
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'attemptLogin')->name('attempt_login');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'attemptRegister')->name('attempt_register');
        Route::post('/logout', 'logout')->name('logout');

        // email verification

        Route::get('/email/verify/{token}', 'emailVerification')->name('email_verification');
    });
});


Auth::routes(['login' => false, 'register' => false, 'logout' => false]);