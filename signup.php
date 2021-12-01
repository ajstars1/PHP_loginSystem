<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'particals/_dbconnect.php';
    $username = $_POST["username"];
    $email = $_POST['email'];
    $number = $_POST["number"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists=false;
    
    // Check whether this user name Exits
    $existsql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result);
    // Check whether this user name Exits
    $existsql2 = "SELECT * FROM `users` WHERE email = '$email'";
    $result2 = mysqli_query($conn, $existsql2);
    $numExistRows2 = mysqli_num_rows($result2);
    // Check whether this user name Exits
    $existsql3 = "SELECT * FROM `users` WHERE 'number' = '$number'";
    $result3 = mysqli_query($conn, $existsql3);
    $numExistRows3 = mysqli_num_rows($result3);

      if ($numExistRows > 0) {
        // $exists = true;
        $showError = "Username Already Exists";
      }
      elseif ($numExistRows2 > 0) {
        $showError = 'This Email is Already in Use';
      }
      elseif ($numExistRows3 > 0) {
        $showError = "This Number is Already in Use";
      }
      else {
        // $exists = false;
        
        if (($password == $cpassword) ){
          $hash = password_hash($password , PASSWORD_DEFAULT) ;
          $sql = "INSERT INTO `users` ( `username`, `email`, `number`, `password`, `time`) VALUES ( '$username', '$email', '$number', '$hash', current_timestamp())";
          $result = mysqli_query($conn, $sql);
          if ($result){
            $showAlert = true;
          }
        }
        
        else{
          $showError = "Passwords does't match ";
        }
      }
      
    
    }
    ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php require 'particals/_nav.php' ?>
    <?php
        if ($showAlert)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your account is now created  and you can login !!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }     
        if ($showError)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!!</strong> '. $showError .'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }     
    ?>
   
    <div class="container">
    <h1 class="text-center" >Signup to our website</h1>
    <form action = "/loginsystem/signup.php" method = "POST">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" minlength="2" maxlength='15' class="form-control" id="username" name="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" maxlength='25' class="form-control" id="email" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="number" class="form-label">Phone number</label>
    <input type="phone" minlength="10" maxlength="10" class="form-control" id="number" name="number" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" minlength="6" maxlength="30" class="form-control" id="password" name = "password">
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name = "cpassword">
    <div id="emailHelp" class="form-text">Make sure to type the same password</div>
  </div>
 
  <button type="submit" class="btn btn-primary">SignUp</button>
</form>
    </div>

  
  
  
  
  
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>