<?php

namespace App\Test\TestCase\Service;

use Cake\TestSuite\IntegrationTestTrait;
use App\Service\ArtistsApi;
use Cake\TestSuite\TestCase;

class ArtistsApiTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * This test checks if the Artists API is working correctly and returns the expected data.
     */
    public function testGetArtistsRealCall()
    {
        // Set up the API URL and your API key (you can load it from the .env file)
        $url = 'https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller';
        $apiKey = getenv('ARTISTS_API_KEY'); // Get the API key from environment variables
        
        // Instantiate the ArtistsApi service with the API URL and key
        $artistsApi = new ArtistsApi($url, $apiKey);
        
        // Make the real API call to fetch the artist data
        $artistsData = $artistsApi->getArtists();

        // Check if the response contains the 'json' key
        $this->assertArrayHasKey('json', $artistsData, 'The response should contain the "json" key.');
        echo "Test passed: The response contains the 'json' key.\n";

        // Check if the 'json' data is an array of artists
        $this->assertIsArray($artistsData['json'], 'The "json" key should contain an array of artists.');
        echo "Test passed: The 'json' key contains an array of artists.\n";

        // Verify that the list of artists is not empty
        $this->assertNotEmpty($artistsData['json'], 'The list of artists should not be empty.');
        echo "Test passed: The list of artists is not empty.\n";

        // Check if the first artist in the list has the expected fields
        $firstArtist = $artistsData['json'][0][0]; // Access the first artist in the list
        
        $this->assertArrayHasKey('id', $firstArtist, 'Each artist should have an "id" key.');
        echo "Test passed: The first artist has the 'id' key.\n";
        
        $this->assertArrayHasKey('name', $firstArtist, 'Each artist should have a "name" key.');
        echo "Test passed: The first artist has the 'name' key.\n";

        $this->assertArrayHasKey('twitter', $firstArtist, 'Each artist should have a "twitter" key.');
        echo "Test passed: The first artist has the 'twitter' key.\n";
        
        // Final confirmation that the test passed
        echo "Test passed: The Artists API is working correctly and returned the expected data.\n";
    }
}
