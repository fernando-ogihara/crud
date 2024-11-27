<?php

namespace App\Service;

use Cake\Http\Client;
use Cake\Log\Log;

/**
 * ExternalService class
 *
 * This class is designed to make requests to an external API, handling the details of communication for you.
 */
class ExternalService
{
    /**
     * @var string The base URL of the external API
     */
    private $url;

    /**
     * @var array The headers required for the request, including any authorization token.
     */
    private $headers;

    /**
     * Constructor
     *
     * Sets up the external service with the provided API URL and optional API key.
     * The API key is included in the headers to authenticate the requests.
     *
     * @param string $url The base URL of the external API
     * @param string $apiKey The API Key used for authorization (optional)
     */
    public function __construct(string $url, string $apiKey = '')
    {
        $this->url = $url;

        // If an API key is provided, it will be included in the request headers for authorization
        $this->headers = [
            'Authorization' => 'Basic ' . $apiKey, // Adds the API key to the request header
        ];
    }

    /**
     * Makes a GET request to the external API and retrieves the data.
     *
     * This method sends a GET request to the provided URL and handles any errors 
     * that may occur during the request. If the request is successful, it returns 
     * the data from the API as an array. If it fails, it returns null and logs the error.
     *
     * @return array|null The data returned from the API as an array, or null if the request fails.
     */
    public function get()
    {
        // Initialize the HTTP client to send the request
        $httpClient = new Client();

        try {
            // Sending a GET request to the API
            $response = $httpClient->get($this->url, [], ['headers' => $this->headers]);

            // Check if the response was successful (HTTP status 200)
            if ($response->isOk()) {
                return $response->getJson(); // Return the response data as a JSON-decoded array
            }

            // If the response is not successful, log the error status code
            Log::error('Failed to access the external API. Status code: ' . $response->getStatusCode());
            return null;
        } catch (\Exception $e) {
            // If an exception occurs during the request, log the error message
            Log::error('An error occurred while making the request to the external API: ' . $e->getMessage());
            return null;
        }
    }
}
