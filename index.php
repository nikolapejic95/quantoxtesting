<?php

    session_start();


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

        <form action="results.php" method="post">

        <h4> Use the form bellow to search users. </h4><br>

            <input type="text" placeholder="Search something..." name="query" /><br><br>

            <button type="submit" class="btn btn-primary">Search</button>

        </form>
    
    <?php } else { ?> <h2 style="margin-top: 100px; text-align: center;">You must be logged in to be able to search the users.</h2> <?php } ?>

    </div>

</body>

</html>