<?php

namespace App\Service;

use Cake\Http\Client;
use Cake\Log\Log;

/**
 * ArtistsApi class
 *
 * A service class to interact with an external artists API.
 */
class ArtistsApi
{
    /**
     * @var string The base URL of the external artists API
     */
    private $url;

    /**
     * @var array The headers for the request, including authorization
     */
    private $headers;

    /**
     * Constructor
     *
     * Initializes the ArtistsApi service with the given URL and optional API key.
     *
     * @param string $url The base URL of the external artists API
     * @param string $apiKey The API Key for authorization (optional)
     */
    public function __construct(string $url, string $apiKey = '')
    {
        $this->url = $url;

        // If an API key is provided, include it in the authorization header
        $this->headers = [
            'Authorization' => 'Basic ' . $apiKey, // Add the API key to the authorization header
        ];
    }

    /**
     * Calls the external artists API and returns the artist data.
     *
     * @return array|null Returns the artist data as an array or null if the request fails
     */
    public function getArtists()
    {
        // Initialize the HTTP client
        $httpClient = new Client();

        try {
            // Perform the GET request to fetch artist data
            $response = $httpClient->get($this->url, [], ['headers' => $this->headers]);

            // Check if the response was successful
            if ($response->isOk()) {
                // Return the JSON response data
                return $response->getJson();
            }

            // Log error if response is not successful
            Log::error('Error accessing the artists API: ' . $response->getStatusCode());
            return null;
        } catch (\Exception $e) {
            // Log any exception that occurs during the API request
            Log::error('Error during the artists API request: ' . $e->getMessage());
            return null;
        }
    }
}
