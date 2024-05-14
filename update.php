<?php
require_once('classes/database.php');
$con = new database();
 
 $user_id=$_POST['user_id'];
 
 if(empty($user_id)){
    header('location:index.php');
 
 } else {
    $row=$con->viewdata($user_id);
   
 }

 if (isset($_POST['update'])){
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $birthday = $_POST['birthday'];
  $sex = $_POST['sex'];
  $username = $_POST['user'];
  $password = $_POST['pass'];
  $confirm = $_POST['confirm'];
  $street = $_POST['street'];
  $barangay = $_POST['barangay'];
  $city = $_POST['city'];
  $province = $_POST['province'];
 
 
 if($password == $confirm){
 if($con->updateuser($user_id, $firstname, $lastname, $birthday, $sex, $username, $password)){
  if($con->updateuseradress($user_id, $street, $barangay, $city, $province)){
    header('location:index2.php');
    exit();
  }else{
    $error = "Error occured while updating user address. Please Try Again";
  }
}else{
  $error = "Error occured while updating user information. Please Try Again";
    }
  }
}
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 
  <style>
    .custom-container{
        width: 800px;
    }
    body{
    font-family: 'Roboto', sans-serif;
    }
  </style>
 
</head>
<body>
 
<div class="container custom-container rounded-3 shadow my-5 p-3 px-5">
  <h3 class="text-center mt-4">Update Form</h3>
  <form method="post">
    <!-- Personal Information -->
    <div class="card mt-4">
      <div class="card-header bg-dark text-white">Personal Information</div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-12">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname']; ?>" required placeholder="Enter first name">
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>" required placeholder="Enter last name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" name="birthday" value="<?php echo $row['birthday']; ?>" required>
          </div>
          <div class="form-group col-md-6">
            <label for="sex">Sex:</label>
            <select class="form-control" name="sex" required>
              <option selected>Select Sex</option>
              <option value="Male" <?php if ($row ['sex'] == 'Male') echo 'selected'; ?>>Male</option>
              <option value="Female" <?php if ($row ['sex'] == 'Female') echo 'selected'; ?>>Female</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="user"  value="<?php echo $row['user']; ?>" placeholder="Enter username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="pass" value="<?php echo $row['pass']; ?>" placeholder="Enter password" required>
        </div>
        <div class="form-group">
      <label for="password">Confirm Password: </label>
      <input type="password" class="form-control" name="confirm" value="<?php echo $row['pass']; ?>"placeholder="Re-Enter password" required>
    </div>
      </div>
    </div>
   
    <!-- Address Information -->
    <div class="card mt-4">
      <div class="card-header bg-dark text-white">Address Information</div>
      <div class="card-body">
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" class="form-control" name="street" value="<?php echo $row['user_street']; ?>" placeholder="Enter street" >
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="barangay">Barangay:</label>
            <input type="text" class="form-control" name="barangay" value="<?php echo $row['user_barangay']; ?>" placeholder="Enter barangay" required>
          </div>
          <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" value="<?php echo $row['user_city']; ?>" placeholder="Enter city" required>
          </div>
        </div>
        <div class="form-group">
          <label for="province">Province:</label>
          <input type="text" class="form-control" name="province" value="<?php echo $row['user_province']; ?>" placeholder="Enter province" required>
        </div>
      </div>
    </div>
   
    <!-- Submit Button -->
   
    <div class="container">
    <div class="row justify-content-center gx-0">
        <div class="col-lg-3 col-md-4">
        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <input type="submit" name="update" class="btn btn-outline-primary btn-block mt-4" value="Update">
        </div>
        <div class="col-lg-3 col-md-4">
            <a class="btn btn-outline-danger btn-block mt-4" href="login.php">Go Back</a>
        </div>
    </div>
</div>
 
 
  </form>
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