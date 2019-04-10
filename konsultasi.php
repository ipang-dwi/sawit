<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $_SESSION['judul']." - ".$_SESSION['welcome']." - oleh ".$_SESSION['by'];?></title>
	
    <!-- Bootstrap core CSS -->
    <link href="ui/css/bootstrap.css" rel="stylesheet">
	<link href="ui/css/united.min.css" rel="stylesheet">
	<link rel='stylesheet' href='ui/css/bootstrap-datepicker.min.css'>
	<link rel='stylesheet' href='ui/css/font-awesome.min.css'>
    
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="ui/css/bootstrap-select.min.css">
    
    <script src="ui/js/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="ui/js/bootstrap-select.min.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--script src="./index_files/ie-emulation-modes-warning.js"></script-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
	<div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $_SESSION['judul'];?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <?php if($_SESSION['level']=='admin'){ ?>
	      <li><a href="penyakit.php">Data Penyakit</a></li>
			   <li><a href="gejala.php">Data Gejala</a></li>
              <li><a href="pilihan.php">Data Pilihan</a></li>
	      <li><a href="user.php">Data User</a></li>
	      <?php } ?>
			   <li class="active"><a href="konsultasi.php">Konsultasi</a></li>
			  <li><a href="profile.php">Profile</a></li>
			  <li><a href="logout.php">Logout</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>'
	  <br><br><br>
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Konsultasi</li>
		</ol>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Konsultasi</div>
		  <div class="panel-body">
							<form role="form" method="post" action="add-u.php">
                                    <div class="box-body">
					<?php
						$p = $mysqli->query("select * from input where id_user = ".$_SESSION['id']."");
						if(!$p){
							echo $mysqli->connect_errno." - ".$mysqli->connect_error;
							exit();
						}
						$x = 0;
						while ($row = $p->fetch_assoc()){
							$x = 1;
						}
						if($x==0) echo "Anda belum melakukan konsultasi.<hr>";
						else echo "Anda sudah melakukan konsultasi.<hr>";
				         ?>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
					<?php
						if($x==0) echo '<a href="add-konsultasi.php" class="btn btn-primary">Lakukan Konsultasi</a>';
						else echo '<a href="perhitungan.php" class="btn btn-warning">Lihat Hasil Analisa</a>                                        
					<a href="edit-konsultasi.php" class="btn btn-primary">Edit Data Konsultasi Anda</a>';
					?>
                                    </div>
                            </form>
		  </div>
		  <div class="panel-footer"><b class="text-primary">By <?php echo $_SESSION['by'];?></b><b class="pull-right text-primary">&copy <?php echo date('Y');?></b></div>
		</div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="ui/js/bootstrap.min.js"></script>
	<script src="ui/js/bootswatch.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ui/js/ie10-viewport-bug-workaround.js"></script>
	<script src='ui/js/bootstrap-datepicker.min.js'></script>
    <script src="ui/js/index.js"></script>

</body></html>
