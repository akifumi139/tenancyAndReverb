<?php

use App\Http\Controllers\ProfileController;
use App\Events\TestEvent;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });

            Route::get('item', function (string $domain) {
                return 'admin world'.$domain;
            });
            Route::get('/', function () {
                return view('welcome');
            });

            Route::get('/dashboard', function (string $domain) {
                return view('dashboard');
            })->middleware(['auth', 'verified'])->name('dashboard');

        
        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
        
        
        
        Route::post('/', function (Request $request) {
        
            TestEvent::dispatch($request->message);
            return response()->json(['message' => 'Event has been sent!']);
        });
        
        require __DIR__.'/auth.php';
    });
}
