<?php 
// add PHP include for the header and credentials for database
include 'header.php';
require_once "credentials.php";

 // connect directly to our database:
 $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

 // Attempt to connect. Return an error if not.
 if (!$connection)
 {
     die("Connection failed: " . $mysqli_connect_error);
 }

  echo '<h1> Admin Area </h1>';
//Query to show all the posts from our database 
$sql = "SELECT p.postid, p.uid, p.title, p.created, p.content, p.image, u.firstname, u.lastname
FROM posts p JOIN users u
ON u.uid = p.postid
ORDER BY p.created DESC";

//set a result variable for our query and count the number of rows ($n)
$result = mysqli_query($connection, $sql);
$n = mysqli_num_rows($result); 
echo "<div class='container-fluid'>";


//Create our table for posts
 echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
if ($n>0) {
                echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>Posted By</th>";
                echo "<th>Date Posted</th>";
                echo "<th>Content</th>";
                echo "<th>Image</th>";
                echo "<th>Options</th>";
                echo "</tr>";
        //Verify the users who made the posts while presenting the data we pulled from our query 
        for ($i=0; $i<$n;$i++){

                $row = mysqli_fetch_assoc($result); 

                        echo "<tr>";
                        echo "<div class='col'>";
                        echo "<td>{$row['title']}</td>";
                        echo "</div>";
                        //check author of post
                        if ($row["uid"]!==null){

                        echo "<div class='col'>";
                        echo "<td>{$row['firstname']} {$row['lastname']}</td>";
                        echo "</div>";
                        }
                        else {
                                
                                echo "<div class='col'>";
                                echo "<td>Anonymous</td>";
                                echo "</div>";
                        }

  
                        echo "<div class='col'>";
                        echo "<td>{$row['created']}</td>";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo "<td>{$row['content']}</td>";
                        echo "</div>";
                        //check whether there is an image available
                        if ($row["image"]==null){

                                echo "<td>No Image</td>";
        
                                }
        
                                else {
                                        echo "<td><img id ='myImage' src='{$row['image']}' alt='some image'></td>"; 
                                }
                                echo "<td><form method='POST' action='deletePosts.php'><button type=submit  class='btn' name='postid' value='".$row['postid']."'>Delete</button></form></td>";

                        echo "</tr>";

          }
           echo "</table>";
           echo "</div>";
      } else {
        echo "no result";
      }

      //Query to pull all users from our database 
      $query = "SELECT uid, username, password, firstname, lastname, email, age, city, county, country, phone FROM users";
      $result2 = mysqli_query($connection, $query);
      // Retrieve the number of rows 
      $n = mysqli_num_rows($result2); 
      // Check if we did get any data in return, if not, then don't create the table
      if ($n > 0) 
      {
        echo "<div class='container-fluid'>";

          echo '<table class="flat-table table-striped table-bordered table-hover table-condensed">';

          echo '<tr>
          <th><h3>ID</h3></th>
          <th><h3>Username</h3></th>
          <th><h3>Password</h3></th>
          <th><h3>Update</h3></th>
          <th><h3>Delete</h3></th>
          </tr>';
          //Present all the users we pulled from our database
          while($row = mysqli_fetch_assoc($result2))
          {
              echo '<tr>';
              echo "<div class='col'>";
              echo "<td>{$row['uid']}</td><td>{$row['username']}</td><td>{$row['password']}</td>"; 
              echo "</div>";
              echo "<div class='col'>";
              echo '<td><form method="POST" action="editUser.php"><button type=submit  class="btn" name="uid" value="'.$row['uid'].'">Update</button></form></td>';
              echo "</div>";
              echo "<div class='col'>";
              echo '<td><form method="POST" action="deleteUser.php"><button type=submit  class="btn" name="uid" value="'.$row['uid'].'">Delete</button></form></td>';
              echo "</div>";
              echo '</tr>';
          }
          echo '</table>';
          echo "</div>";

      }
      //if no users were found present this message
      else
      {
          echo "no users found<br>";
      }
      
// add PHP include for the footer
include 'footer.php';

?>