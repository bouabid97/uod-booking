<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an event</title>
    <link rel="stylesheet" href="../css/landingstyle.css">
</head>

<body>
        <?php
        if(isset($_POST['logout']))
        {
        // Initialize the session
        session_start();
        
        // Unset all of the session variables
        $_SESSION = array();
        
        // Destroy the session.
        session_destroy();
        
        // Redirect to login page
        header("location: ../index.php");
        exit;
        }
        ?>
        <div class="container">
        <form align="right" method="post" action="landing.php">
            <button id="btn" type="submit" name="logout">
            <span name="logout" class="noselect">Log out</span>
            <div id="circle"></div>
            </button>
        </form>
            <h2>What would you like to book</h2>
            <div class="options-wrap">
                <form action="./bus.php">
                    <button id='bus-trip' type="submit">BUS TRIP</button>
                </form>
                <form action="./conference.php">
                    <button id='conference'>Conference</button>
                </form>
            </div>
        </div>

</body>

</html>