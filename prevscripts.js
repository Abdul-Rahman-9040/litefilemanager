// scripts.js

// Wait for the DOM to be ready
$(document).ready(function () {
    // Use AJAX to fetch and display notes
    $.ajax({
        url: 'search_prev.php',
        type: 'GET',
        success: function (response) {
            // Update the content of the notes container
            $('#prevContainer').html(response);
        },
        error: function () {
            console.error('Error fetching notes.');
        }
    });
});
