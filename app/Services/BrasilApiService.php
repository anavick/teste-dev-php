<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class BrasilApiService
{
    private $baseUrl = 'https://brasilapi.com.br/api';

    public function getCnpjInfo(string $cnpj)
    {
        try {
            $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

            $response = Http::timeout(30)
                ->withOptions([
                    'verify' => false,
                ])
                ->get("{$this->baseUrl}/cnpj/v1/{$cnpj}");

            if ($response->successful()) {
                return $response->json();
            }
            if ($response->status() === 404) {
                throw new Exception('CNPJ não encontrado');
            }
            throw new Exception('Erro ao consultar CNPJ');

        } catch (Exception $e) {
            throw new Exception('Erro ao consultar CNPJ: ' . $e->getMessage());
        }
    }
}
