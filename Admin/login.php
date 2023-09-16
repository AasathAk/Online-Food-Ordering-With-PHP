<?php
session_start();
include('../Dbconnect/config.php');
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Login Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
      background:url('../Admin/img/loginbg.jpg');
      background-size:auto;
      background-repeat: no-repeat;
    }

    .center {
      margin: auto;
      width: 100%;
      max-width: 400px;
      padding: 10px;
      background-color: #fff;
      box-shadow: 0px 0px 10px #999;
      border-radius: 5px;
      margin-top: 50px;
      position: relative;
    }

    .center img {
      position: relative;
      left: 50%;
      transform: translateX(-50%);
      width:100px;
      border-radius: 50%;
      border: 5px solid #fff;
      box-shadow: 0px 0px 10px #999;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }

    .form-control {
      border-radius: 0;
      border: none;
      border-bottom: 2px solid #ddd;
    }

    .form-control:focus {
      box-shadow: none;
      border-bottom: 2px solid #007bff;
    }

    label {
      font-weight: bold;
    }

    h1 {
      color: #fff;
      text-shadow: 2px 2px 5px #000;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="center">
      <h1 class="text-center">Admin Login</h1>
      <img src="https://cdn.pixabay.com/photo/2017/08/30/12/45/girl-2696947_960_720.jpg" alt="Avatar">
      


      <!-- Session error msg -->
    <div style="display:<?php if (isset($_SESSION['showsAlert'])) {
                                        echo $_SESSION['showsAlert'];
                                    } else {
                                        echo 'none';
                                    }
                    unset($_SESSION['showsAlert']); ?>" class="alert alert-warning alert-dismissible mt-2">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php if (isset($_SESSION['No-login-message'])) {
                                echo $_SESSION['No-login-message'];
                            }
                            unset($_SESSION['showsAlert']); ?></strong>
      </div>


    <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                                        echo $_SESSION['showAlert'];
                                    } else {
                                        echo 'none';
                                    }
                    unset($_SESSION['showAlert']); ?>" class="alert alert-danger alert-dismissible mt-2">
                     <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php if (isset($_SESSION['error'])) {
                                echo $_SESSION['error'];
                            }
                            unset($_SESSION['showAlert']); ?></strong>
      </div>
      <!-- Session error msg end -->

      <form action="login.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>



        <?php 
        if(isset($_POST["submit"])){
          $u_name=mysqli_real_escape_string($conn,$_POST["username"]);
          $u_pass=md5(mysqli_real_escape_string($conn,$_POST["password"]));
          $sql="select id,username from admin where username='{$u_name}' and password='{$u_pass}'";
          $res=$conn->query($sql);
          if($res->num_rows>0){
            $row=$res->fetch_assoc();

            $_SESSION["u_id"]=$row["id"];
            $_SESSION["user_name"]=$row["username"];
            header("location:index.php");
          }else{

            $_SESSION['showAlert'] = 'block';
            $_SESSION["error"]="Invalid username or Password";
            header("location:login.php");
          }
        }
      ?>

      </form>
    </div>
  </div>
</body>

</html>
