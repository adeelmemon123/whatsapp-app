<?php

namespace App\Http\Controllers\Admin\WhatsApp;

use App\Http\Controllers\Controller;
use App\Repository\WhatsApp\CreateWhatsAppRequest;
use App\Repository\WhatsApp\DeleteWhatsAppRequest;
use App\Repository\WhatsApp\GetAllWhatsAppRequest;
use App\Repository\WhatsApp\GetQrImageRequest;
use App\Repository\WhatsApp\GetWhatsAppProfileRequest;
use App\Repository\WhatsApp\SendMessageRequest;
use App\Repository\WhatsApp\StartWhatsAppRequest;
use App\Repository\WhatsApp\StopWhatsAppRequest;
use App\Repository\WhatsApp\UpdateProfileRequest;
use App\Services\WhatsAppService;

class WhatsAppController extends Controller
{
    protected WhatsAppService $whatsapp;
    public function __construct(WhatsAppService $whatsapp)
    {
        $this->whatsapp = $whatsapp;
    }

    public function index(GetAllWhatsAppRequest $request)
    {
        $sessions = $request->handle($this->whatsapp);

        return view('whatsapp.index', [
            'sessions' => $sessions,
        ]);
    }

    public function createSession(CreateWhatsAppRequest $request)
    {
        $request->handle($this->whatsapp);

        return redirect()->route('whatsapp.index')->with('success', 'Session created successfully.');
    }



    public function deleteSession(DeleteWhatsAppRequest $request,string $session) {
        $request->handle($this->whatsapp, $session);

        return redirect()->route('whatsapp.index')->with('success', 'Session deleted.');
    }

    public function startSession(StartWhatsAppRequest $request,string $session) {

       $request->handle($this->whatsapp, $session);

        return redirect()->route('whatsapp.index')->with('success', 'Session starting...');
    }

    public function stopSession(StopWhatsAppRequest $request,string $session) {
        $request->handle($this->whatsapp, $session);

        return redirect()->route('whatsapp.index')->with('success', 'Session stopped.');
    }

    public function showQr(string $session)
    {
        return view('whatsapp.qr', ['session' => $session]);
    }

    public function getQrImage(GetQrImageRequest $request,string $session) {
        $response = $request->handle($this->whatsapp, $session);

        if ($response->successful()) {
            return response($response->body())->header('Content-Type', 'image/png');
        }

        return response('QR Code not available.', 404);
    }

    public function showProfile(GetWhatsAppProfileRequest $request,string $session) {
        $profile = $request->handle($this->whatsapp, $session);

        return view('whatsapp.profile', ['session' => $session,'profile' => $profile]);
    }

    public function updateProfile(UpdateProfileRequest $request,string $session) {
        $request->handle($this->whatsapp, $session);

        return back()->with('success','Profile updated successfully.');
    }

    public function showSendForm(string $session)
    {
        return view('whatsapp.send', ['session' => $session]);
    }

    public function sendMessage(SendMessageRequest $request,string $session) {
        $request->handle($this->whatsapp, $session);

        return back()->with('success','Message sent successfully.');
    }
}
