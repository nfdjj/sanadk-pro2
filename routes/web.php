<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WhyUsController;
use App\Http\Controllers\WhoUsController;
use App\Http\Controllers\OpinionController;
use App\Models\Hero;
use App\Models\Opinion;
use App\Models\Service;
use App\Models\WhyUs;
use App\Models\WhoUs;

// Route::get('/', function () {
//     return view('welcome');
// }
Route::get('/', function () {
    $hero = Hero::first();
    $service = Service::first();
    $whyus = WhyUs::first();
    $whous = WhoUs::first();

    $opinions = Opinion::where('approval_status', 'approved')
        ->orderByDesc('created_at')
        ->get();

    return view('index', compact(
        'hero',
        'service',
        'whyus',
        'whous',
        'opinions'
    ));})->name('index');

Route::get('/admin-secure-x7K9mP2qL5nR8', function () {
    // إذا كان مسجل دخول بالفعل، إعادة توجيه للوحة التحكم
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('admin.login');
})->name('admin.login');

Route::get('/admin-secure-dashboard', function () {
    $hero = Hero::first();
    $service = Service::first();
    $whyus = WhyUs::first();
    $whous = WhoUs::first();
    $opinionsCount = Opinion::count();
    return view('admin.dashboard', compact('hero', 'service', 'whyus', 'whous', 'opinionsCount'));
})->name('admin.dashboard')->middleware('admin.auth');

Route::get('/admin-secure-account', function () {
    return view('admin.account');
})->name('admin.account')->middleware('admin.auth');

Route::get('/hero', [HeroController::class, 'getHero']);
Route::put('/hero', [HeroController::class, 'saveHero'])->middleware('admin.auth');
Route::delete('/hero', [HeroController::class, 'deleteHero'])->middleware('admin.auth');
Route::get('/service', [ServiceController::class, 'getService']);
Route::put('/service', [ServiceController::class, 'saveService'])->middleware('admin.auth');
Route::delete('/service', [ServiceController::class, 'deleteService'])->middleware('admin.auth');
Route::get('/whyus', [WhyUsController::class, 'getWhyUs']);
Route::put('/whyus', [WhyUsController::class, 'saveWhyUs'])->middleware('admin.auth');
Route::delete('/whyus', [WhyUsController::class, 'deleteWhyUs'])->middleware('admin.auth');
Route::get('/whous', [WhoUsController::class, 'getWhoUs']);
Route::put('/whous', [WhoUsController::class, 'saveWhoUs'])->middleware('admin.auth');
Route::delete('/whous', [WhoUsController::class, 'deleteWhoUs'])->middleware('admin.auth');

Route::get('/opinions', [OpinionController::class, 'index']);
Route::post('/opinions', [OpinionController::class, 'store']);
Route::post('/opinions/{id}/approve', [OpinionController::class, 'approve'])->middleware('admin.auth');
Route::delete('/opinions/{id}', [OpinionController::class, 'destroy'])->middleware('admin.auth');

Route::get('/reviews', function () {
    $opinions = Opinion::orderByDesc('created_at')->get();

    $opinionsCount = $opinions->count();

    return view('reviews', compact('opinions', 'opinionsCount'));
})->name('reviews');






// Admin Authentication Routes
use App\Http\Controllers\Admin\AuthController;

Route::prefix('admin-secure')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('admin.auth.register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/account', [AuthController::class, 'showAccount'])->name('admin.auth.account')->middleware('admin.auth');
    Route::put('/account/password', [AuthController::class, 'updatePassword'])->name('admin.auth.update.password')->middleware('admin.auth');
    Route::put('/account/email', [AuthController::class, 'updateEmail'])->name('admin.auth.update.email')->middleware('admin.auth');
});

// Original admin route for content management - now protected
Route::get('/admin-secure-x7K9mP2qL5nR8', function () {
    // إذا كان مسجل دخول بالفعل، إعادة توجيه للوحة التحكم
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('admin.login');
})->name('admin.login');


// Protected admin content management route (original admin page)
Route::get('/admin', function () {
    $hero = Hero::first();
    $service = Service::first();
    $whyus = WhyUs::first();
    $whous = WhoUs::first();
    $opinionsCount = Opinion::count();
    return view('admin', compact('hero', 'service', 'whyus', 'whous', 'opinionsCount'));
})->name('admin')->middleware('admin.auth');