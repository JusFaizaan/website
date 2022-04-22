<?php

// add PHP include for the header
include 'header.php';


//create for for signup
echo <<<_END
<div class='container-fluid'>
        <h3>SignUp</h3>
        <div class="form-group">
        <form action="SignUpSession.php" method="post" name="signup">
        <p><b>Username:</b> <input type="text" name="usernameSignUp" minlength="2" maxlength="20" size="16" placeholder="Username" required></p>
        <p><b>Password:</b> <input type="text" name="passwordSignUp" minlength="2" maxlength="20" size="16" placeholder="Password" required></p>
        <p><b>Age:</b> <input type="number" name="ageSignUp" min="18" max="99" size="4" placeholder="Age" required></p>
        <p><b>Email:</b> <input type="email" name="emailSignUp" size="30" placeholder="BigMan@gmail.com" required></p>
        <p><b>Firstname:</b> <input type="text" name="firstnameSignUp" minlength="2" maxlength="20" size="16" placeholder="Luke" required></p>
        <p><b>Lastname:</b> <input type="text" name="lastnameSignUp" minlength="2" maxlength="20" size="16" placeholder="Emia" required></p>
        <p><b>Phone Number:</b> <input type="tel" name="PNSignUp" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" size="16" placeholder="1253-456-7289" required></p>
        <p><b>City:</b> <input type="text" name="citySignUp" minlength="2" maxlength="20" size="16" placeholder="Manchester" required></p>
        <p><b>County:</b> <input type="text" name="countySignUp" minlength="2" maxlength="20" size="16" placeholder="Lancashire" required></p>
        <p><b>Country:</b> <input type="text" name="countrySignUp" minlength="2" maxlength="20" size="16" placeholder="England" required></p>
        </div>
        <p><input type="submit" value="Create">
        </form>
        </div>

_END;
        
        


// add PHP include for the footer
include 'footer.php';

?>