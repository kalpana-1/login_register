<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:index.php?action=login");
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

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h3>Hello There,<br> <?php echo $_SESSION['username']; ?></h3>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</body>

</html>