<?php
    session_start();
    require_once('./includes/DbConnection.php');
    $message1="";
	if(isset($_POST)&& !empty($_POST)){
//        print_r($_POST);
        $user=stripslashes(mysql_real_escape_string(trim($_POST['user'])));
        $pass=stripslashes(mysql_real_escape_string(trim($_POST['pass'])));
        if($user=='afaAdmin' && $pass=='astronomy'){
            session_unset();
            $_SESSION['type']=0;
            header("Location: admin/index.php");
            die();
        }else{
                $message1="Wrong Username or Password";
        }
        
        
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>AFA Mapusa Register</title>

        <!-- Bootstrap -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/signin.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
          <form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h2 class="form-signin-heading">Please sign in</h2>
            <input  class="form-control" name="user" placeholder="Email address" required autofocus>
            <input type="password" class="form-control" name="pass" placeholder="Password" required>
            <span style="color:red"><?= $message1 ?></span>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10"><button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:20px;">Sign in</button></div>  
            </div>  
          </form>
        </div> <!-- /container -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/js/jquery-1.9.0.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>