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
			   <li><a href="konsultasi.php">Konsultasi</a></li>
			  <li><a href="profile.php">Profile</a></li>
			  <li><a href="logout.php">Logout</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>'
	  <br><br><br>
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="konsultasi.php">Konsultasi</a></li>
		  <li class="active">Edit Data Konsultasi</li>
		</ol>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Edit Data Konsultasi</div>
		  <div class="panel-body">
							<form role="form" method="post" action="edit-kon.php">
                                    <div class="box-body">
											<?php 
												$p = $mysqli->query("select * from input where id_user = ".$_SESSION['id']."");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												$i = 1;
												while ($row = $p->fetch_assoc()) {
													$data[1][$i] = $row["id_gejala"];
													$data[2][$i] = $row["id_pilihan"];		
													$i++;
												}
											?>
					Masukkan gejala yang ditemukan pada tanaman kelapa sawit :</br></br>		
										<div class="form-group">
                                            <label for="gejala1">Gejala 1</label>
						<select class="form-control selectpicker" name="gejala1" id="gejala1" data-live-search="true">
						  <?php 
												$p = $mysqli->query("select * from gejala");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												while ($row = $p->fetch_assoc()) {
											?>
												<option data-tokens="<?php echo $row["gejala"];?>" value='<?php echo $row["id_gejala"];?>' <?php if($data[1][1]==$row["id_gejala"]) echo "selected"?>><?php echo $row["id_gejala"].'. '.ucwords($row["gejala"]);?></option>
										    <?php
												}
											?>
						</select>
						<select class="form-control selectpicker" name="pilihan1" id="pilihan1" data-live-search="true">
						  <?php 
												$p = $mysqli->query("select * from pilihan");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												while ($row = $p->fetch_assoc()) {
											?>
												<option data-tokens="<?php echo $row["pilihan"];?>" value='<?php echo $row["id_pilihan"];?>' <?php if($data[2][1]==$row["id_pilihan"]) echo "selected"?>><?php echo ucwords($row["pilihan"]);?></option>
										    <?php
												}
											?>
						</select>	
                                        </div>
										<div class="form-group">
                                            <label for="gejala1">Gejala 2</label>
						<select class="form-control selectpicker" name="gejala2" id="gejala2" data-live-search="true">
						  <?php 
												$p = $mysqli->query("select * from gejala");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												while ($row = $p->fetch_assoc()) {
											?>
												<option data-tokens="<?php echo $row["gejala"];?>" value='<?php echo $row["id_gejala"];?>' <?php if($data[1][2]==$row["id_gejala"]) echo "selected"?>><?php echo $row["id_gejala"].'. '.ucwords($row["gejala"]);?></option>
										    <?php
												}
											?>
						</select>
						<select class="form-control selectpicker" name="pilihan2" id="pilihan2" data-live-search="true">
						  <?php 
												$p = $mysqli->query("select * from pilihan");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												while ($row = $p->fetch_assoc()) {
											?>
												<option data-tokens="<?php echo $row["pilihan"];?>" value='<?php echo $row["id_pilihan"];?>' <?php if($data[2][2]==$row["id_pilihan"]) echo "selected"?>><?php echo ucwords($row["pilihan"]);?></option>
										    <?php
												}
											?>
						</select>		
                                        </div>					
										<div class="form-group">
                                            <label for="gejala1">Gejala 3</label>
						<select class="form-control selectpicker" name="gejala3" id="gejala3" data-live-search="true">
						  <?php 
												$p = $mysqli->query("select * from gejala");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												while ($row = $p->fetch_assoc()) {
											?>
												<option data-tokens="<?php echo $row["gejala"];?>" value='<?php echo $row["id_gejala"];?>' <?php if($data[1][3]==$row["id_gejala"]) echo "selected"?>><?php echo $row["id_gejala"].'. '.ucwords($row["gejala"]);?></option>
										    <?php
												}
											?>
						</select>
						<select class="form-control selectpicker" name="pilihan3" id="pilihan3" data-live-search="true">
						  <?php 
												$p = $mysqli->query("select * from pilihan");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												while ($row = $p->fetch_assoc()) {
											?>
												<option data-tokens="<?php echo $row["pilihan"];?>" value='<?php echo $row["id_pilihan"];?>' <?php if($data[2][3]==$row["id_pilihan"]) echo "selected"?>><?php echo ucwords($row["pilihan"]);?></option>
										    <?php
												}
											?>
						</select>		
                                        </div>					
										<div class="form-group">
                                            <label for="gejala1">Gejala 4</label>
						<select class="form-control selectpicker" name="gejala4" id="gejala4" data-live-search="true">
						  <?php 
												$p = $mysqli->query("select * from gejala");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												while ($row = $p->fetch_assoc()) {
											?>
												<option data-tokens="<?php echo $row["gejala"];?>" value='<?php echo $row["id_gejala"];?>' <?php if($data[1][4]==$row["id_gejala"]) echo "selected"?>><?php echo $row["id_gejala"].'. '.ucwords($row["gejala"]);?></option>
										    <?php
												}
											?>
						</select>
						<select class="form-control selectpicker" name="pilihan4" id="pilihan4" data-live-search="true">
						  <?php 
												$p = $mysqli->query("select * from pilihan");
												if(!$p){
													echo $mysqli->connect_errno." - ".$mysqli->connect_error;
													exit();
												}
												while ($row = $p->fetch_assoc()) {
											?>
												<option data-tokens="<?php echo $row["pilihan"];?>" value='<?php echo $row["id_pilihan"];?>' <?php if($data[2][4]==$row["id_pilihan"]) echo "selected"?>><?php echo ucwords($row["pilihan"]);?></option>
										    <?php
												}
											?>
						</select>	
                                        </div>														
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Proses Konsultasi</button>
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
