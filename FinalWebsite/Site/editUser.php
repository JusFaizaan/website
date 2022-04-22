<?php
// add PHP include for the header and validate info for verification of data
include 'header.php';
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
//set error message
$message = "Incorrect values please try again."; 


//after getting the userid create the form
if (isset($_POST['uid']))
{
    //set uid to the user that is going to be edited 
    $uid = $_POST['uid'];
    //create form
    echo <<<_END
    <div class='container-fluid'>
    <h3>Edit User</h3>    
    <div class="form-group">
    <form action="#" method="post" name="editPost">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" minlength="2" maxlength="16" size="20" placeholder="Username" required><br>
    <label for="password">Password:</label><br>
    <input type="text" id="password" name="password" minlength="2"  maxlength="16" size="20" placeholder="Password" required><br>
    <label for="firstname">Firstname:</label><br>
    <input type="text" id="firstname" name="firstname" minlength="2" maxlength="30" size="20" placeholder="Luke" required><br>
    <label for="lastname">Lastname:</label><br>
    <input type="text" id="lastname" name="lastname" minlength="2" maxlength="30" size="20" placeholder="Emia" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" size="30" placeholder="BigMan@gmail.com" required><br>
    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" min="18" max="99" size="4" placeholder="Age" required><br>
    <label for="city">City:</label><br>
    <input type="text" id="city" name="city" minlength="2" maxlength="30" size="20" placeholder="Manchester" required><br>
    <label for="county">County:</label><br>
    <input type="text" id="county" name="county" minlength="2" maxlength="30" size="20" placeholder="Lancashire" required><br>
    <label for="country">Country:</label><br>
    <input type="text" id="country" name="country" minlength="2" maxlength="30" size="20" placeholder="England" required><br>
    <label for="phone">Phone:</label><br>
    <input type="tel" id="phone" name="phone"  pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" size="20" placeholder="1253-456-7289" required><br>
    </div>
    <button name= "validate" value="$uid" type= "submit"  class="btn">Submit</button>
    </form>
    </div>
_END;
}

//if form has been submitted move to validate and submit data
if(isset($_POST['validate']))
{
    //get credentials for db 
    require_once 'credentials.php';
    //set edited values from form to new variables
    $usernameEdited = $_POST['username'];
    $passwordEdited = $_POST['password'];
    $firstnameEdited = $_POST['firstname'];
    $lastnameEdited = $_POST['lastname'];
    $emailEdited = $_POST['email'];
    $ageEdited = $_POST['age'];
    $cityEdited = $_POST['city'];
    $countyEdited = $_POST['county'];
    $countryEdited = $_POST['country'];
    $phoneEdited = $_POST['phone'];

    $uid = $_POST['validate'];
    //connect to database 
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    //sanitise and validate all the new data 
    $usernameEdited = sanitise($usernameEdited, $connection);
    $passwordEdited = sanitise($passwordEdited, $connection);
    $firstnameEdited = sanitise($firstnameEdited, $connection);
    $lastnameEdited = sanitise($lastnameEdited, $connection);
    $emailEdited = sanitise($emailEdited, $connection);
    $ageEdited = sanitise($ageEdited, $connection);
    $cityEdited = sanitise($cityEdited, $connection);
    $countyEdited = sanitise($countyEdited, $connection);
    $countryEdited = sanitise($countryEdited, $connection);
    $phoneEdited = sanitise($phoneEdited, $connection);

    $ageError = validateInt($ageEdited, 18, 99);
    $emailError = validateEmail($emailEdited);
    $usernamesError = validateString($usernameEdited,2 ,20); 
    $passwordsError = validateString($passwordEdited,2 ,20); 
    $firstnameError = validateString($firstnameEdited,2 ,30); 
    $lastnameError = validateString($lastnameEdited,2 ,30); 
    $cityError = validateString($cityEdited,2 ,30); 
    $countyError = validateString($countyEdited,2 ,30); 
    $countryError = validateString($countryEdited,2 ,30); 

    $errors=$ageError . $emailError. $usernamesError. $passwordsError. $firstnameError. $lastnameError. $cityError. $countyError. $countryError;
    // if db cant be access relay error message
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    //if errors is empty move on 
    if($errors == ""){
  
    //insert new data into the db 
    $query = "UPDATE users SET username = '$usernameEdited', password = '$passwordEdited', firstname ='$firstnameEdited', lastname = '$lastnameEdited', email = '$emailEdited', age = '$ageEdited', city = '$cityEdited', county = '$countyEdited', country = '$countryEdited', phone= '$phoneEdited' WHERE uid = $uid";
    echo $query;
    $result = mysqli_query($connection,$query);

    //send user back to homepage 
    if ($result)
    {
        // navigate back to the admin page:
        header('Location: adminManage.php');
    }
    else
    {    
        //if maor error destry session and logout user 
        session_destroy();
        include 'header.php';
        session_destroy();
        echo "<h4>Sorry, failed to edit user. You will be signed out</h4>";
        echo "[<a href='header.php'>Click here to go back</a>] ";
        include 'footer.php';
    }
}
    //echo error message if data could not be entered
    echo $message;
    mysqli_close($connection);


    include 'footer.php';
}