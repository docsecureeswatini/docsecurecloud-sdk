<?php

/**
 * Client documents that initializes and handles the SDK operations
 */

namespace Docsecure\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Docsecure\Sdk\Exceptions\ApiException;
use Docsecure\Sdk\Exceptions\ValidationException;
use Docsecure\Sdk\Exceptions\AuthException;

/**
 * Summary of DocsecureClient
 */

class DocsecureClient
{
    private $httpClient; 
    private $apiUrl;
    private $apiToken;
    private $apiKey;
    private $apiSecret;

    /**
     * Summary of __construct
     * @param string $apiUrl      - Client connection
     * @param string $apiToken    - Token to keep client connection open to API
     * @param string $apiKey      - Client API KEY issued by Docsecure Eswatini
     * @param string $apiSecret   - Client SECRET KEY issued by Docsecure Eswatini
     */
    public function __construct(string $apiUrl, string $apiToken, string $apiKey, string $apiSecret)
    {
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->apiToken = $apiToken;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;

        $this->httpClient = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Authorization' => "Bearer {$this->apiToken}",
                'Accept' => 'application/json',
                'X-API-KEY' => $this->apiKey,
                'X-API-SECRET' => $this->apiSecret,
            ],
        ]);
    }

    /**
     * Summary of request
     * @param string $method - Method to be used for request
     * @param string $endpoint - Endpoint URL for API
     * @param array $data - Data for body
     * @throws \Docsecure\Sdk\Exceptions\AuthException - Exception for authentication error
     * @throws \Docsecure\Sdk\Exceptions\ValidationException - Exception for validation error
     * @throws \Docsecure\Sdk\Exceptions\ApiException - Exception for API connection exception error
     *
     */
    public function request(string $method, string $endpoint, array $data = [])
    {
        try {
            $options = [];

            if (in_array(strtoupper($method), ['POST', 'PUT', 'PATCH'])) {
                $options['json'] = $data; // Send as JSON
            } elseif (!empty($data)) {
                $options['query'] = $data; // Query parameters for GET
            }

            $response = $this->httpClient->request($method, $endpoint, $options);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $httpCode = $e->getResponse()->getStatusCode();
                $responseBody = $e->getResponse()->getBody()->getContents();

                // Handle different error types based on HTTP status codes
                switch ($httpCode) {
                    case 401:
                        throw new AuthException("Invalid API token.");
                    case 422:
                        throw new ValidationException("Validation failed: {$responseBody}");
                    default:
                        throw new ApiException("API Error: {$responseBody}", $httpCode);
                }
            }

            throw new ApiException("Request failed: {$e->getMessage()}");
        }
    }
}
