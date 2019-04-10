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

    <!-- Custom styles for this template -->
    <link href="ui/css/jumbotron.css" rel="stylesheet">

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
      </nav>
	  <br><br><br>
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="konsultasi.php">Konsultasi</a></li>
		  <li class="active">Hasil Analisa</li>
		</ol>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Hasil Analisa</div>
		  <div class="panel-body">
			<div class="text-right"><button class="btn btn-primary btn-sm" onclick="myFunction()">Print</button></div>
			<center>
				<?php
					
					$koma = 4;
					
					$data = $mysqli->query("select i.id_input, u.user, g.gejala, g.bobot as cf_pakar, p.pilihan, p.bobot_pilihan as cf_user
								from input i, user u, gejala g, pilihan p
								where i.id_user = ".$_SESSION['id']."
								and i.id_user = u.id
								and i.id_gejala = g.id_gejala
								and i.id_pilihan = p.id_pilihan
								order by i.id_input");	
					if(!$data){
						echo $mysqli->connect_errno." - ".$mysqli->connect_error;
						exit();
					}
					$i=1;
					while ($row = $data->fetch_assoc()) {
						@$gejala[$i] = $row["gejala"];
						@$cfp[$i] = $row["cf_pakar"];						
						@$pilihan[$i] = $row["pilihan"];	
						@$cfu[$i] = $row["cf_user"];
						$i++;
					}
					echo "<b>Hasil Perhitungan Dengan Metode CF - Certainty Factor</b><br><br>";
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<thead><tr><th>Gejala</th>";
						for($i=1;$i<=4;$i++){
							echo "<th><center>Gejala ".$i."</center></th>";
						}
					echo "</tr></thead>";
					echo "<tr><td><b>CF Pakar</b></td>";
						for($i=1;$i<=4;$i++){
							echo "<td><center>".@$cfp[$i]."</center></td>";
						}
					echo "</tr>";
					echo "<tr><td><b>Pilihan User</b></td>";
						for($i=1;$i<=4;$i++){
							echo "<td><center>".@$pilihan[$i]."</center></td>";
						}
					echo "</tr>";
					echo "<tr><td><b>CF User</b></td>";
						for($i=1;$i<=4;$i++){
							echo "<td><center>".@$cfu[$i]."</center></td>";
						}
					echo "</tr>";
					for($i=1;$i<=4;$i++){
						@$cfg[$i] = $cfp[$i]*$cfu[$i];
					}
					echo "<tr><td><b>CF Gejala</b></td>";
						for($i=1;$i<=4;$i++){
							echo "<td><center>".@$cfg[$i]."</center></td>";
						}
					echo "</tr>";					
					for($i=1;$i<=4;$i++){
						if($i==1)   
							@$cfc[$i] = $cfg[$i]+$cfg[$i+1]*(1-$cfg[$i]);
						else   
							@$cfc[$i] = $cfo+$cfg[$i]*(1-$cfo); 
						@$cfo = $cfc[$i];
					}
					echo "<tr><td><b>CF Combine</b></td>";
						for($i=1;$i<=4;$i++){
							echo "<td><center>".@$cfc[$i]."</center></td>";
						}
					echo "</tr>";
					echo "<tr><td><b>CF Penyakit</b></td>";
					echo "<td colspan='4'><center>".round(@$cfc[4],$koma)." &nbsp &nbsp <small>*Dibulatkan 4 angka di belakang koma</small></center></td>";
					echo "</tr>";
					echo "<tr><td><b>Hasil Analisa</b></td>";
					echo "<td colspan='4'><center>";
					
					if($cfc[4]==1)	echo "Pasti";
					elseif(($cfc[4]>=0.8)&&($cfc[4]<=0.99)) echo "Hampir Pasti";
					elseif(($cfc[4]>=0.6)&&($cfc[4]<=0.79)) echo "Kemungkinan Besar";	
					elseif(($cfc[4]>=0.4)&&($cfc[4]<=0.59)) echo "Mungkin";	
					elseif(($cfc[4]>=0.2)&&($cfc[4]<=0.39)) echo "Kemungkinan Kecil";	
					elseif(($cfc[4]>=0)&&($cfc[4]<=0.19)) echo "Tidak Tahu / Tidak Yakin";	
								
					echo "</center></td>";
					echo "</tr>";
					echo "</table>";
					$data = $mysqli->query("select p.id_penyakit, p.penyakit
								from penyakit p, gejala g
								where p.id_penyakit = g.id_penyakit
								and g.id_gejala = 	(select g.id_gejala
										   	from input i, user u, gejala g, pilihan p
											where i.id_user = ".$_SESSION['id']."
											and i.id_user = u.id
											and i.id_gejala = g.id_gejala
											and i.id_pilihan = p.id_pilihan
											and p.bobot_pilihan = ( select max(p.bobot_pilihan) 
													       from input i, user u, pilihan p
													       where i.id_user = ".$_SESSION['id']."
													       and i.id_user = u.id
													       and i.id_pilihan = p.id_pilihan )
											limit 1)");	
					if(!$data){
						echo $mysqli->connect_errno." - ".$mysqli->connect_error;
						exit();
					}
					while ($row = $data->fetch_assoc()) {
						@$id_penyakit = $row["id_penyakit"]; 						
						@$penyakit = $row["penyakit"];
					}
					echo "Penyakit : <br>";
					if($cfc[4]==1)	echo "Pasti";
					elseif(($cfc[4]>=0.8)&&($cfc[4]<=0.99)) echo "Hampir Pasti";
					elseif(($cfc[4]>=0.6)&&($cfc[4]<=0.79)) echo "Kemungkinan Besar";	
					elseif(($cfc[4]>=0.4)&&($cfc[4]<=0.59)) echo "Mungkin";	
					elseif(($cfc[4]>=0.2)&&($cfc[4]<=0.39)) echo "Kemungkinan Kecil";	
					elseif(($cfc[4]>=0)&&($cfc[4]<=0.19)) echo "Tidak Tahu / Tidak Yakin";	
					echo " ".(round(@$cfc[4],$koma)*100)."% ".$penyakit."<br><br>";
					echo "Penyebab : <br>";
					echo "</center>";					
					$data = $mysqli->query("select pn.penyebab from penyebab pn, penyakit p where pn.id_penyakit = p.id_penyakit and p.id_penyakit = ".$id_penyakit."");	
					if(!$data){
						echo $mysqli->connect_errno." - ".$mysqli->connect_error;
						exit();
					}
					while ($row = $data->fetch_assoc()) {
						echo $row["penyebab"]."<br>";
					}
					echo "<center><br>Solusi : <br></center>";					
					$data = $mysqli->query("select s.solusi from solusi s, penyakit p where s.id_penyakit = p.id_penyakit and p.id_penyakit = ".$id_penyakit."");	
					if(!$data){
						echo $mysqli->connect_errno." - ".$mysqli->connect_error;
						exit();
					}
					while ($row = $data->fetch_assoc()) {
						echo $row["solusi"]."<br>";
					}

				?>
			<center>
			</center>
		  </div>
		  <div class="panel-footer"><b class="text-primary">By <?php echo $_SESSION['by'];?></b><b class="pull-right text-primary">&copy <?php echo date('Y');?></b></div>
		</div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="ui/js/jquery-1.10.2.min.js"></script>
	<script src="ui/js/bootstrap.min.js"></script>
	<script src="ui/js/bootswatch.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ui/js/ie10-viewport-bug-workaround.js"></script>
	
	<script>
	function myFunction() {
		window.print();
	}
	</script>
</body></html>
