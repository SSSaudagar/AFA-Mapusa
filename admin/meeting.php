<?php
    require_once("../includes/DbConnection.php");
    session_start();
    if(!isset($_GET['id'])) die("id not set");
    
    if(isset($_POST)&&!empty($_POST)) {
        //print_r($_POST);
        $sql="delete from meetatten where meet_id={$_GET['id']}";
            mysql_query($sql);
        $sql="select id from members where active =1";
        $memb=mysql_query($sql);
        while($mem=mysql_fetch_assoc($memb)){
            if(isset($_POST['present'.$mem['id']])){
                $onstage=(isset($_POST['onstage'.$mem['id']]))? 1:0;
                $presenter=(isset($_POST['presenter'.$mem['id']]))? 1:0;
                $presentation=(empty($_POST['presentation'.$mem['id']]))? NULL:$_POST['presentation'.$mem['id']];
                $sql="INSERT INTO `afa`.`meetatten` (`meet_id`, `mem_id`, `presenter`, `onstage`, `presentation`) VALUES ('{$_GET['id']}', '{$mem['id']}', '{$presenter}', '{$onstage}', '{$presentation}');";
                    mysql_query($sql);
            }
        }
    }
    

    $sql="SELECT `members`.`id`, `name`, onstage, presenter, presentation FROM `members` left outer  join (select * from meetatten where meet_id={$_GET['id']}) as meetattn on members.id = meetattn.mem_id  WHERE `active`=1 order by name";
    $mems=mysql_query($sql);
    
    
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
    <script type="text/javascript">
	function checkall(){
		var c=document.getElementsByClassName('atten');
		for(var i=0;i<c.length;i++){
			c[i].checked=true;
		}
	}
	function clearall(){
		var c = document.getElementsByTagName('input');
		for(var i=0;i<c.length;i++){
			c[i].checked=false;
            c[i].value="";
		}
	}
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
          <a class="navbar-brand" href="./index.php">AFA - Mapusa</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li ><a href="index.php" >Home</a></li>    
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
        <div class="row"  style="float:right">
            <button class="btn btn-primary" onClick="checkall()">Select all</button>
            <button class="btn btn-info" onClick="clearall()">Clear all</button>
        </div>
        <div class="row">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?=$_GET['id']?>" method="post">
                <table class="table table-striped table-hover">
                    <thead>
                        <th ><center>Name</center></th>
                        <th ><center>Present</center></th>
                        <th ><center>On Stage</center></th>
                        <th ><center>Presenter</center></th>
                        <th ><center>Presentation</center></th>
                    </thead>
                    <tbody>
                        <?php 
                            while($mem=mysql_fetch_assoc($mems)){
                                ?>
                            <tr>
                                
                                <td><center><?=$mem['name'] ?></center></td>
                                <td><center><input type="checkbox" class="checkbox atten" name="present<?=$mem['id'] ?>" <?php if($mem['onstage']!=NULL) echo "checked"; ?>></center></td>
                                <td><center><input type="checkbox" class="checkbox" name="onstage<?=$mem['id'] ?>" <?php if($mem['onstage']==1) echo "checked"; ?>></center></td>
                                <td><center><input type="checkbox" class="checkbox" name="presenter<?=$mem['id'] ?>" <?php if($mem['presenter']==1) echo "checked"; ?>></center></td>
                                <td><center><input type="text" class="form-control" name="presentation<?=$mem['id'] ?>" value="<?php if($mem['presentation']!=NULL) echo $mem['presentation']; ?>"></center></td>
                            </tr>    
                        <?php
                            }
                        ?>
                        
                    </tbody>
                </table>
                <div class="form-submit">
                    <button type="submit" class="btn btn-success btn-block"><b>Submit</b></button>
                </div>
            </form>
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