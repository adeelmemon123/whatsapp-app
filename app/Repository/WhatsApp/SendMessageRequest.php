<?php

namespace App\Repository\WhatsApp;

use App\Services\WhatsAppService;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'chatId' => 'required|string',
            'type' => 'required|in:text,image,file,voice,video,sticker,link',
            'text' => 'required_if:type,text,link|nullable|string',
            'url' => 'required_if:type,image,file,voice,video,sticker|nullable|url',
            'filename' => 'required_if:type,file|nullable|string',
            'title' => 'required_if:type,link|nullable|string',
            'description' => 'nullable|string',
        ];
    }

    public function handle(WhatsAppService $whatsapp, string $session)
    {
        switch ($this->type) {
            case 'text':
                return $whatsapp->sendText(
                    $session,
                    $this->chatId,
                    $this->text
                );

            case 'image':
                return $whatsapp->sendImage(
                    $session,
                    $this->chatId,
                    $this->url,
                    $this->text ?? ''
                );

            case 'file':
                return $whatsapp->sendFile(
                    $session,
                    $this->chatId,
                    $this->url,
                    $this->filename
                );

            case 'voice':
                return $whatsapp->sendVoice(
                    $session,
                    $this->chatId,
                    $this->url
                );

            case 'video':
                return $whatsapp->sendVideo(
                    $session,
                    $this->chatId,
                    $this->url,
                    $this->text ?? ''
                );

            case 'sticker':
                return $whatsapp->sendSticker(
                    $session,
                    $this->chatId,
                    $this->url
                );

            case 'link':
                return $whatsapp->sendLinkCustomPreview(
                    $session,
                    $this->chatId,
                    $this->text,
                    $this->title,
                    $this->url,
                    $this->description ?? ''
                );
        }
    }
}
