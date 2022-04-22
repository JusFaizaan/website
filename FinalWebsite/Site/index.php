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


//check if the session is logged in and display the logged in users name 
if (isset( $_SESSION["loggedIn"])== true){

        echo"<h3>Welcome {$_SESSION["username"]}</h3> ";

        }
        //else display normal welcome message
        else {

                echo"<h3>Welcome</h3> ";
        }
        //create a form for ordering posts
        echo"<form method= 'POST' name='order' id='order'>"; 
       echo"<select name='order' id='order'>";
       echo"<option value='Recent'>Most Recent</option>";
       echo"<option value='Oldest'>Oldest</option>";
       echo"<option value='alphabetical'>A-Z(title)</option>";
       echo"</select>";
       echo "<button type= submit class='btn' >submit</button>";
       echo"</form>"; 


       //order the user posts depending on if they want recent or oldest posts
       if(isset($_POST["order"])){
        if($_POST["order"]==  "Recent"){

                $sql = "SELECT p.postid, p.uid, p.title, p.created, p.content, p.image, u.firstname, u.lastname
                FROM posts p LEFT JOIN users u
                ON u.uid = p.uid
                ORDER BY p.created DESC";
        }
        elseif($_POST["order"]==  "alphabetical") {
                $sql = "SELECT p.postid, p.uid, p.title, p.created, p.content, p.image, u.firstname, u.lastname
                FROM posts p LEFT JOIN users u
                ON u.uid = p.uid
                ORDER BY p.title ASC";
        }
        else{
                $sql = "SELECT p.postid, p.uid, p.title, p.created, p.content, p.image, u.firstname, u.lastname
                FROM posts p LEFT JOIN users u
                ON u.uid = p.uid
                ORDER BY p.created ASC";
        }
 
       }
       //default 
       else{
        $sql = "SELECT p.postid, p.uid, p.title, p.created, p.content, p.image, u.firstname, u.lastname
        FROM posts p LEFT JOIN users u
        ON u.uid = p.uid
        ORDER BY p.created DESC";

       }

//check the number of rows
$result = mysqli_query($connection, $sql);
$n = mysqli_num_rows($result); 
echo "<div class='container-fluid'>";;

 echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
 //if number of rows is greater than 0 then we create our table 
if ($n>0) {

        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Posted By</th>";
        echo "<th>Date Posted</th>";
        echo "<th>Content</th>";
        echo "<th>Image</th>";
        echo "</tr>";
        for ($i=0; $i<$n;$i++){

                $row = mysqli_fetch_assoc($result); 


                        echo "<tr>";
                        echo "<div class='col'>";
                        echo "<td class='card'>{$row['title']}</td>";
                        echo "</div>";
                        //check author of post 
                        if ($row["uid"]!==null){
                        echo "<div class='col'>";
                        echo "<td class='card'>{$row['firstname']} {$row['lastname']}</td>";
                        echo "</div>";
                        }
                        else {
                                echo "<div class='col'>";
                                echo "<td class='card'>Anonymous</td>";
                                echo "</div>";
                        }
                        echo "<div class='col'>";
                        echo "<td class='card'>{$row['created']}</td>";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo "<td class='card'>{$row['content']}</td>";
                        echo "</div>";
                        //check whether there is an image 
                        if ($row["image"]==NULL){
                                echo "<div class='col'>";
                                echo "<td class='card'>No Image</td>";
                                echo "</div>";
                                }
                                else {
                                        echo "<div class='col'>";
                                        echo "<td class='card'><img id ='myImage' src='{$row['image']}' alt='some image'></td>"; 
                                        echo "</div>";
                                }

                        echo "</tr>";

          }
           echo "</table>";
           echo "</div>";

      } 
      //if no data show no results 
      else {
        echo "no result";
      }
      
// add PHP include for the footer
include 'footer.php';

?>