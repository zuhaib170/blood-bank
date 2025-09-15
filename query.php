<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Query | Admin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    #sidebar {
      position: relative;
      margin-top: -20px;
    }

    #content {
      position: relative;
      margin-left: 210px;
    }

    @media screen and (max-width: 600px) {
      #content {
        margin-left: auto;
        margin-right: auto;
      }
    }

    #he {
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 3px 7px;
      color: #fff;
      text-decoration: none;
      border-radius: 3px;
    }
  </style>
</head>

<body style="color:black">
  <?php
  include 'conn.php';
  include 'session.php';

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  ?>
    <div id="header">
      <?php include 'header.php'; ?>
    </div>

    <div id="sidebar">
      <?php $active = "query"; include 'sidebar.php'; ?>
    </div>

    <div id="content">
      <div class="content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <h1 class="page-title">User Query</h1>
              <hr>
            </div>
          </div>

          <?php
          $limit = 10;
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $offset = ($page - 1) * $limit;
          $count = $offset + 1;

          $sql = "SELECT * FROM contact_query ORDER BY query_date DESC LIMIT {$offset}, {$limit}";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
          ?>
            <div class="table-responsive">
              <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Blood Group</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                      <td><?php echo $count++; ?></td>
                      <td><?php echo htmlspecialchars($row['query_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['query_mail']); ?></td>
                      <td><?php echo htmlspecialchars($row['query_number']); ?></td>
                      <td><?php echo htmlspecialchars($row['blood_group'] ?? 'N/A'); ?></td>
                      <td><?php echo htmlspecialchars($row['query_message']); ?></td>
                      <td><?php echo htmlspecialchars($row['query_date']); ?></td>
                      <td>
                        <?php if ($row['query_status'] == 1) {
                          echo "<span class='label label-success'>Read</span>";
                        } else { ?>
                          <a href="mark_read.php?id=<?php echo $row['query_id']; ?>" onclick="return confirm('Mark as read?');" class="label label-warning">Pending</a>
                        <?php } ?>
                      </td>
                      <td>
                        <a href="delete_query.php?id=<?php echo $row['query_id']; ?>" onclick="return confirm('Delete this query?');" class="btn btn-danger btn-sm">Delete</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } else {
            echo "<div class='alert alert-warning text-center'>No queries found.</div>";
          } ?>

          <!-- Pagination -->
          <div class="text-center">
            <?php
            $sql1 = "SELECT COUNT(*) AS total FROM contact_query";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $total_records = $row1['total'];
            $total_pages = ceil($total_records / $limit);

            if ($total_pages > 1) {
              echo '<ul class="pagination">';
              if ($page > 1) {
                echo '<li><a href="query.php?page=' . ($page - 1) . '">Prev</a></li>';
              }
              for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? 'class="active"' : '';
                echo "<li $active><a href='query.php?page=$i'>$i</a></li>";
              }
              if ($page < $total_pages) {
                echo '<li><a href="query.php?page=' . ($page + 1) . '">Next</a></li>';
              }
              echo '</ul>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php
  } else {
    echo '<div class="alert alert-danger"><b>Please login to access the admin portal.</b></div>';
  ?>
    <form method="post" action="login.php" class="form-horizontal">
      <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4">
          <button class="btn btn-primary" type="submit">Go to Login Page</button>
        </div>
      </div>
    </form>
  <?php } ?>
</body>

</html>
