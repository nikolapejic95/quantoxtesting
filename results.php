<?php
    session_start();

    if(!isset($_SESSION["email"]))
    {
        header("Location: login.php?results=1");
    }
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

</head>

<body>

    <?php require 'header.php'; ?>

    <?php if( isset($_SESSION["email"]) ) { ?>

    <div class="wrapper">

        <?php
        
            if( !isset($_POST["query"]) )
            {
                echo '<h4> Nothing is searched for. Please use <a href="index.php">this</a> page in order to search users </h4><br>';
            }

            else
            {
                $query = $_POST["query"];
                if(strlen($query) == 0) $query = " ";

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
                
                $sql = "SELECT email, name FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) 
                {
                    echo "<table id=\"users\"><tr><th>Email</th><th>Name</th></tr>";
                    while($row = $result->fetch_assoc()) 
                    {
                        if(strpos($row["email"], $query) !== false || strpos($row["name"], $query) !== false)
                        {
                            echo "<tr><td>".$row["email"]."</td><td>".$row["name"]."</td></tr>";
                        }
                    }
                     echo "</table>";
                }
                else
                {
                    echo '<h4> No users match the search criteria. Please try again. </h4><br>';
                }
            }
        
        }
         ?>

    </div>

</body>
</html>