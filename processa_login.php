<?php
session_start();
if ($_SERVER['REQUEST_METHOD']=="POST") {
	if (isset($_POST['utilizador'])&& isset($_POST['passowrd'])) {
		$utilizador=$_POST['utilizador'];
		$passowrd=$_POST['passowrd'];

		$con=new mysqli ("localhost","root","","marcas");
		if ($con->connect_errno!=0) {
			echo "Erro<br>".$con->connect_error;
			exit;
		}
		else{
			$sql="select * from utilizadores where utilizador=? and passowrd=?";
			$stm=$con->prepare($sql);
			if ($stm!=false) {
				$stm->bind_param("ss",$utilizador,$passowrd);
				$stm->execute();
				$res=$stm->get_result();
				if ($res->num_rows==1) {
			
					$_SESSION['login']="correto";
				}
				else{
					
					$_SESSION['login']="incorreto";
				}
				header("refresh:5;url=index.php");
			}
			else{
				echo $con->connect_error;
				exit;
			}
		}
	}
}

?>