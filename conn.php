<?php
$conn = mysqli_connect(
	getenv('DB_HOST') ?: 'localhost',
	getenv('DB_USER') ?: 'root',
	getenv('DB_PASSWORD') ?: '',
	getenv('DB_NAME') ?: 'blood_donation',
	(int) (getenv('DB_PORT') ?: 3306)
) or die('Connection error');
?>
