<?php

namespace App\Repository\WhatsApp;

use App\Services\WhatsAppService;
use Illuminate\Foundation\Http\FormRequest;

class GetAllWhatsAppRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

public function handle(WhatsAppService $whatsapp)
{
    return $whatsapp->getSessions();
}
}
