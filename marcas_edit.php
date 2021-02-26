<?php

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	










if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['marca'])&& is_numeric($_GET['marca'])) {
		$idmarca=$_GET['marca'];
		$con=new mysqli("localhost","root","","marcas");

		if ($con->connect_errno!=0) {
				echo "Erro".$connect_error."</h1>";
				exit();
		}
		$sql="Select * from marcas where id=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idmarca);
				$stm->execute();
				$res=$stm->get_result();
				$marca=$res->fetch_assoc();
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
	  <h1>Editar Marcas</h1>

<?php 
$stm=$con->prepare('select * from marcas');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {

}
 ?>

	  <form action="marcas_update.php?marca=<?php  echo $marca['id']; ?>" method="post">

	<label>marca</label><input type="text" name="marca" value="<?php echo $marca['marca'];?>"><br><br>
	
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