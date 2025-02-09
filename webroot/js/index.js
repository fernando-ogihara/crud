import { validateForm } from './modules/validateForm.js';
import { addEditEventListener } from './modules/editAlbum.js';
import { showDeleteConfirmation } from './modules/modal.js';

document.addEventListener("DOMContentLoaded", function() {
    // Select the success message
    const flashMessage = document.querySelector('.message.success');
    
    if (flashMessage) {
        // Hide the flash message after 1.5 seconds
        setTimeout(function() {
            flashMessage.style.display = 'none';
        }, 1500);
    }
});

// Function to show/hide the "Add Album" form
document.getElementById('add-album-btn').onclick = function() {
    var noAlbum = document.getElementById('no-albums-message')
    var form = document.getElementById('add-album-form');

    // Toggle the 'show' class for smooth visibility transition
    if (form.style.display === 'none' || form.style.display === '') {
        if (noAlbum) {
            noAlbum.style.display = 'none';
        }
        form.style.display = 'block';
        setTimeout(() => form.classList.add('show'), 10); // Add class after display is set
    } else {
        if (noAlbum) {
            noAlbum.style.display = 'block';
        }
        form.classList.remove('show');
        setTimeout(() => form.style.display = 'none', 500); // Set display to 'none' after transition
    }
};

// Function to show/hide the "Edit Album" form and add event listeners to the fields
function toggleEditAlbumForm() {
    const form = document.getElementById('edit-album-form');
    
    // Check visibility of the form
    if (form && form.style.display !== 'none') {
        document.getElementById('edit-artist-id').addEventListener('change', function() {
            validateForm('edit-artist-id', 'edit-name', 'edit-year', 'save-changes-btn');
        });
        document.getElementById('edit-name').addEventListener('input', function() {
            validateForm('edit-artist-id', 'edit-name', 'edit-year', 'save-changes-btn');
        });
        document.getElementById('edit-year').addEventListener('change', function() {
            validateForm('edit-artist-id', 'edit-name', 'edit-year', 'save-changes-btn');
        });
    }
}

// Event listener for editing an album (this will need to be executed when the form is shown)
addEditEventListener();

// Add event listener for all "Delete" buttons
document.querySelectorAll('.delete-album-btn').forEach(button => {
    button.addEventListener('click', function() {
        var albumId = this.getAttribute('data-album-id');  // Get albumId from the data attribute
        showDeleteConfirmation(albumId);  // Pass the albumId to the function
    });
});

// Add validation events to the "Add Album" form
document.getElementById('add-artist-id').addEventListener('change', function() {
    validateForm('add-artist-id', 'add-name', 'add-year', 'add-album-btn-save');
});
document.getElementById('add-name').addEventListener('input', function() {
    validateForm('add-artist-id', 'add-name', 'add-year', 'add-album-btn-save');
});
document.getElementById('add-year').addEventListener('change', function() {
    validateForm('add-artist-id', 'add-name', 'add-year', 'add-album-btn-save');
});
