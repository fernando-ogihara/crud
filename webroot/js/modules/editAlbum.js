import { validateForm } from './validateForm.js';

export function showEditForm(id, name, year, artistId) {
    // Fill in the fields with the album data
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-year').value = year;
    document.getElementById('edit-artist-id').value = artistId;
    document.getElementById('edit-id').value = id;

    // Select the edit form
    var form = document.getElementById('edit-album-form');
    
    // Check if the form is visible
    if (form.classList.contains('show')) {
        // Remove the 'show' class to start the transition
        form.classList.remove('show');
        
        // Delay to ensure the transition happens before hiding
        setTimeout(() => {
            form.style.display = 'none';  // Set to 'none' after the transition
        }, 500);  // Adjust the time according to the transition duration (0.5s)
    } else {
        // Show the form
        form.style.display = 'block';
        
        // Add 'show' class to start the smooth transition
        setTimeout(() => {
            form.classList.add('show');
        }, 10);  // Delay to ensure the 'display' changes before the animation
    }

    // Call the validation function for the edit fields
    validateForm('edit-artist-id', 'edit-name', 'edit-year', 'save-changes-btn');
}

export function addEditEventListener() {
    // Call the validation function for the edit fields
    document.querySelectorAll('.edit-album-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Get the album data from the button data attributes
            var id = this.getAttribute('data-id');
            var name = this.getAttribute('data-name');
            var year = this.getAttribute('data-year');
            var artist = this.getAttribute('data-artist');

            // Call the function to display the edit form with the album data
            showEditForm(id, name, year, artist);
        });
    });
}
