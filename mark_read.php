<?php
include 'conn.php';
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_GET['id'])) {
        $que_id = intval($_GET['id']);
        $sql = "UPDATE contact_query SET query_status = '1' WHERE query_id = $que_id";
        mysqli_query($conn, $sql);
    }
    header("Location: query.php");
    exit();
} else {
    echo '<div class="alert alert-danger"><b> Please Login First To Access Admin Portal.</b></div>';
}
?>
