<?php

namespace App\Repository\WhatsApp;

use App\Services\WhatsAppService;
use Illuminate\Foundation\Http\FormRequest;

class CreateWhatsAppRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function handle(WhatsAppService $whatsapp)
    {
        return $whatsapp->createSession($this->name);
    }
}
