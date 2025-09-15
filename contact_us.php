<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Contact Us</title>

  <!-- Bootstrap CSS and JS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

<?php
$active = 'contact';
include 'head.php';

if (isset($_POST["send"])) {
  $name = $_POST['fullname'];
  $number = $_POST['contactno'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $bloodgroup = $_POST['bloodgroup'];

  $conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

  $sql = "INSERT INTO contact_query (query_name, query_mail, query_number, query_message, blood_group) 
          VALUES ('{$name}', '{$email}', '{$number}', '{$message}', '{$bloodgroup}')";

  $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Query Sent!</strong> We will contact you shortly.
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>';
}
?>

<div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <h1 class="mt-4 mb-3">Contact</h1>

      <div class="row">
        <!-- Contact Form -->
        <div class="col-lg-8 mb-4">
          <h3>Send us a Message</h3>
          <form name="sentMessage" method="post">
            <div class="form-group">
              <label>Full Name:</label>
              <input type="text" class="form-control" name="fullname" required
                     pattern="[A-Za-z\s]+" maxlength="50"
                     oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')"
                     title="Only letters and spaces allowed">
            </div>

            <div class="form-group">
              <label>Phone Number:</label>
              <input type="text" class="form-control" name="contactno" required
                     inputmode="numeric" pattern="\d{10,15}" maxlength="15"
                     oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                     title="Enter 10 to 15 digits only">
            </div>

            <div class="form-group">
              <label>Email Address:</label>
              <input type="email" class="form-control" name="email" required maxlength="100">
            </div>

            <div class="form-group">
              <label>Blood Group:</label>
              <select class="form-control" name="bloodgroup" required>
                <option value="">-- Select Blood Group --</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>
            </div>

            <div class="form-group">
              <label>Message:</label>
              <textarea class="form-control" name="message" required rows="10" maxlength="999" style="resize:none"></textarea>
            </div>

            <button type="submit" name="send" class="btn btn-primary">Send Message</button>
          </form>
        </div>

        <!-- Contact Info Display -->
        <div class="col-lg-4 mb-4">
          <h2>Contact Details</h2>
          <?php
          include 'conn.php';
          $sql = "SELECT * FROM contact_info";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<p><strong>Address:</strong><br>" . $row['contact_address'] . "</p>";
              echo "<p><strong>Phone:</strong><br>" . $row['contact_phone'] . "</p>";
              echo "<p><strong>Email:</strong><br><a href='mailto:" . $row['contact_mail'] . "'>" . $row['contact_mail'] . "</a></p>";
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</div>

<!-- JavaScript to block invalid paste input -->
<script>
  const nameInput = document.querySelector("input[name='fullname']");
  const phoneInput = document.querySelector("input[name='contactno']");

  nameInput.addEventListener('paste', e => {
    e.preventDefault();
    const text = (e.clipboardData || window.clipboardData).getData('text');
    nameInput.value += text.replace(/[^A-Za-z\s]/g, '');
  });

  phoneInput.addEventListener('paste', e => {
    e.preventDefault();
    const text = (e.clipboardData || window.clipboardData).getData('text');
    phoneInput.value += text.replace(/[^0-9]/g, '');
  });
</script>

</body>
</html>
