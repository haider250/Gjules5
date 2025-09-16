jQuery(document).ready(function($) {
    $('#favorite-toggle-btn').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var tool_id = button.data('tool-id');

        $.ajax({
            url: favorites_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'toggle_favorite', // The action hook in functions.php
                nonce: favorites_ajax_object.nonce,
                tool_id: tool_id
            },
            beforeSend: function() {
                button.text('...'); // Show loading state
            },
            success: function(response) {
                if (response.success) {
                    if (response.data.status === 'added') {
                        button.text('Remove from Favorites');
                    } else if (response.data.status === 'removed') {
                        button.text('Add to Favorites');
                    }
                } else {
                    alert(response.data); // Show error message
                    // Restore original button text if needed
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
                // Restore original button text if needed
            }
        });
    });
});
