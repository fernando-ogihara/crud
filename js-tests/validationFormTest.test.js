import { validateForm } from '../webroot/js/modules/validateForm';

describe('Test the validateForm function', () => {
  let artistNameInput, albumNameInput, albumYearInput, saveButton;

  beforeEach(() => {
    // Set up the DOM elements before each test
    document.body.innerHTML = `
      <input type="text" id="artistName" />
      <input type="text" id="albumName" />
      <input type="number" id="albumYear" />
      <button id="saveButton" class="disable" disabled></button>
    `;

    // Get references to the DOM elements
    artistNameInput = document.getElementById('artistName');
    albumNameInput = document.getElementById('albumName');
    albumYearInput = document.getElementById('albumYear');
    saveButton = document.getElementById('saveButton');
  });

  test('should enable the button when all fields are filled', () => {
    // Fill in the form fields
    artistNameInput.value = 'Artist Name';
    albumNameInput.value = 'Album Name';
    albumYearInput.value = '2023';

    // Call the validateForm function
    validateForm('artistName', 'albumName', 'albumYear', 'saveButton');

    // Check if the button is enabled
    expect(saveButton.disabled).toBe(false);
    expect(saveButton.classList.contains('enable')).toBe(true);
    expect(saveButton.classList.contains('disable')).toBe(false);
    expect(saveButton.style.cursor).toBe('pointer');
  });

  test('should disable the button when one field is empty', () => {
    // Fill in only two fields
    artistNameInput.value = 'Artist Name';
    albumNameInput.value = 'Album Name';
    albumYearInput.value = '';

    // Call the validateForm function
    validateForm('artistName', 'albumName', 'albumYear', 'saveButton');

    // Check if the button is disabled
    expect(saveButton.disabled).toBe(true);
    expect(saveButton.classList.contains('disable')).toBe(true);
    expect(saveButton.classList.contains('enable')).toBe(false);
    expect(saveButton.style.cursor).toBe('not-allowed');
  });

  test('should disable the button when all fields are empty', () => {
    // Leave all fields empty
    artistNameInput.value = '';
    albumNameInput.value = '';
    albumYearInput.value = '';

    // Call the validateForm function
    validateForm('artistName', 'albumName', 'albumYear', 'saveButton');

    // Check if the button is disabled
    expect(saveButton.disabled).toBe(true);
    expect(saveButton.classList.contains('disable')).toBe(true);
    expect(saveButton.classList.contains('enable')).toBe(false);
    expect(saveButton.style.cursor).toBe('not-allowed');
  });
});
