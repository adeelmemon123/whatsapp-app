<?php

namespace App\Repository\WhatsApp;

use App\Services\WhatsAppService;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }

    public function handle(WhatsAppService $whatsapp, string $session)
    {
        if ($this->filled('name')) {
            $whatsapp->setProfileName($session, $this->name);
        }

        if ($this->filled('status')) {
            $whatsapp->setProfileStatus($session, $this->status);
        }
    }
}
