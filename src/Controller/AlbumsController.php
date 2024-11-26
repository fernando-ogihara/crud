<?php 

namespace App\Controller;

use App\Controller\AppController;
use App\Service\ArtistsApi;  // Import the ArtistsApi service class
use App\Model\BusinessLogic\ArtistsData;
use App\Model\BusinessLogic\SendEmail;
use Cake\Log\Log;

class AlbumsController extends AppController
{
    private $artistsApi;

    /**
     * Initialize the controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        // Instantiate the ArtistsApi service with the API URL and API key
        $this->artistsApi = new ArtistsApi(
            'https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller',
            getenv('ARTISTS_API_KEY')
        );
    }

    /**
     * List all albums
     *
     * @return void
     */
    public function index()
    {
        // Get artists from the API
        $artistsData = $this->artistsApi->getArtists();
        $artistsDataObj = new ArtistsData();
        $artists = $artistsDataObj->refactorArtistsData($artistsData);
        
        // Retrieve albums from the database
        $albums = $this->Albums->find('all');

        // Pass the data to the view
        $this->set(compact('albums', 'artists'));
    }

    /**
     * Add a new album
     *
     * @return void
     */
    public function add()
    {
        $album = $this->Albums->newEmptyEntity();  // Create a new album entity

        // Get the list of artists from the API
        $artistsData = $this->artistsApi->getArtists();
        $artistsDataObj = new ArtistsData();
        $artists = $artistsDataObj->refactorArtistsData($artistsData);

        if ($this->request->is('post')) {
            // Load the form data, including the artist_name field
            $album = $this->Albums->patchEntity($album, $this->request->getData());

            // Check if the album data was saved
            if ($this->Albums->save($album)) {
                $this->Flash->success('Album saved successfully.');

                // Call the email sending function
                $notificationAction = new SendEmail();
                $notificationAction->sendConfirmationEmail($album, $artists, 'added');
                
                return $this->redirect(['action' => 'index']);
            }

            // In case of an error saving the album
            $this->Flash->error('Unable to save the album. Please try again.');

            // Log the error message for troubleshooting
            Log::error('Failed to save album data. Album data: ' . print_r($this->request->getData(), true));
        }

        // Pass the data to the view
        $this->set(compact('album', 'artists'));
    }

    /**
     * Edit an existing album
     *
     * @param string|null $id The album ID
     * @return void
     */
    public function edit($id = null)
    {
        if ($id === null) {
            $this->Flash->error(__('ID not provided.'));
            return $this->redirect(['action' => 'index']);
        }

        $album = $this->Albums->get($id);

        // Get the list of artists from the API
        $artistsData = $this->artistsApi->getArtists();
        $artistsDataObj = new ArtistsData();
        $artists = $artistsDataObj->refactorArtistsData($artistsData);

        if (!$album) {
            $this->Flash->error(__('Album not found.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['post', 'put'])) {
            $album = $this->Albums->patchEntity($album, $this->request->getData());

            if ($this->Albums->save($album)) {
                $this->Flash->success(__('Album edited successfully.'));

                // Call the email sending function
                $notificationAction = new SendEmail();
                $notificationAction->sendConfirmationEmail($album, $artists, 'edited');  // Passing the album to the email function
                
                return $this->redirect(['action' => 'index']);
            }

            // Log the error if saving the album fails
            Log::error('Failed to save album. ID: ' . $id . '. Album data: ' . print_r($this->request->getData(), true));

            $this->Flash->error(__('Unable to edit the album.'));
        }

        $this->set(compact('album', 'artists'));
    }


    /**
     * Delete an album
     *
     * @param string $id The album ID
     * @return void
     */
    public function delete($id = null)
    {
        // Check if the ID was provided
        if ($id === null) {
            $this->Flash->error(__('ID not provided.'));
            return $this->redirect(['action' => 'index']);
        }

        // Retrieve the album by ID
        $album = $this->Albums->get($id);

        // Get the list of artists from the API
        $artistsData = $this->artistsApi->getArtists();
        $artistsDataObj = new ArtistsData();
        $artists = $artistsDataObj->refactorArtistsData($artistsData);

        // Attempt to delete the album
        if ($this->Albums->delete($album)) {
            // Display success message
            $this->Flash->success(__('Album deleted successfully.'));
            
            // Call the email sending function
            $notificationAction = new SendEmail();
            $notificationAction->sendConfirmationEmail($album, $artists, 'deleted');  // Passing the album to the email function
            
            // Redirect to the index page or another page
            return $this->redirect(['action' => 'index']);
        } else {
            // If unable to delete the album, display error
            $this->Flash->error(__('The album could not be deleted. Please, try again.'));
            
            // Log the error
            Log::error('Failed to delete album. ID: ' . $id . '. Album data: ' . print_r($album, true));
            
            return $this->redirect(['action' => 'index']);
        }
    }
}
