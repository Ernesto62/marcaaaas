<?php 

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	



if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	$marca="";
	

	if (isset($_POST['marca'])) {
		$marca=$_POST['marca'];
	}
	else{
		
	}
	
	$con=new mysqli("localhost","root","","marcas");
	if ($con->connect_errno!=0) {
		echo "ERRO.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into marcas (marca) values (?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('s',$marca);
			$stm->execute();
			$stm->close();

			echo "<script>alert('Adicionado com sucesso')</script>";

			

			header("refresh:5; url=index.php");
		}
		else{
			echo ($con->error);
			
			header("refresh:5; url=index.php");
		} 
	} 
} 
else{
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
<h1>Adicionar Marcas</h1>
<form action="marcas_create.php" method="post">
	<label>marca</label><input type="text" name="marca" required><br><br>
	
	<input type="submit" name="enviar">
</form>
</body>
</html>
<?php  
}

}
else{
	echo " <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}


?>