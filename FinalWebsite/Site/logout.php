<?php

// start/resume the session
session_start();

// Reset the session superglobal variable array
$_SESSION = array();

// Expire the session cookie - set expiry 30 days previous
setcookie(session_name(), '', time()-2592000,'/');

// Destroy the session on the server
session_destroy();

// Display the html for this page:

   header("location:index.php");
echo <<<_END
<!DOCTYPE html><head><title>Sessions Logout</title></head>
<body><h3>Sessions Logout</h3>

   <p>You are now logged out of the site.</p>

</body>
</html>
_END;
?> 