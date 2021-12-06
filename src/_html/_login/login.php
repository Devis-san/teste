
<?php 
	session_start();

	if( empty($_SESSION['USER_GLOBAL_DATA']) == false ){
		Header('Location: /src/index.php');
		exit;
	}


	/**
	 * Este if vai verificar se está recebenedo informações via POST. Se sim. então deverá tentar se conectar.
	 * @param array
	 * @return bool
	*/
	if(isset($_POST['login'])){
	   // Recebe os campos do formulário
	   include $_SERVER['DOCUMENT_ROOT']."/src/_sql/sql.php";

	   //SEMPRE CHAMAR O SQL
	   $sql = new Sql();
	   //CHAMA A QUERY QUE A GENTE QUER
	   $query = "SELECT * FROM tb_usuarios WHERE desnome = :desnome";
	   //PASSA OS PAREMTRO
		$parametros = array(
			":desnome"=> $_POST["username"]
		);
	   //verifica se o usuário com o email informado existe
	   //ME MOSTRA TUDO DO USUÁRIO
	   $results = $sql->select($query, $parametros );

	   //verifica se a váriavel $results está vazia ou é nula
	   //isset = "existe?"
	   if( isset($results[0]) == false){
	      echo "Usuário inexistente";
		  exit;
	   }
	   else if(isset($results[0]) == true)
	   {
		   //SE ESTÁ AQUI O $RESULTS TEM UM VALOR, E NÃO É VAZIO!
		   //POST É O QUE VEM DO FORMULÁRIO.

			if( password_verify($_POST['password'], $results[0]['dessenha']) == false ){ 
				echo "Senha inválida!";
				exit;
			}
			else{ 
					include $_SERVER['DOCUMENT_ROOT']."/src/_php/usuario.php";
					$user = new usuario();
					$user->set($results[0]);
					Header("Location: /src/index.php");
					exit;
            }
	    }
	}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<!DOCTYPE html>
<html>
<head>
	<title>Horizon - Logar-se</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>
<body>

	


<div class="container">
	<hr>
	<div class="justify-content-center ">
		<div class="card">
			<div class="card-header">
				<h3>Logar</h3>
			</div>
			<div class="card-body">
				<form action="/src/_html/_login/login.php" method="POST">
				
			    	<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="username" required placeholder="nome de usuario">
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="password" required placeholder="senha">
					</div>					
                    
                    <!-- <div class="row align-items-center remember">
						<input type="checkbox">Lembrar
					</div> -->
					
					<!-- centraliza essa div -->
					<div class="form-group text-center">
						<input type="submit" value="Logar" name="login" class="btn login_btn">
					</div>
			
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Nao tem uma conta? <a href="/src/_html/_login/cadastro.php"> &nbsp; Cadastrar-se</a>
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