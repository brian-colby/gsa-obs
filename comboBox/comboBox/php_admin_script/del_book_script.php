<?php
// Include your database connection (if it's in another file)
require_once('../php_admin_script/connect_function.php');

// Check if the 'book_id' is passed via the URL
if (isset($_GET['book_id'])) {
    // Retrieve the 'book_id' from the URL
    $book_id = $_GET['book_id'];

    // Make sure the 'book_id' is a valid integer to prevent SQL injection
    if (is_numeric($book_id)) {
        // Prepare the DELETE query to remove the record with the given 'book_id'
        $query = "DELETE FROM request_tbl WHERE request_id = ?";
        
        // Prepare the statement
        if ($stmt = $mysqli->prepare($query)) {
            // Bind the 'book_id' to the statement
            $stmt->bind_param('i', $book_id);

            // Execute the query
            if ($stmt->execute()) {
                // Redirect to the page where the records are listed after successful deletion
                echo "<script>
                        alert('Booking deleted successfully.');
                        window.location.href = '../bookings.php?status=deleted'; // Redirect to the bookings page
                      </script>";
                exit();
            } else {
                // If there was an error executing the query, show an alert with the error message
                echo "<script>
                        alert('Error: " . $stmt->error . "');
                        window.location.href = '../bookings.php'; // Redirect back to the bookings page
                      </script>";
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            // If there was an error preparing the query, show an alert with the error message
            echo "<script>
                    alert('Error: Unable to prepare statement.');
                    window.location.href = '../bookings.php'; // Redirect back to the bookings page
                  </script>";
        }
    } else {
        // If the 'book_id' is invalid, show an alert with an error message
        echo "<script>
                alert('Invalid ID.');
                window.location.href = '../bookings.php'; // Redirect back to the bookings page
              </script>";
    }
} else {
    // If no 'book_id' is passed, show an alert with an error message
    echo "<script>
            alert('No booking ID specified.');
            window.location.href = '../bookings.php'; // Redirect back to the bookings page
          </script>";
}
?>
