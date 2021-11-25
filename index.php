<?php
include 'db/connection.php';
session_start();

if (isset($_SESSION['username'])) {
    header("location:dashboard.php");
}

//registration
if (isset($_POST['register'])) {

    if(empty($_POST["username"]) || empty($_POST["password"])){
        echo '<script>alert("Both Fields are required");</script>';
    }else{
        $username = $conn->real_escape_string($_POST["username"]);
        $password = $conn->real_escape_string($_POST["password"]);
        $password = md5($password);

        $sql = "INSERT INTO users(username,password) VALUES (?,?)";

        // prepared Statement
        $stmt = $conn->prepare($sql);
        if(!$stmt){
            echo "Connection Error!";
        }else{
            // Bind Parameters
            $stmt->bind_param('ss',$username,$password);
            $stmt->execute();
            echo '<script>alert("Registration Success!");</script>';
        }

        $stmt->close();

    }
}

//registration
if (isset($_POST['login'])) {

    if(empty($_POST["username"]) || empty($_POST["password"])){
        echo '<script>alert("Both Fields are required");</script>';
    }else{
        $username = $conn->real_escape_string($_POST["username"]);
        $password = $conn->real_escape_string($_POST["password"]);
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        // prepared Statement
        $stmt = $conn->prepare($sql);
        if(!$stmt){
            echo "Connection Error!";
        }else{
            // Bind Parameters
            $stmt->bind_param('ss',$username,$password);
            $stmt->execute();
            // echo '<script>alert("Registration Success!");</script>';
        }
        
        $result = $stmt->get_result();
        $exist = $result->num_rows;

        if($exist == 0){
              echo '<script>alert("wrong User Details!");</script>';
        }else{
            $_SESSION['username'] = $username;
            echo $username;
            header('location:dashboard.php');
        }


        $stmt->close();

    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Register Website</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>

    <?php if(isset($_GET['action'])) { 
        if($_GET['action'] == "login"){?>
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h3>PHP LOGIN PAGE</h3>
                    <form method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary" name="login" >Login</button>
                        <a href="index.php">Register</a>
                    </form>
                </div>
            </div>
        </div>

    <?php }else{
                  echo '<script>alert("Wrong Input!");</script>';
    }} else { ?>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h3>PHP REGISTER PAGE</h3>
                    <form method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                        <a href="index.php?action=login">Login</a>
                    </form>
                </div>
            </div>
        </div>

    <?php } ?>



    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>