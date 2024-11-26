// Function to validate the form
export function validateForm(artistId, albumNameId, albumYearId, saveButtonId) {
    var artistName = document.getElementById(artistId);
    var albumName = document.getElementById(albumNameId);
    var albumYear = document.getElementById(albumYearId);
    var saveButton = document.getElementById(saveButtonId);

    // Check if all the fields are valid (filled)
    if (artistName.value && albumName.value && albumYear.value) {
        // Enable the button and add the "enabled" classes
        saveButton.disabled = false;
        saveButton.classList.remove('disable');
        saveButton.classList.add('enable');
        saveButton.style.cursor = "pointer"; // Normal cursor
    } else {
        // Disable the button and add the "disabled" classes
        saveButton.disabled = true;
        saveButton.classList.remove('enable');
        saveButton.classList.add('disable');
        saveButton.style.cursor = "not-allowed"; // "Not allowed" cursor
    }
}