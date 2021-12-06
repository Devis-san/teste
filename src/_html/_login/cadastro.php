 <?php
	session_start();
  
    //isset = existe?
 	if( isset($_POST['cadastro']) ){
		
		
		include $_SERVER['DOCUMENT_ROOT']."/src/_sql/sql.php";
		include $_SERVER['DOCUMENT_ROOT']."/src/_php/functions.utils.php";
		
		if($_POST['password'] != $_POST['confpass']){
			echo 'senhas não coincidem';
			exit;
		}

		$sql = new Sql();
		$query = "INSERT INTO tb_usuarios (desnome, desemail, dessenha, created) VALUES (:desnome, :desemail, :dessenha, NOW());";

		$parametros = array(
			':desnome' => $_POST['username'],
			':desemail' => $_POST['email'],
			':dessenha' => setPasswordHashing($_POST['password']),
		);

		$sql->QuerySQL($query, $parametros);

		// =================================
		//LOGA O USUÁRIO
		// =================================
	
		$query_ = "SELECT * FROM tb_usuarios WHERE desnome = :desnome";
		$parametros_ = array(
			":desnome"=> $_POST["username"]
		);
		$results_ = $sql->select($query_, $parametros_ );

		if( password_verify($_POST['password'], $results_[0]['dessenha']) == false ){ 
				echo "Senha inválida!";
				exit;
		}
		else{ 
			    include $_SERVER['DOCUMENT_ROOT']."/src/_php/usuario.php";
				$user = new usuario();
				$user->set($results_[0]);
				Header("Location: /src/index.php");
				exit;
		}
	

		// header('Location: /src/_html/_login/login.php');
		// exit;
	 }

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Horizon - Cadastre-se</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" >
</head>
<body>




<div class="container">
	<hr>
	<div class="justify-content-center">
		<div class="card">
			<div class="card-header">
				<h3>Cadastrar-se</h3>
			</div>
			<div class="card-body">
				<form action="cadastro.php" method="POST">

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="username" required placeholder="nome de usuario">
					</div>

                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="text" class="form-control" name="email" required placeholder="Insira seu email">	
					</div>


					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-lock"></i></span>
						</div>
						<input type="password" class="form-control" name="password" required placeholder="Insira sua senha">
					</div>

                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-lock"></i></span>
						</div>
						<input type="password" class="form-control" name="confpass" required  placeholder="Confirme sua senha">
					</div>



					<div class="form-group text-center">
						<button type="submit" name="cadastro" class="btn login_btn">Cadastrar</button>
					</div>

				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Ja possui uma conta?<a href="login.php">&nbsp; Logar-se</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Esqueceu sua senha?</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<footer>
	
</footer>
</html>