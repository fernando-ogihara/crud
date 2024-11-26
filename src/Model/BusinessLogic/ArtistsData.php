<?php 

namespace App\Model\BusinessLogic;

class ArtistsData
{
    private $artists;
    public function refactorArtistsData($artistsData) {
        if ($artistsData) {
            // Flatten the artists data
            $flattenedArtists = [];
            foreach ($artistsData as $artistGroup) {
                foreach ($artistGroup as $artist) {
                    $flattenedArtists[] = $artist[0];  // Accessing the array inside each group
                }
            }

            $this->artists = array_column($flattenedArtists, 'name', 'id');
        } else {
            $this->artists = [];
        }
        return $this->artists;
    }
}