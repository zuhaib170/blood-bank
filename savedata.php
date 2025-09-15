<?php
// Capture form inputs
$name = $_POST['fullname'];
$number = $_POST['mobileno'];
$email = $_POST['emailid'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood'];
$address = $_POST['address'];

// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

// Prepare SQL query
$sql = "INSERT INTO donor_details(donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address)
        VALUES ('{$name}', '{$number}', '{$email}', '{$age}', '{$gender}', '{$blood_group}', '{$address}')";

// Execute query
$result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

mysqli_close($conn);
?>

<!-- Show popup and redirect -->
<script>
    alert("Data saved successfully!");
    window.location.href = "http://localhost:800/Blood-Bank-And-Donation-Management-System-master/home.php";
</script>
