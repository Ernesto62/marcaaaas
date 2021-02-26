<?php

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	






if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['marca'])&& is_numeric($_GET['marca'])) {
		$idMarca=$_GET['marca'];
		$con=new mysqli("localhost","root","","marcas");

		if ($con->connect_errno!=0) {
				echo "Erro".$connect_error;
				exit();
		}
		$sql="delete from marcas where id=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idMarca);
				$stm->execute();
				$stm->close();
				echo "<script>alert('Eliminado');</script>";
				
					header("refresh:2; url=index.php");
		}
	else{

echo ($con->error);
echo "<br>";

echo "<br>";
	header("refresh:2; url=index.php");
		}
	

}	
else{
	echo "Erro";
	header("refresh:2; url=index.php");
	}
}	
else{
	echo "Erro";
	header("refresh:2; url=index.php");
	}






}
else{
	echo " <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
?>
