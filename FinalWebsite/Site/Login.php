<?php

// add PHP include for the header
include 'header.php';


//create form to login 
echo <<<_END
<div class='container-fluid'>
        <h3>Login</h3>
        <div class="form-group">

        <form action="loginSession.php" method="post" name="login">
        <p><b>Username:</b> <input type="text" name="username" minlength="2" maxlength="20" size="16" placeholder="Username" required></p>
        <p><b>Password:</b> <input type="text" name="password" minlength="2" maxlength="16" size="16" placeholder="Password" required></p>
        </div>
        <p><input type="submit" value="Login"  class="btn">
        </form>
        </div>
_END;

// add PHP include for the footer
include 'footer.php';

?>