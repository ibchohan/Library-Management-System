
<?php

 $emailmsg="";
 $pasdmsg="";
 $msg="";

 $ademailmsg="";
 $adpasdmsg="";


 if(!empty($_REQUEST['ademailmsg'])){
    $ademailmsg=$_REQUEST['ademailmsg'];
 }

 if(!empty($_REQUEST['adpasdmsg'])){
    $adpasdmsg=$_REQUEST['adpasdmsg'];
 }

 if(!empty($_REQUEST['emailmsg'])){
    $emailmsg=$_REQUEST['emailmsg'];
 }

 if(!empty($_REQUEST['pasdmsg'])){
  $pasdmsg=$_REQUEST['pasdmsg'];
}

if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
 }

 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>'</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="overlay">
            <div class="title">
                 <h1>BOOK SPHERE</h1>
            </div>
            <div class="container login-container">
                <div class="row">
                    <div class="col-md-6 login-form-1">
                        <h3>Admin Login</h3>
                        <form action="loginadmin_server_page.php" method="get">
                            <div class="form-group">
                                <input type="text" class="form-control" name="login_email" placeholder="Your Email *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="login_pasword"  placeholder="Your Password *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btnSubmit" value="Login" />
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 login-form-2">
                        <h3>Student Login</h3>
                        <form action="login_server_page.php" method="get">
                            <div class="form-group">
                                <input type="text" class="form-control" name="login_email" placeholder="Your Email *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="login_pasword"  placeholder="Your Password *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btnSubmit" value="Login" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="" async defer></script>


        <!-- Add this at the end of your body tag -->

    <footer style="position: fixed; left: 0; bottom: 0; width: 100%;  background-color: rgba(255, 255, 255, 0.5); color: black; text-align: center; padding: 2px;">
        <p  style="font-size: 24px; font-weight: bold;">A LIBRARY MANAGEMENT SYSTEM</p>
        <p  style="font-size: 24px; ">DEVELOPED BY</p>
        <p  style="font-size: 18px; font-weight: bold;">INSHA JAVED (21K-3279)</p>
        <p  style="font-size: 18px; font-weight: bold;">SABIKA SHAMEEL (21K-4606)</p>
    </footer>

    </body>
</html>
