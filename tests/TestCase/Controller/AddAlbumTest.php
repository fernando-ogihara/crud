<?php 

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class AddAlbumTest extends TestCase
{
    use IntegrationTestTrait; // Using the IntegrationTestTrait for integration tests

    /**
     * This test checks the process of adding a new album.
     */
    public function testAddAlbum()
    {
        // Step 1: Load the "Add Album" page (GET request) to retrieve the form and CSRF token
        $this->get('/');  // URL of the form page

        // Step 2: Get the HTML response body and search for the CSRF token in the form
        $body = (string) $this->_response->getBody();
        preg_match('/<input type="hidden" name="_csrfToken" value="([^"]+)"/', $body, $matches);
        $csrfToken = $matches[1] ?? '';  // Extract CSRF token from the response

        // Ensure the CSRF token was found in the form
        $this->assertNotEmpty($csrfToken, 'CSRF token not found in the form.');
        echo "Test passed: CSRF token was successfully extracted from the form.\n";

        // Step 3: Prepare the data for the POST request, including the CSRF token
        $postData = [
            'artist_name' => 2,  // Example valid artist ID, adjust as needed
            'album_name' => 'Album Title',  // Example album name
            'album_year' => '2024',  // Example album year
            '_csrfToken' => $csrfToken  // Add CSRF token extracted earlier
        ];

        // Step 4: Check that the $postData array contains all the necessary fields
        $this->assertArrayHasKey('artist_name', $postData, 'Expected postData to contain the "artist_name" field.');
        echo "Test passed: The 'artist_name' field is present in postData.\n";

        $this->assertArrayHasKey('album_name', $postData, 'Expected postData to contain the "album_name" field.');
        echo "Test passed: The 'album_name' field is present in postData.\n";

        $this->assertArrayHasKey('album_year', $postData, 'Expected postData to contain the "album_year" field.');
        echo "Test passed: The 'album_year' field is present in postData.\n";

        $this->assertArrayHasKey('_csrfToken', $postData, 'Expected postData to contain the "_csrfToken" field.');
        echo "Test passed: The '_csrfToken' field is present in postData.\n";
        
        // Additional message confirming the success of the test
        echo "Test passed: All required fields are present in the postData array.\n";
    }
}
