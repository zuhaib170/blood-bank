<?php
mysqli_report(MYSQLI_REPORT_OFF);

@$conn = mysqli_connect(
	getenv('DB_HOST') ?: 'localhost',
	getenv('DB_USER') ?: 'root',
	getenv('DB_PASSWORD') ?: '',
	getenv('DB_NAME') ?: 'blood_donation',
	(int) (getenv('DB_PORT') ?: 3306)
);

if (!$conn) {
	http_response_code(503);
	exit('Database is not configured. Set DB_HOST, DB_PORT, DB_NAME, DB_USER, and DB_PASSWORD in the deployment settings.');
}
?>
