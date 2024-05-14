<?php

require_once('classes/database.php');

$con = new database();
if(isset($_POST['signup'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $confirm = $_POST['confirm'];
    
    if ($password == $confirm) {
        if ($con->signup($firstname, $lastname, $birthday, $sex, $username, $password)) {
            header('location:login.php');
        } else {
            echo "Username already exist. Please choose a different username.";
        }
    } else {
        echo "Password did not match";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  
</head>
<body>
<div class="container-fluid login-container rounded shadow">
  <h2 class="text-center mb-4">Sign Up</h2>
  <form method="post">
  <div class="form-group">
      <label for="firstname">First Name:</label>
      <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstname">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text" class="form-control" id="lastname" placeholder="Enter last name" name="lastname">
    </div>
    <div class="mb-3">
        <label for="birthday" class="form-birthday">Birthday:</label>
        <input type="date" class="form-control" name="birthday">
        </div>
    <div class="mb-3">
        <label for="sex" class="form-label">Sex:</label>
        <select name="sex" class="form-select">
            <option selected disabled>Select Sex</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        
    </div>


    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter username" name="user">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="pass">
    </div>
    <div class="form-group">
      <label for="confirm">Confirm Password:</label>
      <input type="confirm" class="form-control" id="confirm" placeholder="Confirm your password" name="confirm">
    </div>

    <div class="container">
        <div class="row gx-1">
        <div class="col"><input type="submit" id="signup" value="Sign Up" class="btn btn-danger btn-block" name="signup"></input></div>
        
      </div>
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
</body>
</html>