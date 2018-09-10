<?php

session_start();

// If user is already logged, redirect him to the home screen
if( isset($_SESSION["email"]) )
{
    header("Location: index.php");
    die();
}

$error = "";
$email = "";
$name = "";
$pass1 = "";
// If user requested the registraion, begin the validation
if( isset($_POST["email"]) && isset($_POST["name"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]) )
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

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc()) 
        {
            if(!strcmp($row["email"], $_POST["email"]))
            {
                $error.="That email already exists in the database!<br>";
            }
        }
    }

    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $error.= "- Email is not valid. Please enter a valid email address.<br>"; 
    }

    $name = $_POST["name"];
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
    {
        $error.= "- Name is not valid - only letters and white space allowed.<br>"; 
    }

    if(strlen($name) < 5)
    {
        $error.= "- Name must be at least 5 characters long!<br>";
    }

    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];

    if(strlen($pass1) < 4)
    {
        $error.="- Password must be more than 3 characters long!<br>";
    }

    if( strcmp($pass1,$pass2) )
    {
        $error.="- Passwords does not match!<br>";
    }

    if(strlen($error) == 0)
    {
        // If validation is successful, log the user in and save his data to database, redirect user to the home screen    

        $sql = "CALL registerUser('$email','$name','".sha1($pass1)."')";
        $result = $conn->query($sql);
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $name;
        header("Location: index.php");
    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

    <?php require 'header.php'; ?>

    <div class="wrapper">

        <form action="registration.php" method="post">

        <h4> Use the form bellow to register </h4><br>

        <?php

            if(strlen($error) > 0)
            {
                echo '<span style="text-align: left; line-height: 1.5;" class="badge badge-danger">'.$error.'</span><br><br>';
            }

        ?>

            <input type="email" placeholder="Email" name="email" /><br><br>
            <input type="text" placeholder="Name" name="name" /><br><br>
            <input type="password" placeholder="Password" name="pass1" /><br><br>
            <input type="password" placeholder="Repeat Password" name="pass2" /><br><br>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
        

    </div>

</body>

</html>