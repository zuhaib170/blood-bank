<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Donate Blood</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
  $active = 'donate';
  include('head.php');
  ?>

  <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="mt-4 mb-3">Donate Blood</h1>
          </div>
        </div>

        <!-- Form Start -->
        <form name="donor" action="savedata.php" method="post">
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Full Name<span style="color:red">*</span></div>
              <input type="text" name="fullname" class="form-control" required>
            </div>

           <div class="col-lg-4 mb-4">
  <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
  <input type="text" name="mobileno" class="form-control" required 
         inputmode="numeric" pattern="[0-9]*"
         oninput="this.value=this.value.replace(/[^0-9]/g,'');">
</div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Email Id</div>
              <input type="email" name="emailid" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Age<span style="color:red">*</span></div>
              <input type="number" name="age" class="form-control" required min="1" max="120" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Gender<span style="color:red">*</span></div>
              <select name="gender" class="form-control" required>
                <option value="" selected disabled>Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div class="col-lg-4 mb-4">
              <div class="font-italic">Blood Group<span style="color:red">*</span></div>
              <select name="blood" class="form-control" required>
                <option value="" selected disabled>Select</option>
                <?php
                include 'conn.php';
                $sql = "SELECT * FROM blood";
                $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <option value="<?php echo $row['blood_id']; ?>"><?php echo $row['blood_group']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8 mb-4">
              <div class="font-italic">Address<span style="color:red">*</span></div>
              <textarea class="form-control" name="address" required></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4 mb-4">
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer;">
            </div>
          </div>
        </form>
        <!-- Form End -->

      </div>
    </div>

    <?php include('footer.php'); ?>
  </div>

  <!-- Optional JavaScript validation -->
  <script>
    document.querySelector("form[name='donor']").addEventListener("submit", function(e) {
      let age = document.querySelector("input[name='age']").value;
      let mobile = document.querySelector("input[name='mobileno']").value;

      if (!/^\d+$/.test(age) || !/^\d+$/.test(mobile)) {
        alert("Please enter valid numbers for Age and Mobile Number.");
        e.preventDefault(); // Stop form submission
      }
    });
  </script>

</body>

</html>
