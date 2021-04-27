<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Movie Seat Book</title>
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
                    $sql="SELECT * FROM seats where type='conference'";
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
                                $sql = "SELECT * FROM seats WHERE neptun_id = ? AND type='conference'";

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
                                        sendMail($email,trim($_POST["seat_id"]), 'conference');
                                        header("location: ./conference.php");
                                       
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
                    elseif (isset($_POST['bus']))
                    {
                    // Redirect to login page
                    header("location: ./bus.php");
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
        <form align="right" method="post" action="conference.php">
            <button id="btn" type="submit" name="logout">
            <span name="logout" class="noselect">Log out</span>
            <div id="circle"></div>
            </button>
            <button id="btn3" type="submit" name="bus">
            <span name="bus" class="noselect">Bus</span>
            <div id="circle3"></div>
            </button>
            <button id="btn4" type="submit" name="home">
            <span name="home" class="noselect">Home</span>
            <div id="circle4"></div>
            </button>
        </form>
    </div>
    <div class="movie-container">
        <label>RESERVE YOUR SEAT:</label>

    </div>
    <ul class="showcase">
        <li>
            <div  class="seat"></div>
            <small>N/A</small>
        </li>
        <li>
            <div  class="seat selected"></div>
            <small>Selected</small>
        </li>
        <li>
            <div  class="seat occupied"></div>
            <small>Occupied</small>
        </li>
    </ul>
    <div class="container">
        <div class="screen"></div>
        <div class="row">
            <div  class="seat <?php echo $status_37?>" id="37"></div>
            <div  class="seat <?php echo $status_38?>" id="38"></div>
            <div  class="seat <?php echo $status_39?>" id="39"></div>
            <div  class="seat <?php echo $status_40?>" id="40"></div>
            <div  class="seat <?php echo $status_41?>" id="41"></div>
            <div  class="seat <?php echo $status_42?>" id="42"></div>
            <div  class="seat <?php echo $status_43?>" id="43"></div>
            <div  class="seat <?php echo $status_44?>" id="44"></div>


        </div>
        <div class="row">
            <div  class="seat <?php echo $status_45?>" id="45"></div>
            <div  class="seat <?php echo $status_46?>" id="46"></div>
            <div  class="seat <?php echo $status_47?>" id="47"></div>
            <div  class="seat <?php echo $status_48?>" id="48"></div>
            <div  class="seat <?php echo $status_49?>" id="49"></div>
            <div  class="seat <?php echo $status_50?>" id="50"></div>
            <div  class="seat <?php echo $status_51?>" id="51"></div>
            <div  class="seat <?php echo $status_52?>" id="52"></div>

        </div>

        <div class="row">

            <div  class="seat <?php echo $status_53?>" id="53"></div>
            <div  class="seat <?php echo $status_54?>" id="54"></div>
            <div  class="seat <?php echo $status_55?>" id="55"></div>
            <div  class="seat <?php echo $status_56?>" id="56"></div>
            <div  class="seat <?php echo $status_57?>" id="57"></div>
            <div  class="seat <?php echo $status_58?>" id="58"></div>
            <div  class="seat <?php echo $status_59?>" id="59"></div>
            <div  class="seat <?php echo $status_60?>" id="60"></div>


        </div>
        <div class="row">
            <div  class="seat <?php echo $status_61?>" id="61"></div>
            <div  class="seat <?php echo $status_62?>" id="62"></div>
            <div  class="seat <?php echo $status_63?>" id="63"></div>
            <div  class="seat <?php echo $status_64?>" id="64"></div>
            <div  class="seat <?php echo $status_65?>" id="65"></div>
            <div  class="seat <?php echo $status_66?>" id="66"></div>
            <div  class="seat <?php echo $status_67?>" id="67"></div>
            <div  class="seat <?php echo $status_68?>" id="68"></div>


        </div>
        <div class="row">
            <div  class="seat <?php echo $status_69?>" id="69"></div>
            <div  class="seat <?php echo $status_70?>" id="70"></div>
            <div  class="seat <?php echo $status_71?>" id="71"></div>
            <div  class="seat <?php echo $status_72?>" id="72"></div>
            <div  class="seat <?php echo $status_73?>" id="73"></div>
            <div  class="seat <?php echo $status_74?>" id="74"></div>
            <div  class="seat <?php echo $status_75?>" id="75"></div>
            <div  class="seat <?php echo $status_76?>" id="76"></div>


        </div>
        <div class="row">
            <div  class="seat <?php echo $status_77?>" id="77"></div>
            <div  class="seat <?php echo $status_78?>" id="78"></div>
            <div  class="seat <?php echo $status_79?>" id="79"></div>
            <div  class="seat <?php echo $status_80?>" id="80"></div>
            <div  class="seat <?php echo $status_81?>" id="81"></div>
            <div  class="seat <?php echo $status_82?>" id="82"></div>
            <div  class="seat <?php echo $status_83?>" id="83"></div>
            <div  class="seat <?php echo $status_84?>" id="84"></div>


        </div>
        <div class="row">
            <div  class="seat <?php echo $status_85?>" id="85"></div>
            <div  class="seat <?php echo $status_86?>" id="86"></div>
            <div  class="seat <?php echo $status_87?>" id="87"></div>
            <div  class="seat <?php echo $status_88?>" id="88"></div>
            <div  class="seat <?php echo $status_89?>" id="89"></div>
            <div  class="seat <?php echo $status_90?>" id="90"></div>
            <div  class="seat <?php echo $status_91?>" id="91"></div>
            <div  class="seat <?php echo $status_92?>" id="92"></div>


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
            <form action="conference.php" method="POST">
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