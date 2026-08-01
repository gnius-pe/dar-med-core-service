<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApisperuService
{
    private Client $client;
    private string $token;
    private string $baseUrl;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 10,
            'connect_timeout' => 5,
            'verify' => false,
        ]);

        $this->token = config('services.apisperu.token');
        $this->baseUrl = rtrim(config('services.apisperu.base_url'), '/');
    }

    public function lookupDni(string $dni): ?array
    {
        if (empty($this->token)) {
            throw new \RuntimeException('APISPERU_TOKEN is not configured.');
        }

        $url = "{$this->baseUrl}/dni/{$dni}?token={$this->token}";

        try {
            $response = $this->client->get($url);
            $body = json_decode($response->getBody()->getContents(), true);

            if (isset($body['success']) && $body['success']) {
                $data = $body['data'] ?? $body;
                return $this->mapDniData($data);
            }

            return null;
        } catch (GuzzleException $e) {
            return null;
        }
    }

    private function mapDniData(array $data): array
    {
        $fullName = trim(($data['nombres'] ?? '').' '.($data['apellidoPaterno'] ?? '').' '.($data['apellidoMaterno'] ?? ''));

        return [
            'document_type' => $data['tipoDocumento'] ?? 'DNI',
            'document_number' => $data['numeroDocumento'] ?? null,
            'first_name' => $data['nombres'] ?? null,
            'last_name' => trim(($data['apellidoPaterno'] ?? '').' '.($data['apellidoMaterno'] ?? '')),
            'full_name' => $fullName,
            'raw' => $data,
        ];
    }
}
