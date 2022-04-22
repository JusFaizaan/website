<?php
//start session 
session_start();
//default set for the date time in footer 
date_default_timezone_set('Europe/London');

//set date time values 
$dateTime = date('Y-m-d h:i:sa');
$onload= date('h:i:sa');

//check if the user is a registered user but not an admin 
if (isset($_SESSION["loggedIn"])== true && isset($_SESSION["admin"])== false)
{
    echo <<<_END
    <!DOCTYPE html>

    <html lang="en">
    <div class='container-fluid'>
    <head>
    <!-- set stylesheets and scripts that are to be used in the header  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link id="lnk" rel="stylesheet" href="WebCSS.css">



    <!-- JQUERY to change darkmode, lightmode, text size, font, text color and background color -->
    <script>
    // wait for the document to load before running any jQuery
    $(document).ready(function(){
        // select the dropdown and action when it changes
        $("#fontSelector").change(function() {
            var newFont = $(this).val();
            $("body").attr("style","font-family:"+newFont);
        })
        $('#darkmode').click(function (){
            $('link[href="WebCSS.css"]').attr('href','webCSSDark.css');
         });

         $('#lightmode').click(function (){
            $('link[href="webCSSDark.css"]').attr('href','WebCSS.css');
         });

         $("#chooseColour").change(function(){
            $("body").css("background-color", $(this).val());
         });

         $("#chooseColourText").change(function(){
            $("body").css("color", $(this).val());
         });

         $('#NormalFont').click(function (){
            $("body").css("fontSize", "12px");
         });

         $('#SmallFont').click(function (){
            $("body").css("fontSize", "8px");
         });

         $('#BigFont').click(function (){
            $("body").css("fontSize", "20px");
         });
    });
    </script>

            <img id ="myImage" src="cornerimage.png" class="img-rounded" alt="some image">
            <title>BlogSite.com</title>
            <div class="pull-right">
            <div id="txt"></div>

            <!-- create a form for setting fonts and buttons for changing the interface  -->
            <form>
            <label for="fontSelector">Choose a font family:</label>
            <select id="fontSelector">
                <option value="cursive">Cursive</option>
                <option value="monospace">Monospace</option>
                <option value="sans-serif">Sans-serif</option>
                <option value="serif">Serif</option>
                <option value="Arial"selected>Arial</option>
            </select>
        </form>
        <form id= "formInput">
        <label for="chooseColour">Choose background color:</label>
        <input type="color" id = "chooseColour" value = "#F5FBEF">
    </form>
    <form id= "formInput">
    <label for="chooseColourText">Choose text color:</label>
    <input type="color" id = "chooseColourText" value = "#F5FBEF">
    </form>
            <script src="custom.js"></script>
            <button id="darkmode">DarkMode</button>
            <button id="lightmode">LightMode</button><br>
            <button id="NormalFont">Normal Font</button>
            <button id="SmallFont">Small Font</button>
            <button id="BigFont">Big Font</button>
            <script src="custom.js"></script>
  
        </div>

        </head>
        
        </div>
    
        <body onload="startTime()">


        <!-- add an id attribute with the value #top-header to the tags that surround the header text  -->
            <header>
                <h1 id="top-header">BlogSite.com</h1>
                <h3>Another social media website cuz apparently the world does not have enough of them</h3>
            </header>
            <!-- apply the menu CSS formatting using a DIV tag-->
            <nav id="menu">
                [<a href="index.php">Home</a>] 
                [<a href="Login.php">Login</a>] 
                [<a href="createPosts.php">Create Post</a>] 
                [<a href="myPosts.php">My Posts</a>] 
                [<a href="Logout.php">Logout ({$_SESSION["username"]})</a>]
            </nav>
            <hr>
    _END;

}
//check if the user is a registered user and an admin 
elseif (isset($_SESSION["loggedIn"])== true && isset($_SESSION["admin"])== true){

    echo <<<_END
    <!DOCTYPE html>
    <html lang="en">
    <div class='container-fluid'>
    <head>
    <!-- set stylesheets and scripts that are to be used in the header  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link id="lnk" rel="stylesheet" href="WebCSS.css">


    <!-- JQUERY to change darkmode, lightmode, text size, font, text color and background color -->
    <script>
    // wait for the document to load before running any jQuery
    $(document).ready(function(){
        // select the dropdown and action when it changes
        $("#fontSelector").change(function() {
            var newFont = $(this).val();
            $("body").attr("style","font-family:"+newFont);
        })
        $('#darkmode').click(function (){
            $('link[href="WebCSS.css"]').attr('href','webCSSDark.css');
         });

         $('#lightmode').click(function (){
            $('link[href="webCSSDark.css"]').attr('href','WebCSS.css');
         });

         $("#chooseColour").change(function(){
            $("body").css("background-color", $(this).val());
         });

         $("#chooseColourText").change(function(){
            $("body").css("color", $(this).val());
         });

         $('#NormalFont').click(function (){
            $("body").css("fontSize", "12px");
         });

         $('#SmallFont').click(function (){
            $("body").css("fontSize", "8px");
         });

         $('#BigFont').click(function (){
            $("body").css("fontSize", "20px");
         });
    });
    </script>


            <!-- link to the external style sheet named tuesday.css -->


            <img id ="myImage" src="cornerimage.png" alt="some image" >
            <title>BlogSite.com</title>
            <div class="pull-right">
            <div id="txt"></div>

            <!-- create a form for setting fonts and buttons for changing the interface  -->
            <form>
            <label for="fontSelector">Choose a font family:</label>
            <select id="fontSelector">
                <option value="cursive">Cursive</option>
                <option value="monospace">Monospace</option>
                <option value="sans-serif">Sans-serif</option>
                <option value="serif">Serif</option>
                <option value="Arial"selected>Arial</option>
            </select>
        </form>
        <form id= "formInput">
        <label for="chooseColour">Choose background color:</label>
        <input type="color" id = "chooseColour" value = "#F5FBEF">
    </form>
    
    <form id= "formInput">
    <label for="chooseColourText">Choose text color:</label>
    <input type="color" id = "chooseColourText" value = "#F5FBEF">
    </form>
            <script src="custom.js"></script>
            <button id="darkmode">DarkMode</button>
            <button id="lightmode">LightMode</button><br>
            <button id="NormalFont">Normal Font</button>
            <button id="SmallFont">Small Font</button>
            <button id="BigFont">Big Font</button>
            <script src="custom.js"></script>

        </div>

        </head>
        </div>
    
        <body onload="startTime()">


        <!-- add an id attribute with the value #top-header to the tags that surround the header text  -->
            <header>
                <h1 id="top-header">BlogSite.com</h1>
                <h3>Another social media website cuz apparently the world does not have enough of them</h3>
            </header>
            <!-- apply the menu CSS formatting using a DIV tag-->
            <nav id="menu">
                [<a href="index.php">Home</a>] 
                [<a href="Login.php">Login</a>] 
                [<a href="createPosts.php">Create Post</a>] 
                [<a href="myPosts.php">My Posts</a>] 
                [<a href="Logout.php">Logout ({$_SESSION["username"]})</a>]
                [<a href="adminManage.php">Manage Posts and Users</a>] 
            </nav>
            <hr>
    _END;


    
}
    //if user is not a registered user or an admin set to default page header 
    else{

    echo <<<_END
    
    <!DOCTYPE html>
    <html lang="en">
    <div class='container-fluid'>
        <head>
        <!-- set stylesheets and scripts that are to be used in the header  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link id="lnk" rel="stylesheet" href="WebCSS.css">

        <!-- JQUERY to change darkmode, lightmode, text size, font, text color and background color -->
        <script>
        // wait for the document to load before running any jQuery
        $(document).ready(function(){
            // select the dropdown and action when it changes
            $("#fontSelector").change(function() {
                var newFont = $(this).val();
                $("body").attr("style","font-family:"+newFont);
            })
            $('#darkmode').click(function (){
                $('link[href="WebCSS.css"]').attr('href','webCSSDark.css');
             });

             $('#lightmode').click(function (){
                $('link[href="webCSSDark.css"]').attr('href','WebCSS.css');
             });

             $("#chooseColour").change(function(){
                $("body").css("background-color", $(this).val());
             });

             $("#chooseColourText").change(function(){
                $("body").css("color", $(this).val());
             });


             $('#NormalFont').click(function (){
                $("body").css("fontSize", "12px");
             });

             $('#SmallFont').click(function (){
                $("body").css("fontSize", "8px");
             });

             $('#BigFont').click(function (){
                $("body").css("fontSize", "20px");
             });

        });
        </script>

            <!-- link to the external style sheet named tuesday.css -->


            <img id ="myImage" src="cornerimage.png" alt="some image" >
            <title>BlogSite.com</title>
            <div class="pull-right">
            <div id="txt"></div>
 
            <!-- create a form for setting fonts and buttons for changing the interface  -->
            <form>
            <label for="fontSelector">Choose a font family:</label>
            <select id="fontSelector">
                <option value="cursive">Cursive</option>
                <option value="monospace">Monospace</option>
                <option value="sans-serif">Sans-serif</option>
                <option value="serif">Serif</option>
                <option value="Arial"selected>Arial</option>
            </select>
        </form>
        <form id= "formInput">
        <label for="chooseColour">Choose background color:</label>
        <input type="color" id = "chooseColour" value = "#F5FBEF">
    </form>
    <form id= "formInput">
    <label for="chooseColourText">Choose text color:</label>
    <input type="color" id = "chooseColourText" value = "#F5FBEF">
    </form>
            <script src="custom.js"></script>
            <button id="darkmode">DarkMode</button>
            <button id="lightmode">LightMode</button><br>
            <button id="NormalFont">Normal Font</button>
            <button id="SmallFont">Small Font</button>
            <button id="BigFont">Big Font</button>
        </div>
        </head>
        </div>
    
        <body onload="startTime()" >
        <!-- add an id attribute with the value #top-header to the tags that surround the header text  -->
            <header>
                <h1 id="top-header">BlogSite.com</h1>
                <h3>Another social media website cuz apparently the world does not have enough of them</h3>
            </header>
            <!-- apply the menu CSS formatting using a DIV tag-->
            <nav id="menu">
                [<a href="index.php">Home</a>] 
                [<a href="Login.php">Login</a>] 
                [<a href="SignUp.php">SignUp</a>] 
                [<a href="createPosts.php">Create Post</a>] 
            </nav>
            <hr>
    _END;


}





?>