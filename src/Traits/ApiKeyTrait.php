<?php

namespace App\Traits;

trait ApiKeyTrait
{
    // API key name should be delivered in class via setApiKeyName method.
    // API key value, should be set in .env file.
    private ?string $apiKeyName = NULL;

    private function getApiKey(): string
    {
        $apiKey = $_ENV[$this->apiKeyName] ?? '';

        if (empty($apiKey)) {
            throw new \RuntimeException($this->apiKeyName.' API key not found');
        }

        return $apiKey;
    }

    protected function setApiKeyName(string $apiKeyName) {
        $this->apiKeyName = $apiKeyName;
    }
}