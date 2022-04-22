<?php 

// add PHP include for the header and credentials for database
include 'header.php';
require_once "credentials.php";


// We'll use the procedural (rather than object oriented) mysqli calls

// connect to the host:
$connection = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

// exit the script with a useful message if there was an error:
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

//Create the form for creating the posts
echo <<<_END
<div class='container-fluid'>
        <h3>Create Your Post!</h3>    


        <div class="form-group">
        <form action="createPostsSession.php" method="post" name="createPost" enctype="multipart/form-data>
        <label for="Title">Title:</label><br>
        <input type="text" id="title" name="title" minlength="2" maxlength="16" size="16" placeholder="Title" required><br>
        <label for="content">Content:</label><br>
        <input type="text" id="content" name="content" minlength="2" maxlength="260" size="30" placeholder="Please add Content" required><br>
        <label for="image">Image Link:</label><br>
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        
        </div>
        <p><input type="submit" value="Create"  class="btn">
        </form>
        </div>
_END;

// add PHP include for the footer
include 'footer.php';

?> 