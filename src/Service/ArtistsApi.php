<?php

namespace App\Service;

use App\Model\BusinessLogic\ArtistsData;
use Exception;

/**
 * ArtistsApi class
 *
 * This class interacts with an external API to fetch artist data and processes it.
 */
class ArtistsApi
{
    /**
     * @var ExternalService The service used to communicate with the external API
     */
    private $externalService;

    /**
     * Constructor
     *
     * Sets up the ArtistsApi service by initializing the external API communication service.
     * The external service will handle making the API requests and authorization.
     *
     * @param string $apiKey The API Key for authorization (optional)
     */
    public function __construct(string $apiKey = '')
    {
        // The base URL of the external API that provides the artist data
        $url = 'https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller';

        // Initialize the ExternalService with the API URL and the API key (either passed or fetched from env)
        $this->externalService = new ExternalService($url, $apiKey ?: getenv('ARTISTS_API_KEY'));
    }

    /**
     * Fetches artist data from the external API and processes it.
     *
     * This method calls the external API via the `ExternalService`, then processes the
     * returned data using the `ArtistsData` class. If any error occurs during the process,
     * an exception is thrown.
     *
     * @return array|null Returns the artist data as an array or null if there was an error
     * @throws Exception If there's an error retrieving or processing the data
     */
    public function getArtists(): array
    {
        // Use the ExternalService to fetch artist data
        $artistsData = $this->externalService->get();

        // If no data is returned (or if an error occurs), throw an exception
        if (!$artistsData) {
            throw new Exception('Failed to fetch artist data from the external API.');
        }

        // Process the raw artist data using the ArtistsData class to refactor it
        $artistsDataObj = new ArtistsData();
        return $artistsDataObj->refactorArtistsData($artistsData);  // Refactor the data to match the desired structure
    }
}
