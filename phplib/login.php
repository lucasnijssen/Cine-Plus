<?php
 ini_set('session.gc_maxlifetime', 864000);
 session_set_cookie_params(864000);
session_start();


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.html");
    exit;
}


require_once "config.php";


$username = $password = "";
$username_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){


    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }


    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }


    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;


            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);


                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

                            session_start();
                            ini_set('session.gc_maxlifetime', 864000);
                            session_set_cookie_params(864000);


                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
							$_SESSION["gebruiker"] = "test";

                            $conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $ses_uid = $_SESSION["id"];
                            $create_session = "UPDATE `users` SET `sesid`='$ses_id' WHERE id= $ses_uid";

                            if ($conn->query($create_session) === TRUE) {
                                header("location: index.html");
                            } else {
                                echo "Error: " . $create_session . "<br>" . $conn->error;
                            }
                        } else{

                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{

                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }


        mysqli_stmt_close($stmt);
    }


    mysqli_close($link);
}
?>