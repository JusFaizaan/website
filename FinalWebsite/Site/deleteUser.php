<?php
if(isset($_POST['uid']))
{
    //get credentials for database 
    require_once 'credentials.php';
    $uid = $_POST['uid'];
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
      
    $message = "Update failed, please try again<";
    
    // Attempt to connect. Return an error if not.
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }
    //create query to delete user dependant on uid
    $query = "DELETE FROM users WHERE uid = $uid";
    echo $query;
    $result = mysqli_query($connection,$query);

    
    //navigate back to admin page if successful
    if ($result)
    {
        // navigate back to the admin page:
        header('Location:adminManage.php');
    }
          // show an unsuccessful delete message
    else
    {    

        include 'header.php';
        session_destroy();
        echo "<h4>Sorry, error deletinguser </h4>";
        echo "[<a href='index.php'>Click here to go back</a>] ";
        $_SESSION["loggedIn"]=false;
        include 'footer.php';
    }
        //if unsuccessful echo error message
    echo $message;
    mysqli_close($connection);
}