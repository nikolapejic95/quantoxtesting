<?php

session_start();

// If user is already logged, redirect him to the home screen
if( isset($_SESSION["email"]) )
{
    header("Location: index.php");
    die();
}

$error = "";
// If user requested the login, try to log him in
if( isset($_POST["email"]) && isset($_POST["pass"]))
{
    $configs = include('core/db.php');
    $host = $configs["host"];
    $dbname = $configs["dbname"];
    $username = $configs["username"];
    $password = $configs["password"];

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT email, name, pass FROM users";
    $result = $conn->query($sql);

    $logged = 0;
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            if(!strcmp($row["email"], $_POST["email"]))
            {
                if(!strcmp($row["pass"], sha1($_POST["pass"])))
                {
                    $logged = 1;
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["name"] = $row["name"];
                    if(isset($_POST["redirect"]))
                    {
                        header("Location: results.php");
                    }
                    else
                    {
                        header("Location: index.php");
                    }
                    die();
                }
            }
        }
    }

    if($logged == 0)
    {
        $error = "Error logging you in.";
    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.28/sweetalert2.all.min.js"></script>

</head>

<body>

    <?php
    
        if( isset($_GET["results"]) )
        {
            echo "<script> swal({
                type: 'error',
                title: 'Oops...',
                text: 'You must be logged in to be able to see that page!'
                }); </script>";
        }
    
     ?>

    <?php require 'header.php'; ?>    

    <div class="wrapper">

        <form action="login.php" method="post">

        <h4> Use the form bellow to login </h4><br>

        <?php

            if(strlen($error) > 0)
            {
                echo '<span style="text-align: left; line-height: 1.5;" class="badge badge-danger">'.$error.'</span><br><br>';
            }

        ?>

            <input type="email" placeholder="Email" name="email" /><br><br>
            <input type="password" placeholder="Password" name="pass" /><br><br>
            <?php if(isset($_GET["result"])) { ?> <input style="display: none" name="redirect" val="result" /> <?php } ?>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
        

    </div>

</body>

</html>