<?php

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	


if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['modelo'])&& is_numeric($_GET['modelo'])) {
		$idmodelo=$_GET['modelo'];
		$con=new mysqli("localhost","root","","marcas");

		if ($con->connect_errno!=0) {
				echo "Erro".$connect_error."</h1>";
				exit();
		}
		$sql="Select * from modelos where id=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idmodelo);
				$stm->execute();
				$res=$stm->get_result();
				$modelo=$res->fetch_assoc();
				$stm->close();
		}
	
				  ?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title></title>
	  	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fa/css/all.css">
	<script type="text/javascript" src="fa/js/all.js"></script>
	 <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
	  </head>
	  <body>
	  <h1>Editar</h1>

<?php 
$stm=$con->prepare('select * from modelos');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {

}
 ?>

	  <form action="modelos_update.php?modelo=<?php  echo $modelo['id']; ?>" method="post">

	    <label>id marca</label><input type="text" name="id_marca" required value="<?php echo $modelo['id_marca'];?>"><br>
	<label>modelo</label><input type="text" name="modelo" value="<?php echo $modelo['modelo'];?>"><br>
	<label>ano</label><input type="text" name="ano" value="<?php echo $modelo['ano'];?>"><br>

	<br>
	
	<input type="submit" name="enviar">
</form>

	  </body>
	  </html>
	  <?php
	}	
else{
	echo ("Erro");
	header("refresh:5; url=index.php");
	}
		$stm->close();
}	



}
else{
	echo " <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}

?>