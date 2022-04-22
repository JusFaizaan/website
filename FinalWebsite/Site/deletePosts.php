<?php
if(isset($_POST['postid']))
{
    //get credentials for database 
    require_once 'credentials.php';
    $postid = $_POST['postid'];
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $message = "Update failed, please try again";
    // Attempt to connect. Return an error if not.
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }
    //create query to delete post dependant on postid
    $query = "DELETE FROM posts WHERE postid = $postid";
    echo $query;
    $result = mysqli_query($connection,$query);

    
    //navigate back to home page if successful
    if ($result)
    {
        // navigate back to the home page:
        header('Location:index.php');
    }
            // show an unsuccessful delete message:
    else
    {    
        include 'header.php';
        session_destroy();
        echo "<h4>Sorry, error deleting post</h4>";
        echo "[<a href='index.php'>Click here to go back</a>] ";
        $_SESSION["loggedIn"]=false;
        include 'footer.php';


    }
    //if unsuccessful echo error message
    echo $message;
    mysqli_close($connection);
}