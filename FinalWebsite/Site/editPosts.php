<?php
// add PHP include for the header and credentials for database and validate info for verification of data
include 'header.php';
require_once "validateInfo.php";
require_once "credentials.php";

//Set some empty values
$fileSaveLocation= "";
$titleError= ""; 
$contentError= ""; 
$errors="";

$message = "Please ensure your posts contain between 2 and 20 characters for the title and 2 to 260 characters for the content"; 
// connect to the host
$connection = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

// exit the script with a useful message if there was an error:
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

//Create the form for editing the posts
if (isset($_POST['editPostid']))
{
    $posts = $_POST['editPostid'];
    echo <<<_END
    <div class='container-fluid'>
    <h3>Edit Your Post!</h3>    
    //Create the form for creating the posts
    <div class="form-group">
    <form action="#" method="post" name="editPost">
    <label for="Title">Title:</label><br>
    <input type="text" id="title" name="title" maxlength="16" size="16" placeholder="Title" required><br>
    <label for="content">Content:</label><br>
    <input type="text" id="content" name="content" maxlength="260" size="30" placeholder="Please add Content" required><br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    </div>
    <button name= "validate" value="$posts" type= "submit"  class="btn">Submit</button>
    </form>
    </div>
_END;
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

// if form above is validated move to if statement to sanitise and validate data
if(isset($_POST['validate']))
{
    //get credentials for db
    require_once 'credentials.php';
    //grab new values from form 
    $titleEdited = $_POST['title'];
    $contentEdited = $_POST['content'];
    $posts = $_POST['validate'];
    //sanitise and validate the new data
    $titleEdited = sanitise($titleEdited, $connection);
    $contentEdited = sanitise($contentEdited, $connection);
    $titleError = validateString($titleEdited, 2,20); 
    $contentError = validateString($contentEdited, 2, 260); 
    $errors=$titleError . $contentError;
    //attemp to connect to database 
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    // Attempt to connect. Return an error if not.
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }

    // if errors is empty continue to insert data
    if ($errors == ""){
    //insert new data
    $query = "UPDATE posts SET title = '$titleEdited', content = '$contentEdited', image = '$fileSaveLocation', created ='$dateTime' WHERE postid = $posts";
    echo $query;
    $result = mysqli_query($connection,$query);

    
    //send user back to their posts page 
    if ($result)
    {
        // navigate back to the admin page:
        header('Location: myPosts.php');
    }
    //if major error destroy session and logout user 
    else
    {    
        session_destroy();
        include 'header.php';
        session_destroy();
        echo "<h4>Sorry, failed to edit post. You will be signed out</h4>";
        echo "[<a href='header.php'>Click here to go back</a>] ";
        $_SESSION["loggedIn"]=false;
        include 'footer.php';
    }
}
    //echo error message if data could not be entered
    echo $message;
    mysqli_close($connection);


    include 'footer.php';
}