<?php

namespace App\Service;

use Cake\Http\Client;
use Cake\Log\Log;

/**
 * ExternalService class
 *
 * A service class that makes requests to an external API.
 */
class ExternalService
{
    /**
     * @var string The base URL of the external API
     */
    private $url;

    /**
     * @var array The headers for the request, including authorization
     */
    private $headers;

    /**
     * Constructor
     *
     * Initializes the external service with the given URL and optional API key.
     *
     * @param string $url The base URL of the external API
     * @param string $apiKey The API Key for authorization (optional)
     */
    public function __construct(string $url, string $apiKey = '')
    {
        $this->url = $url;

        // If the API key is provided, include it in the authorization header
        $this->headers = [
            'Authorization' => 'Basic ' . $apiKey, // Add the API key to the authorization header
        ];
    }

    /**
     * Makes a GET request to the external API and returns the response data.
     *
     * @return array|null Returns the response data as an array, or null on failure
     */
    public function call()
    {
        // Initialize the HTTP client
        $httpClient = new Client();

        try {
            // Perform the GET request
            $response = $httpClient->get($this->url, [], ['headers' => $this->headers]);

            // Check if the response was successful
            if ($response->isOk()) {
                return $response->getJson(); // Return the JSON response data
            }

            // Log error if response is not successful
            Log::error('Error accessing the external API: ' . $response->getStatusCode());
            return null;
        } catch (\Exception $e) {
            // Log any exception that occurs during the request
            Log::error('Error during external API request: ' . $e->getMessage());
            return null;
        }
    }
}
