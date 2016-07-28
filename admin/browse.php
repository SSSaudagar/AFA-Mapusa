<?php
    require_once("../includes/DbConnection.php");
    $sql="SELECT `programmes`.id as id,`date`, `place`, programmes.name, `areas`.`name` as area FROM `programmes` left outer join areas on programmes.area=areas.id WHERE 1 order by date desc ";
    $pgms=mysql_query($sql);
    $sql="SELECT id,`date`, `presentation` FROM `meetings` WHERE 1 order by date desc ";
    $meet=mysql_query($sql);
    
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
    <style>
        #newitem{
            padding-right:10%;
            padding-left:10%;
        }
    </style>
    <script>
        <?= $msg ?>
    </script>
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
          <a class="navbar-brand" href="./">AFA - Mapusa</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li ><a href="index.php" >Home</a></li>    
                <li class="active"><a href="browse.php">Browse</a></li>    
            </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"></a></li>
            <li><a href="./index.php">Logout</a></li>
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
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Programmes</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Date</th>
                                <th>Program</th>
                                <th>Place</th>
                            </thead>
                            <tbody>
                                <?php 
                                    while($det=mysql_fetch_assoc($pgms)){
                                ?>
                                            <tr onclick="window.location.assign('./program.php?id=<?=$det['id']?>')" >
                                                <td><?=date("d-m-Y",strtotime($det['date']))?></td>
                                                <td><?=$det['name']?></td>
                                                <td><?=$det['place']?>, <?=$det['area']?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Meetings</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Date</th>
                                <th>Program</th>
                            </thead>
                            <tbody>
                                <?php 
                                    while($det=mysql_fetch_assoc($meet)){
                                ?>
                                            <tr onclick="window.location.assign('./meeting.php?id=<?=$det['id']?>')">
                                                <td><?=date("d-m-Y",strtotime($det['date']))?></td>
                                                <td><?=$det['presentation']?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
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

</body>
</html>