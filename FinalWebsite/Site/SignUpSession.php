<?php
// get credentials for db and validateinfo for use later 
require_once "credentials.php";
require_once "validateInfo.php";

//set empty values 
$ageError= ""; 
$emailError= ""; 
$errors="";
$usernamesError = ""; 
$passwordsError ="" ; 
$firstnameError = ""; 
$lastnameError = ""; 
$cityError = ""; 
$countyError = ""; 
$countryError ="" ; 


// connect to the host:
$connection = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

// exit the script with a useful message if there was an error:
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}


//set values from the form in SignUp.php
$usernames = $_POST["usernameSignUp"];
$passwords = $_POST["passwordSignUp"];
$firstname = $_POST["firstnameSignUp"];
$lastname= $_POST["lastnameSignUp"];
$PN = $_POST["PNSignUp"];
$city = $_POST["citySignUp"];
$county = $_POST["countySignUp"];
$country = $_POST["countrySignUp"];
$email = $_POST["emailSignUp"];
$age = $_POST["ageSignUp"];
//Sanitise and validate all the data 
$usernames = sanitise($usernames, $connection);
$passwords = sanitise($passwords, $connection);
$firstname = sanitise($firstname, $connection);
$lastname = sanitise($lastname, $connection);
$PN = sanitise($PN, $connection);
$city = sanitise($city, $connection);
$county = sanitise($county, $connection);
$country = sanitise($country, $connection);
$email = sanitise($email, $connection);
$age = sanitise($age, $connection);

$ageError = validateInt($age, 18, 99);
$emailError = validateEmail($email);
$usernamesError = validateString($usernames,2 ,20); 
$passwordsError = validateString($passwords,2 ,20); 
$firstnameError = validateString($firstname,2 ,30); 
$lastnameError = validateString($lastname,2 ,30); 
$cityError = validateString($city,2 ,30); 
$countyError = validateString($county,2 ,30); 
$countryError = validateString($country,2 ,30); 



$errors=$ageError . $emailError. $usernamesError. $passwordsError. $firstnameError. $lastnameError. $cityError. $countyError. $countryError;


//if no errors add all the new data in the db 
if($errors == ""){
    $sql = "INSERT INTO users (username, password, firstname, lastname, phone, city, county,country, email, age) VALUES ('$usernames', '$passwords','$firstname','$lastname','$PN','$city','$county','$country','$email','$age')";

    //if successfull show a success message 
    if (mysqli_query($connection, $sql))
    {
        include 'header.php';
        session_destroy();
        echo "<h4>SignUp succesful, You may now login!</h4>";
        echo "[<a href='login.php'>Click here to login </a>] ";
        $_SESSION["loggedIn"]=false;
        include 'footer.php';
        
    }
    //else destroy the session and show an error message
    else
    {

        include 'header.php';
        session_destroy();
        echo "<h4>Sorry, error signing up</h4>";
        echo "[<a href='index.php'>Click here to go back</a>] ";
        $_SESSION["loggedIn"]=false;
        include 'footer.php';
    }

}


?>