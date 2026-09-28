<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class WhatsAppService
{
    protected string $baseUrl;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('WAHA_BASE_URL', 'http://localhost:3000'), '/');
        $this->apiKey = env('WAHA_API_KEY');
    }

    protected function client()
    {
        $client = Http::baseUrl($this->baseUrl)
            ->acceptJson()
            ->asJson();

        if (!empty($this->apiKey)) {
            $client->withHeaders(['X-Api-Key' => $this->apiKey]);
        }

        return $client;
    }

    protected function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json() ?? true;
        }

        $error = $response->json('message') ?? $response->body();
        Log::error("WAHA API Error: " . $error);

        throw new Exception("WAHA API Error: " . $error, $response->status());
    }

    public function getSessions(): array
    {
        return $this->handleResponse($this->client()->get('/api/sessions'));
    }

    public function createSession(string $name = 'default'): array
    {
        return $this->handleResponse($this->client()->post('/api/sessions', [
            'name' => $name
        ]));
    }

    public function getSession(string $session): array
    {
        return $this->handleResponse($this->client()->get("/api/sessions/{$session}"));
    }

    public function updateSession(string $session, array $data): array
    {
        return $this->handleResponse($this->client()->put("/api/sessions/{$session}", $data));
    }

    public function deleteSession(string $session): bool
    {
        return $this->handleResponse($this->client()->delete("/api/sessions/{$session}"));
    }

    public function startSession(string $session): array
    {
        return $this->handleResponse($this->client()->post("/api/sessions/{$session}/start"));
    }

    public function stopSession(string $session): array
    {
        return $this->handleResponse($this->client()->post("/api/sessions/{$session}/stop"));
    }

    public function logoutSession(string $session): array
    {
        return $this->handleResponse($this->client()->post("/api/sessions/{$session}/logout"));
    }

    public function getQrCode(string $session)
    {
        return $this->client()->get("/api/{$session}/auth/qr");
    }

    public function requestAuthCode(string $session, string $phoneNumber): array
    {
        return $this->handleResponse($this->client()->post("/api/{$session}/auth/request-code", [
            'phoneNumber' => $phoneNumber
        ]));
    }

    public function getProfile(string $session): array
    {
        return $this->handleResponse($this->client()->get("/api/{$session}/profile"));
    }

    public function setProfileName(string $session, string $name): array
    {
        return $this->handleResponse($this->client()->put("/api/{$session}/profile/name", [
            'name' => $name
        ]));
    }

    public function setProfileStatus(string $session, string $status): array
    {
        return $this->handleResponse($this->client()->put("/api/{$session}/profile/status", [
            'status' => $status
        ]));
    }

    protected function formatChatId(string $chatId): string
    {
        if (!str_contains($chatId, '@')) {
            return $chatId . '@c.us';
        }
        return $chatId;
    }

    public function sendText(string $session, string $chatId, string $text): array
    {
        return $this->handleResponse($this->client()->post('/api/sendText', [
            'session' => $session,
            'chatId' => $this->formatChatId($chatId),
            'text' => $text,
        ]));
    }

    public function sendImage(string $session, string $chatId, string $url, string $caption = ''): array
    {
        return $this->handleResponse($this->client()->post('/api/sendImage', [
            'session' => $session,
            'chatId' => $this->formatChatId($chatId),
            'file' => [
                'url' => $url,
            ],
            'caption' => $caption,
        ]));
    }

    public function sendFile(string $session, string $chatId, string $url, string $filename): array
    {
        return $this->handleResponse($this->client()->post('/api/sendFile', [
            'session' => $session,
            'chatId' => $this->formatChatId($chatId),
            'file' => [
                'url' => $url,
                'filename' => $filename,
            ],
        ]));
    }

    public function sendVoice(string $session, string $chatId, string $url): array
    {
        return $this->handleResponse($this->client()->post('/api/sendVoice', [
            'session' => $session,
            'chatId' => $this->formatChatId($chatId),
            'file' => [
                'url' => $url,
            ],
        ]));
    }

    public function sendVideo(string $session, string $chatId, string $url, string $caption = ''): array
    {
        return $this->handleResponse($this->client()->post('/api/sendVideo', [
            'session' => $session,
            'chatId' => $this->formatChatId($chatId),
            'file' => [
                'url' => $url,
            ],
            'caption' => $caption,
        ]));
    }

    public function sendSticker(string $session, string $chatId, string $url): array
    {
        return $this->handleResponse($this->client()->post('/api/sendSticker', [
            'session' => $session,
            'chatId' => $this->formatChatId($chatId),
            'file' => [
                'url' => $url,
            ],
        ]));
    }

    public function sendLinkCustomPreview(string $session, string $chatId, string $text, string $title, string $url, string $description = ''): array
    {
        return $this->handleResponse($this->client()->post('/api/send/link-custom-preview', [
            'session' => $session,
            'chatId' => $this->formatChatId($chatId),
            'text' => $text,
            'preview' => [
                'title' => $title,
                'url' => $url,
                'description' => $description
            ]
        ]));
    }
}
