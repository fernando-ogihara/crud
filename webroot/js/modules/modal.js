// modal.js

// Function to show the delete confirmation modal
export function showDeleteConfirmation(albumId) {
    // Create modal elements
    var modal = document.createElement('div');
    modal.classList.add('modal');
    
    var modalContent = document.createElement('div');
    modalContent.classList.add('modal-content');
    modal.appendChild(modalContent);

    var modalHeader = document.createElement('div');
    modalHeader.classList.add('modal-header');
    modalHeader.innerHTML = "<span class='close'>&times;</span><h2>Are you sure?</h2>";
    modalContent.appendChild(modalHeader);

    var modalBody = document.createElement('div');
    modalBody.classList.add('modal-body');
    modalBody.innerHTML = "Do you want to delete this album?";
    modalContent.appendChild(modalBody);

    var modalFooter = document.createElement('div');
    modalFooter.classList.add('modal-footer');
    var cancelButton = document.createElement('button');
    cancelButton.classList.add('cancel-btn');
    cancelButton.innerHTML = "Cancel";
    var confirmButton = document.createElement('button');
    confirmButton.classList.add('confirm-btn');
    confirmButton.innerHTML = "Delete";
    
    // Append buttons to modal footer
    modalFooter.appendChild(cancelButton);
    modalFooter.appendChild(confirmButton);
    modalContent.appendChild(modalFooter);

    // Append modal to the body
    document.body.appendChild(modal);

    // When the user clicks on cancel button, close the modal
    cancelButton.onclick = function() {
        modal.style.display = 'none'; // Hide the modal
    }

    // When the user clicks on the confirm button, proceed with the deletion
    confirmButton.onclick = function() {
        var form = document.createElement('form');
        form.method = 'post';
        form.action = '/albums/delete/' + albumId;

        // Create a hidden input field for the DELETE method
        var inputMethod = document.createElement('input');
        inputMethod.type = 'hidden';
        inputMethod.name = '_method';
        inputMethod.value = 'DELETE';
        form.appendChild(inputMethod);

        // Create a hidden input field for the CSRF token
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_csrfToken';
        csrfTokenInput.value = document.querySelector('meta[name="csrfToken"]').getAttribute('content');
        form.appendChild(csrfTokenInput);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();

        // Hide the modal after submission
        modal.style.display = 'none';
    }

    // When the user clicks on the close button (X), hide the modal
    var closeButton = modalHeader.querySelector('.close');
    closeButton.onclick = function() {
        modal.style.display = 'none'; // Hide the modal
    }

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none'; // Hide the modal
        }
    }

    // Show the modal
    modal.style.display = 'block';
}
