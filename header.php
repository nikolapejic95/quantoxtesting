<div id="header-menu">

        <a href="index.php">Home</a>

        <?php if( isset($_SESSION["email"]) ) { ?>
        <h4 style="text-align: left; width: 500px; display: inline; float: left;">Welcome <?php echo $_SESSION["name"]; ?> </h4> <?php } ?>

        <?php if( !isset($_SESSION["email"]) ) { ?>
        <a href="login.php">Login</a> <?php } ?>

        <?php if( !isset($_SESSION["email"]) ) { ?>
        <a href="registration.php">Registration</a> <?php } ?>
        
        <?php if( isset($_SESSION["email"]) ) { ?>
        <a href="logout.php">Logout</a><?php } ?>

</div>    