<?php
//footer for all page 

//Show the server and request and datetime in footer
echo <<<_END
        <footer>
            <hr>

            <!-- assign an id attribute to the tags that surround your footer information  -->
            <h5 id="bottom-footer">Blogsite.com</h5>

            <!-- new content using PHP superglobals and functions -->
            <h6>Hosted on the {$_SERVER['SERVER_NAME']} server and requested by {$_SERVER['REMOTE_ADDR']} at $dateTime</h6>
            </footer>       
  

    </body>
</html>
_END;

?>