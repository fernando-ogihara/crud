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
        // Instantiating the ArtistsApi service
        $artistsApi = new ArtistsApi(getenv('ARTISTS_API_KEY'));
        
        // Making the real API call to fetch artist data
        $artistsData = $artistsApi->getArtists();

        // Checking if the response is an array
        $this->assertIsArray($artistsData, 'The response should be an array of artists.');
        echo "Test passed: The response is an array.\n";

        // Checking if the array contains at least one artist
        $this->assertNotEmpty($artistsData, 'The list of artists should not be empty.');
        echo "Test passed: The list of artists is not empty.\n";

        // Checking if the first item in the array has an id and name
        $firstArtistId = key($artistsData);  // Getting the key of the first artist (ID)
        $firstArtistName = current($artistsData);  // Getting the value of the first artist (name)

        $this->assertEquals(1, $firstArtistId, 'The first artist should have ID 1.');
        echo "Test passed: The first artist has ID 1.\n";
        
        $this->assertEquals('Justin Bieber', $firstArtistName, 'The first artist should be "Justin Bieber".');
        echo "Test passed: The first artist is Justin Bieber.\n";
        
        // Checking if there is a match for the artist Katy Perry
        $this->assertArrayHasKey(2, $artistsData, 'The response should contain the artist with ID 2.');
        $this->assertEquals('Katy Perry', $artistsData[2], 'The artist with ID 2 should be "Katy Perry".');
        echo "Test passed: The artist with ID 2 is Katy Perry.\n";

        // Checking if the last artist has the correct name
        $lastArtistId = end(array_keys($artistsData));  // Getting the ID of the last artist
        $lastArtistName = end($artistsData);  // Getting the name of the last artist

        $this->assertEquals(19, $lastArtistId, 'The last artist should have ID 19.');
        echo "Test passed: The last artist has ID 19.\n";

        $this->assertEquals('Lil Wayne', $lastArtistName, 'The last artist should be "Lil Wayne".');
        echo "Test passed: The last artist is Lil Wayne.\n";
        
        // Final confirmation that the test passed
        echo "Test passed: The Artists API is working correctly and returned the expected data.\n";
    }
}
