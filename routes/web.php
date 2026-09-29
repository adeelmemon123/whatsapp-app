<?php

use App\Http\Controllers\Admin\WhatsApp\WhatsAppController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes(['verify' => true, 'reset' => true]);

Route::middleware(['auth', 'check.admin'])->prefix('whatsapp')->name('whatsapp.')->group(function () {

        Route::get('/dashboard', [WhatsAppController::class, 'index'])->name('index');

        Route::post('/session', [WhatsAppController::class, 'createSession'])->name('create');

        Route::delete('/session/{session}', [WhatsAppController::class, 'deleteSession'])->name('delete');

        Route::post('/session/{session}/start', [WhatsAppController::class, 'startSession'])->name('start');

        Route::post('/session/{session}/stop', [WhatsAppController::class, 'stopSession'])->name('stop');

        Route::get('/session/{session}/qr', [WhatsAppController::class, 'showQr'])->name('qr');

        Route::get('/session/{session}/qr-image', [WhatsAppController::class, 'getQrImage'])->name('qr.image');

        Route::get('/session/{session}/profile', [WhatsAppController::class, 'showProfile'])->name('profile');

        Route::put('/session/{session}/profile', [WhatsAppController::class, 'updateProfile'])->name('profile.update');

        Route::get('/session/{session}/send', [WhatsAppController::class, 'showSendForm'])->name('send');

        Route::post('/session/{session}/send', [WhatsAppController::class, 'sendMessage'])->name('send.message');
    });


