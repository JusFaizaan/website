<?php
//start session 
session_start();

//grab credentials for db and valiadteinfo for later use
require_once "credentials.php";
require_once "validateInfo.php";

//set empty values 
$usernameError = ""; 
$passwordError = ""; 


// connect to the host:
$connection = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

// exit the script with a useful message if there was an error:
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

// use these settings to switch on/off page content and check for admin 
$generic = false;
$valid = false;
$uid = null; 
$admin = false; 

// check that a username and password have been sent using POST
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $vUsername = $_POST["username"];
    $vPassword = $_POST["password"];
    //sanitise and validate data
    $vUsername = sanitise($vUsername, $connection);
    $vPassword = sanitise($vPassword, $connection);

    $usernameError= validateString($vUsername,2, 20); 
    $passwordError= validateString($vPassword,2, 20); 

    $errors=$usernameError . $passwordError;

    //if no errors continue 
    if ($errors == ""){

    $query = "SELECT * FROM users WHERE username='$vUsername' AND password='$vPassword'";
    $result = mysqli_query($connection,$query);
        //get the number of rows...if there is more than 0 we found a user
    $n = mysqli_num_rows($result);
       //if n is great than 1 then the login is valid 
    if ($n>0){
        $_SESSION["username"]= $vUsername; 
        $_SESSION["loggedIn"] = true;
        $row = mysqli_fetch_assoc($result); 
        $uid = $row['uid'];

        $_SESSION["uid"]= $uid; 
        $valid=true;

        //check if an admin
        if ($vUsername == "admin"){
            $admin= true; 
            $_SESSION["admin"]= $admin; 
        }
        else{
            $admin= false; 
        }
    }
    }
}


    // The login attempt has failed logout user and destroy session 
    if($n==0) {
        session_destroy();
        include 'header.php';
        session_destroy();
        echo "<h4>Sorry, login attempt failed.</h4>";
        echo "[<a href='logout.php'>Click here to go back</a>] ";
        $_SESSION["loggedIn"]=false;
        include 'footer.php';
    }
    
//else send user to the index 
if ($valid) {

    header("location:index.php");

}


// finish the HTML for the page
echo <<<_END
</body>
</html>
_END;
?> 