<?php 

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class IndexTest extends TestCase
{
    use IntegrationTestTrait; // Using the IntegrationTestTrait for integration tests

    /**
     * This test checks if the homepage of the application loads correctly.
     */
    public function testIndexPage()
    {
        // Make the request to the homepage URL ('/')
        $this->get('/'); // The URL you want to test

        // Check if the HTTP status code returned is 200 (success)
        $this->assertResponseCode(200);
        echo "Test passed: Homepage loaded successfully (HTTP 200).\n";

        // Check if the content of the page contains the expected text ('Album')
        $this->assertResponseContains('Album');
        echo "Test passed: The homepage contains the expected text 'Album'.\n";
        
        // Additional message confirming that the test passed
        echo "Test passed: The homepage loaded correctly and contains expected content.\n";
    }
}
