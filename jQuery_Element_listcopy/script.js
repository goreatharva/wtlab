$(document).ready(function() {
    
    // Function to copy items from oldList to newList
    $('#copyButton').click(function() {
        // Check if there are any items in oldList
        if ($('#oldList li').length > 0) {
            $('#oldList li').each(function() {
                // Clone each item and append it to newList
                $('#newList').append($(this).clone());
            });

            // Clear old list message if items are copied
            $('#newList li:first').remove(); // Remove default message
        }
    });

    // Function to add a new item to oldList
    $('#addItemButton').click(function() {
        var newItemText = $('#newItemInput').val();
        if (newItemText) {
            $('#oldList').append('<li>' + newItemText + '</li>');
            $('#newItemInput').val(''); // Clear input field
        }
    });
});