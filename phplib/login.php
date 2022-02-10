<?php
 ini_set('session.gc_maxlifetime', 864000);
 session_set_cookie_params(864000);
session_start();


echo '<script>console.log("' . $error_mes . '")</script>';
echo '<script>console.log("Hier zou de cookie moeten staan")</script>';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.html");
    exit;
}

if(isset($_COOKIE["login_error"])){
    $error_mes = $_SESSION["login_error"];
    echo '<script>console.log("Script Run")</script>';
    if($error_mes == "username"){
        $_SESSION["login_error"] = "";
        echo '<script>swal.fire("Gebruikersnaam", "Je hebt geen gebruikersnaam opgegeven", "error");</script>';
    }else if($error_mes == "password"){
        $_SESSION["login_error"] = "";
        echo '<script>swal.fire("Wachtwoord", "Je hebt geen wachtwoord opgegeven", "error");</script>';
    }else if($error_mes == "invalid"){
        $_SESSION["login_error"] = "";
        echo '<script>swal.fire("Oeps..", "De gebruikersnaam en wachtwoord komen niet overeen", "error");</script>';
    }else if($error_mes == "notfound"){
        $_SESSION["login_error"] = "";
        echo '<script>swal.fire("Oeps..", "Er is geen account gevonden met die gebruikersnaam", "error");</script>';
    }else if($error_mes == "other"){
        $_SESSION["login_error"] = "";
        echo '<script>swal.fire("Er ging iets fout..", "Oei, er ging iets fout aan onze kant, probeer het later nog eens!", "error");</script>';
    }else{
    
    }    

}



require_once "config.php";


$username = $password = "";
$username_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){


    if(empty(trim($_POST["username"]))){
        $_SESSION["login_error"] = "username";
        $username_err = "Please enter username.";
        setcookie("login_error","username",10);
        echo "<script>alert('test');</script>";
        
    } else{
        $username = trim($_POST["username"]);
    }


    if(empty(trim($_POST["password"]))){
        $_SESSION["login_error"] = "password";
        $password_err = "Please enter your password.";
        setcookie("login_error","password",10);
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
                            $ses_uname = $_SESSION["username"];
                            $ses_uid = $_SESSION["id"];
                            $ses_id = $_COOKIE["PHPSESSID"];
                            $create_session = "UPDATE `users` SET `sesid`='$ses_id' WHERE id= $ses_uid";

                            if ($conn->query($create_session) === TRUE) {
                                header("location: index.html");
                            } else {
                                echo "Error: " . $create_session . "<br>" . $conn->error;
                            }
                        } else{
                            $_SESSION["login_error"] = "invalid";
                            $password_err = "The password you entered was not valid.";
                            setcookie("login_error","invalid",10);
                        }
                    }
                } else{
                    $_SESSION["login_error"] = "notfound";
                    $username_err = "No account found with that username.";
                    setcookie("login_error","notfound",10);
                }
            } else{
                $_SESSION["login_error"] = "other";
                echo "Oops! Something went wrong. Please try again later.";
                setcookie("login_error","other",10);
            }
        }


        mysqli_stmt_close($stmt);
    }


    mysqli_close($link);
}
?>