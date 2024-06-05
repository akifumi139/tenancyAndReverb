<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\ProfileController;
use App\Events\TestEvent;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/



Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });
        
        Route::get('/dashboard', function () {
            Session::put('tenant', tenant()->id);
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
        
        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    
        Route::post('/', function (Request $request) {
        
            TestEvent::dispatch(tenant()->id,$request->message);
            return response()->json(['message' => 'Event has been sent!']);
        });
        
        require __DIR__.'/auth.php';
});
