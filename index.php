<?php
require_once('classes/database.php');
$con = new database();
session_start();

if(empty($_SESSION['user'])) {
  header('location:login.php');
}
 
if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    if ($con->delete($user_id)) {
        header('location:index.php');
    } else {
        echo "Something went wrong.";
    }
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome!</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="./includes/style.css">
</head>
<body>
<?php include('include/navbar.php'); ?> 

<div class="container user-info rounded shadow p-3 my-2">
<h2 class="text-center mb-2">User Table</h2>
  <div class="table-responsive text-center">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Birthday</th>
          <th>Sex</th>
          <th>Username</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
 
    <?php
    $counter = 1;
    $data = $con->view();
    foreach($data as $row) {  
        ?>
 
        <tr>
            <td><?php echo $counter++; ?></td>
            <td><?php echo $row['firstname'];?></td>
            <td><?php echo $row['lastname'];?></td>
            <td><?php echo $row['birthday'];?></td>
            <td><?php echo $row['sex'];?></td>
            <td><?php echo $row['user'];?></td>
            <td><?php echo ucwords ($row['Address']);?></td>
            <td>
 
        <form action="update.php" method="POST" style="display: inline;">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <button type="submit" value="Edit" name="edit" class="btn btn-primary btn-sm"> Edit</button>
        </form>
        <form method="POST" style="display: inline;">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
        </form>
            </td>
        </tr>
    <?php
    }
    ?>
        <!-- Add more rows for additional users -->
      </tbody>
    </table>
  </div>
</div>
</div>
 
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
 
</body>
</html>