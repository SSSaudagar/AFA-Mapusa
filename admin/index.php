<?php
    require_once("../includes/DbConnection.php");
    session_start();
    $sql="SELECT * FROM  areas  WHERE 1 order by name ";
    $areas=mysql_query($sql);
    $sql="SELECT * FROM `members` WHERE active=1 order by name ";
    $progs=mysql_query($sql);
    $guide1=mysql_query($sql);
    $guide2=mysql_query($sql);
    if(isset($_POST)&&!empty($_POST)){
        if(isset($_POST['meet'])){
            $date=stripslashes(mysql_real_escape_string(trim($_POST['ldate'])));
            $ppt=stripslashes(mysql_real_escape_string(trim($_POST['ppt'])));
            $programmer=stripslashes(mysql_real_escape_string(trim($_POST['programmer'])));
            $guide1=stripslashes(mysql_real_escape_string(trim($_POST['guide1'])));
            $guide2=stripslashes(mysql_real_escape_string(trim($_POST['guide2'])));
            //print_r($_POST);
            $sql="INSERT INTO `afa`.`meetings` (`id`, `date`, `presentation`, `programmer`, `guide1`, `guide2`) VALUES (NULL, '{$date}', '{$ppt}', '{$programmer}', '{$guide1}', '{$guide2}');";
            //echo $sql;
            if(!mysql_query($sql)) die("MYSQL ERROR:".mysql_error());
            header("Location:meeting.php?id=".mysql_insert_id());
        }
        if(isset($_POST['prog'])){
            $date=stripslashes(mysql_real_escape_string(trim($_POST['ldate'])));
            $place=stripslashes(mysql_real_escape_string(trim($_POST['place'])));
            $progname=stripslashes(mysql_real_escape_string(trim($_POST['progname'])));
            $area=stripslashes(mysql_real_escape_string(trim($_POST['area'])));
            //print_r($_POST);
            $sql="INSERT INTO `afa`.`programmes` (`id`, `date`, `place`, `name`, `area`) VALUES (NULL, '{$date}', '{$place}', '{$progname}', '{$area}');";
//            echo $sql;
            if(!mysql_query($sql)) die("MYSQL ERROR:".mysql_error());
            header("Location:program.php?id=".mysql_insert_id());
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome to AFA Mapusa</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/jumbotron.css" rel="stylesheet">
    <link href="../assets/css/home.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="../assets/js/jsDatePick_ltr.min.css" />
    <style>
        #newitem{
            padding-right:10%;
            padding-left:10%;
        }
    </style>
    
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./index.php">AFA - Mapusa</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php" >Home</a></li>    
                <li><a href="browse.php">Browse</a></li>    
            </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"></a></li>
            <li><a href="../">Logout</a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
          </ul>
          
        </div>
      </div>
    </nav>
    <div class="jumbotron">
    	<div class="container">
            <center style="color:white">
            	<h3> Association of Friends of Astronomy (Mapusa)</h3>
                <p><h5>Puroshottam Walawalkar Higher Secondary School</h5></p>
                <h5> Khorlim Mapusa Goa 403507</h5>
            </center>
        </div>
    </div>
    <div class="container">
        <ul class="nav nav-tabs nav-justified" role="tablist" id="myTab" style="padding-bottom:30px">
          <li role="presentation" class="active"><a href="#program" aria-controls="program" role="tab" data-toggle="tab">New Program</a></li>
          <li role="presentation"><a href="#meeting" aria-controls="meeting" role="tab" data-toggle="tab">New Meeting</a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="program">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Programmes</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Date:</label>
                                <input class="form-control" type="text" name="ldate" id="ldate1" placeholder="Enter Date" required />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Place:</label>
                                <input class="form-control" type="text" name="place" id="place" placeholder="Enter Place" required />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Programme:</label>
                                <input class="form-control" type="text" name="progname" id="prog" placeholder="Programme name" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Area:</label>
                                <select class="form-control" name="area" id="area" required>
                                    <option value="">Select Area</option>
                                    <?php 
                                        while($area=mysql_fetch_assoc($areas)){
                                            echo "<option value=\"".$area['id']."\">".$area['name']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-submit">
                                <button type="submit" name="prog" class="btn btn-block btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="meeting">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Meeting</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Date:</label>
                                <input class="form-control" type="text" name="ldate" id="ldate2" placeholder="Enter Date" required />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Presentation:</label>
                                <input class="form-control" type="text" name="ppt" id="ppt" placeholder="Presentation" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Programmer:</label>
                                <select class="form-control" name="programmer" id="programmer" required>
                                    <option value="">Select Programmer</option>
                                    <?php 
                                        while($prog=mysql_fetch_assoc($progs)){
                                            echo "<option value=\"".$prog['id']."\">".$prog['name']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Guide 1:</label>
                                <select class="form-control" name="guide1" id="guide1" required>
                                    <option value="">Select Guide 1</option>
                                    <?php 
                                        while($guide=mysql_fetch_assoc($guide1)){
                                            echo "<option value=\"".$guide['id']."\">".$guide['name']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Guide 2:</label>
                                <select class="form-control" name="guide2" id="guide2" required>
                                    <option value="">Select Guide 2</option>
                                    <?php 
                                        while($guide=mysql_fetch_assoc($guide2)){
                                            echo "<option value=\"".$guide['id']."\">".$guide['name']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-submit">
                                <button type="submit" name="meet" class="btn btn-block btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery-1.9.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../assets/js/holder.min.js"></script>
    <script src="../assets/js/jsDatePick.min.1.3.js"></script>
    <script>
        $('#myTab a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })
    </script>
    <script>
        $(document).ready(function(){
            new JsDatePick({
                useMode:2,
                target:"ldate1",
                dateFormat:"%Y-%m-%d",
                yearsRange:[1978,2020],	
            });
            new JsDatePick({
                useMode:2,
                target:"ldate2",
                dateFormat:"%Y-%m-%d",
                yearsRange:[1978,2020],	
            });
        })
    </script>
</body>
</html>