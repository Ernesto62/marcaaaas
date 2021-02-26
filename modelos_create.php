<?php 

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	



if ($_SERVER['REQUEST_METHOD']=="POST") {
	$id_marca="";
	$modelo="";
	$ano="";

	if (isset($_POST['id_marca'])) {
		$id_marca=$_POST['id_marca'];
		

	}
	if (isset($_POST['modelo'])) {
		$modelo=$_POST['modelo'];
		

	}
	if (isset($_POST['ano'])) {
	
		$ano=$_POST['ano'];

	}
	else{
		
	}
	
	$con=new mysqli("localhost","root","","marcas");
	if ($con->connect_errno!=0) {
		echo "ERRO.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into modelos (id_marca,modelo,ano) values (?,?,?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('iss',$id,$id_marca,$modelo,$ano);
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
	
</head>
<body>
<h1>Adicionar Modelos</h1>
<form action="modelos_update.php" method="post">
	<label>id_marca </label><input type="text" name="id_marca" required><br>
	<label>modelo </label><input type="text" name="modelo" required><br>
	<label>ano </label><input type="text" name="ano" required><br><br>
	
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