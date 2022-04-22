<?php
// add PHP include for the header and credentials for database and validate info for verification of data
require_once "credentials.php";
include 'header.php';
require_once "validateInfo.php";

//Set some empty values
$fileSaveLocation = "";
$titleError= ""; 
$contentError= ""; 
$errors="";
$message = "Please ensure your posts contain between 2 and 20 characters for the title and 2 to 260 characters for the content"; 

// connect to the host:
$connection = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

// exit the script with a useful message if there was an error:
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

//Allow for file upload of an image file 
if(isset($_FILES["fileToUpload"])){
  $target_dir = "img/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $filename = $_FILES["fileToUpload"]["name"]; 
  $fileSaveLocation= $target_dir.$filename; 
  $tmpLocation= $_FILES["fileToUpload"]["tmp_name"];

}

//Set values using $_POST from createPosts.php and UID using the session login 
$title = $_POST["title"];
$content = $_POST["content"];

//Sanitise and validate our data
$title = sanitise($title, $connection);
$content = sanitise($content, $connection);
$titleError = validateString($title, 2,20); 
$contentError = validateString($content, 2, 260); 


$errors=$titleError . $contentError;

//if errors are empty continue
if($errors == ""){
    
$userid = $_SESSION["uid"];
    //insert data depending on userid
    if($userid == null ){
        $sql = "INSERT INTO posts (title, content, image, created) VALUES ('$title', '$content', '$fileSaveLocation', '$dateTime')";

    }
    else{
        $sql = "INSERT INTO posts (uid, title, content, image, created) VALUES ('$userid', '$title', '$content', '$fileSaveLocation', '$dateTime')";
    }



    //send user back to index page 
    if (mysqli_query($connection, $sql))
    {
        header("location:index.php");
    }
    //if error destroy session and logout user 
    else
    {
        session_destroy();
        include 'header.php';
        session_destroy();
        echo "<h4>Sorry, Post was not create</h4>";
        echo "[<a href='index.php'>Click here to go back</a>] ";
        $_SESSION["loggedIn"]=false;
        include 'footer.php';
    }
}
//if invalid data echo and an error message
    echo $message;
    // add PHP include for the footer
include 'footer.php';
    mysqli_close($connection);


// Check if image file is a actual image or fake image




?>