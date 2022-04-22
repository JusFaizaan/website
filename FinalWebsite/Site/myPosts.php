<?php

// add PHP include for the header and credentials for db
include 'header.php';
require_once "credentials.php";

// connect to the host:
$connection = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

// exit the script with a useful message if there was an error:
if (!$connection)
{
    die("Connection failed: " . $mysqli_connect_error);
}

echo <<<_END
        
        <h3>Your Posts</h3>    
_END;

//grab the correct uid and check the amount of rows that uid has for posts 
$uidCheck = "SELECT postid, title, created, content, image FROM posts WHERE uid = '". $_SESSION["uid"]."'";
$result = mysqli_query($connection, $uidCheck);
$n = mysqli_num_rows($result); 
echo "<div class='container-fluid'>";
 echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
//if number of rows is great than 0 create our table 
if ($n>0) {
        for ($i=0; $i<$n;$i++){

                $row = mysqli_fetch_assoc($result); 
                        echo "<tr>";
                        echo "<th>Title</th>";
                        echo "<th>Date Posted</th>";
                        echo "<th>Content</th>";
                        echo "<th>Image</th>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['created']}</td>";
                        echo "<td>{$row['content']}</td>";
                        //check for image 
                        if ($row["image"]==null){

                                echo "<td>No Image</td>";
                                }
                                else {
                                        echo "<td><img id ='myImage' src='{$row['image']}' alt='some image'></td>"; 
                                }
                        echo "<td><form method='POST' action='editPosts.php'><button type=submit  class='btn' name='editPostid' value='".$row['postid']."'>Edit</button></form></td>";
                        echo "<td><form method='POST' action='deletePosts.php'><button type=submit  class='btn' name='postid' value='".$row['postid']."'>Delete</button></form></td>";
                        echo "</tr>";

          }
           echo "</table>";
           echo "</div>";
      } 
      //else echo no results 
      else {
        echo "no result";
      }

      
// add PHP include for the footer
include 'footer.php';

?>