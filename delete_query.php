<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session and include database connection
session_start();
include 'conn.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<div class='alert alert-danger'><b>Please login first to access this page.</b></div>";
    exit();
}

// Check if the 'id' is provided in URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $que_id = intval($_GET['id']);

    // Delete query
    $sql = "DELETE FROM contact_query WHERE query_id = $que_id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to query.php after successful deletion
        header("Location: query.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'><b>Error:</b> Could not delete the record. " . mysqli_error($conn) . "</div>";
    }
} else {
    echo "<div class='alert alert-warning'><b>Invalid request:</b> No query ID provided.</div>";
}
?>
