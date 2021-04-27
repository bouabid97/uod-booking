<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Movie seat Book</title>
</head>

<body>
<?php
session_start(); 

					include '../config.php';
                    include '../send_mail.php';
                    if (!isset($_SESSION["neptun_code"]))
                        header("location: ../index.php");
                    else
                    {
                    $sql="SELECT * FROM seats where type='bus'";
					$result  = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                            if($row["neptun_id"] == $_SESSION["neptun_code"])
                              ${"status_" . $row["id"]} = "selected";
                            else
                              ${"status_" . $row["id"]} = $row["seat_status"];
                        }

                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            // Validate username
                            if(empty(trim($_POST["neptun_code"]))){
                                $neptun_err = "Please enter a Neptun Code.";
                            } else{
                                // Prepare a select statement
                                $sql = "SELECT * FROM students WHERE neptun_code = ?";
                                if($stmt = mysqli_prepare($conn, $sql)){
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "s", $param_neptun_code);
                                    
                                    // Set parameters
                                    $param_neptun_code = trim($_POST["neptun_code"]);
                                    
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                        /* store result */
                                        mysqli_stmt_store_result($stmt);
                                        
                                        if(mysqli_stmt_num_rows($stmt) == 1){
                                            $neptun_code = trim($_POST["neptun_code"]);
                                            
                                        } else{
                                            $neptun_err = "Neptun Code doesn't exist.";                                            
                                        }
                                    } else{
                                        $reserve_err = "Oops! Something went wrong. Please try again later.";
                                    }
                        
                                    // Close statement
                                    mysqli_stmt_close($stmt);
                                }
                            }

                            // Validate email
                            if(empty(trim($_POST["email"]))){
                                $email_err = "Please enter an email.";     
                            } 
                            else{
                                // Prepare a select statement
                                $sql = "SELECT * FROM students WHERE email = ?";
                                
                                if($stmt = mysqli_prepare($conn, $sql)){
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "s", $param_email);
                                    
                                    // Set parameters
                                    $param_email = trim($_POST["email"]);
                                    
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                        /* store result */
                                        mysqli_stmt_store_result($stmt);
                                        
                                        if(mysqli_stmt_num_rows($stmt) == 1){
                                            $email = trim($_POST["email"]);
                                            
                                        } else{
                                            $email_err = "Email doesn't exist.";
                                        }
                                    } else{
                                        $reserve_err = "Oops! Something went wrong. Please try again later.";
                                    }
                        
                                    // Close statement
                                    mysqli_stmt_close($stmt);
                                }
                            }
                            // Validate password
                            if(empty(trim($_POST["password"]))){
                                $pass_err = "Please enter a password.";     
                            } 
                            else{
                                // Prepare a select statement
                                $sql = "SELECT * FROM students WHERE password = ?";
                                
                                if($stmt = mysqli_prepare($conn, $sql)){
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "s", $param_password);
                                    
                                    // Set parameters
                                    $param_password = trim($_POST["password"]);
                                    
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                        /* store result */
                                        mysqli_stmt_store_result($stmt);
                                        
                                        if(mysqli_stmt_num_rows($stmt) == 1){
                                            $password = trim($_POST["password"]);
                                            
                                        } else{
                                            $pass_err = "Password doesn't exist.";
                                        }
                                    } else{
                                        $reserve_err = "Oops! Something went wrong. Please try again later.";
                                    }
                        
                                    // Close statement
                                    mysqli_stmt_close($stmt);
                                }
                            }
                                                        
                            // Check input errors before inserting in database
                            if(empty($reserve_err) && empty($neptun_err) && empty($email_err) && empty($pass_err)){
                                $sql = "SELECT * FROM seats WHERE neptun_id = ? AND type='bus'";

                                if($stmt = mysqli_prepare($conn, $sql)){
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "s", $neptun_code);
                                    
                                    // Set parameters
                                    $neptun_code = trim($_POST["neptun_code"]);
                                    
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                        /* store result */
                                        mysqli_stmt_store_result($stmt);
                                        
                                        if(mysqli_stmt_num_rows($stmt) >= 1){
                                            $reserve_err = "You already reserved a seat";     
                                        } else{
                                            $sql = "UPDATE seats SET neptun_id = ?, seat_status = 'occupied' WHERE id = ?";
                                 
                                if($stmt = mysqli_prepare($conn, $sql)){
                                    // Bind variables to the prepared statement as parameters
                                   mysqli_stmt_bind_param($stmt, "ss", $param_neptun_code, $param_id);
                                    
                                    // Set parameters
                                    $param_neptun_code = $neptun_code;
                                    $param_id = trim($_POST["seat_id"]);
                                    
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                        sendMail($email, trim($_POST["seat_id"]), 'bus');
                                        header("location: ./bus.php");
                                       
                                    } else{
                                        $reserve_err="Oops! Something went wrong. Please try again later.";
                                    }
                        
                                    // Close statement
                                    mysqli_stmt_close($stmt);
                                }
                            }
                            
                            // Close connection
                            mysqli_close($conn);
                                        }
                                    } else{
                                        $reserve_err = "Oops! Something went wrong. Please try again later.";
                                    }
                        
                                    // Close statement
                                    mysqli_stmt_close($stmt);
                                }
                                // Prepare an insert statement
                                
                        }

                    }
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
                    elseif (isset($_POST['conference']))
                    {
                    // Redirect to login page
                    header("location: ./conference.php");
                    exit;
                    }
                    elseif (isset($_POST['home']))
                    {
                    // Redirect to login page
                    header("location: ./landing.php");
                    exit;
                    }
			?>
    <div>
        <form align="right" method="post" action="bus.php">
            <button id="btn" type="submit" name="logout">
            <span name="logout" class="noselect">Log out</span>
            <div id="circle"></div>
            </button>
            <button id="btn1" type="submit" name="conference">
            <span name="conference" class="noselect">Conference</span>
            <div id="circle1"></div>
            </button>
            <button id="btn2" type="submit" name="home">
            <span name="home" class="noselect">Home</span>
            <div id="circle2"></div>
            </button>
        </form>
    </div>
    <div class="movie-container">
        <label>RESERVE YOUR SEAT:</label>

    </div>
    <ul class="showcase">
        <li>
            <div class="seat"></div>
            <small>N/A</small>
        </li>
        <li>
            <div class="seat selected"></div>
            <small>Selected</small>
        </li>
        <li>
            <div class="seat occupied"></div>
            <small>Occupied</small>
        </li>
    </ul>
    <div class="container">

        <div class="row">
            <div class="seat <?php echo $status_1?>" id="1"></div>
            <div class="seat <?php echo $status_2?>" id="2"></div>
            <div class="seat <?php echo $status_3?>" id="3"></div>
            <div class="seat <?php echo $status_4?>" id="4"></div>

        </div>
        <div class="row">
            <div class="seat <?php echo $status_5?>" id="5"></div>
            <div class="seat <?php echo $status_6?>" id="6"></div>
            <div class="seat <?php echo $status_7?>" id="7"></div>
            <div class="seat <?php echo $status_8?>" id="8"></div>

        </div>

        <div class="row">

            <div class="seat <?php echo $status_9?>" id="9"></div>
            <div class="seat <?php echo $status_10?>" id="10"></div>
            <div class="seat <?php echo $status_11?>" id="11"></div>
            <div class="seat <?php echo $status_12?>" id="12"></div>

        </div>
        <div class="row">
            <div class="seat <?php echo $status_13?>" id="13"></div>
            <div class="seat <?php echo $status_14?>" id="14"></div>
            <div class="seat <?php echo $status_15?>" id="15"></div>
            <div class="seat <?php echo $status_16?>" id="16"></div>

        </div>
        <div class="row">
            <div class="seat <?php echo $status_17?>" id="17"></div>
            <div class="seat <?php echo $status_18?>" id="18"></div>
            <div class="seat <?php echo $status_19?>" id="19"></div>
            <div class="seat <?php echo $status_20?>" id="20"></div>

        </div>
        <div class="row">
            <div class="seat <?php echo $status_21?>" id="21"></div>
            <div class="seat <?php echo $status_22?>" id="22"></div>
            <div class="seat <?php echo $status_23?>" id="23"></div>
            <div class="seat <?php echo $status_24?>" id="24"></div>

        </div>
        <div class="row">
            <div class="seat <?php echo $status_25?>" id="25"></div>
            <div class="seat <?php echo $status_26?>" id="26"></div>
            <div class="seat <?php echo $status_27?>" id="27"></div>
            <div class="seat <?php echo $status_28?>" id="28"></div>

        </div>
        <div class="row">
            <div class="seat <?php echo $status_29?>" id="29"></div>
            <div class="seat <?php echo $status_30?>" id="30"></div>

            <div class="seat <?php echo $status_31?>" id="31"></div>
            <div class="seat <?php echo $status_32?>" id="32"></div>
        </div>
        <div class="row">
            <div class="seat <?php echo $status_33?>" id="33"></div>
            <div class="seat <?php echo $status_34?>" id="34"></div>
            <div class="seat <?php echo $status_35?>" id="35"></div>
            <div class="seat <?php echo $status_36?>" id="36"></div>
            
        </div>
        </div>
    </div>
    <div class="login-err">
				<span>
					<?php echo isset($reserve_err)?$reserve_err:""; ?>
					</span>
        </div>
        <div class="login-err">
				<span>
					<?php echo isset($neptun_err)?$neptun_err:""; ?>
					</span>
        </div>
        <div class="login-err">
				<span>
					<?php echo isset($email_err)?$email_err:""; ?>
					</span>
        </div>
        <div class="login-err">
				<span>
					<?php echo isset($pass_err)?$pass_err:""; ?>
					</span>
        </div>





    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="bus.php" method="POST">
                <div class="input row">
                    <label for="seat_id">Selected seat id</label><input name='seat_id' id='seat_id' type="text" readonly>
                </div>
                <div class="input row">
                    <label for="neptun_code">Enter your neptun code</label><input name='neptun_code' id='neptun_code' type="text">
                </div>
                <div class="input row">
                    <label for="email">Enter your neptun email</label><input name='email' id='email' type="text">
                </div>
                <div class="input row">
                    <label for="password">Enter your neptun password</label><input type='password' name='password'
                        id='password' type="text">
                </div>

                <button name="reserve" type="submit">Reserve</button>
            </form>

        </div>

    </div>

    <script src="../js/script.js"></script>
</body>

</html>