<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="/src/_html/dashboard/css/style.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">


<?php 

session_start();


    if( empty($_SESSION['USER_GLOBAL_DATA']) == true ){
        Header('Location: /src/_html/_login/login.php');
        exit;
    }

    function isAdmin() {
		if ( $_SESSION['USER_GLOBAL_DATA']['user_level'] != 0 ) {
            //É administrador
			return true;
		} else {
            //Retorna Falso
			return false;
		}
	}
    //Se não for administrador, vai pro index.
    if(!isAdmin()) {
        header('location: index.php');
    }


    include __DIR__."/../../_sql/sql.php";
    $sql = new Sql();

    if(isset($_POST['editar'])){

        $query_atualizar_usuario = "UPDATE tb_usuarios SET desnome = :desnome, desemail = :desemail, user_level = :optnivelacesso WHERE id = :id";
        $sql->QuerySql($query_atualizar_usuario,[
            ':desnome' => $_POST['desnome'],
            ':desemail' => $_POST['desemail'],
            ':optnivelacesso' => $_POST['optnivelacesso'],
            ':id' => $_POST['id']
        ]);
        
        header('Location: /src/_html/dashboard/lista.php');
        exit;
     
    }

    if(isset($_POST['excluir'])){
        $query_excluir_usuario = "DELETE FROM tb_usuarios WHERE id = :id";
        $sql->QuerySql($query_excluir_usuario,[
            ':id' => $_POST['id']
        ]);

        header('Location: /src/_html/dashboard/lista.php');
        exit;
    }


    if(!isset($_GET['id'])){
        Header('Location: /src/_html/dashboard/index.php');
        exit;
    }

    $query_achar_usuario = "SELECT * FROM tb_usuarios WHERE id = :ID";
    $informacoes_usuario_atual = $sql->select($query_achar_usuario, array(
        ":ID"=> $_GET['id']
    ))[0];
  
 
?>

<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
               
                <div class="navi">
                <img src="/src/_img/logo.jpg" style="width: 175px!important; height: 70px!important;" &nbsp; alt="mercado" class="hidden-xs hidden-sm">
                    <ul>
                        <li><a href="/src/_html/dashboard/index.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Início</span></a></li>
                        <?php if (isAdmin()) : ?>
                            <li><a href="/src/_html/dashboard/lista.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Lista de Usuários</span></a></li>
                        <?php endif; ?>
                        <li><a href="/src/_html/dashboard/editar.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Alterar Senha</span></a></li>
                        <li><a href="/src/_html/_login/logout.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Desconectar</span></a></li>
                        <li><a href="/src/index.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Voltar</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="user-dashboard">
                    <h1>Olá, <?php  echo $_SESSION['USER_GLOBAL_DATA']['desnome'] ?></h1>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 gutter ">
                            <!-- row com form para editar as informações do usuário -->
                            <form action="/src/_html/dashboard/edit_usuario.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" name="desnome" value="<?php echo $informacoes_usuario_atual['desnome']?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="desemail" value="<?php echo $informacoes_usuario_atual['desemail']?>">
                                </div>
                                <div class="form-group pb-3">
                                    <label for="email">Nível de Acesso</label>
                                    <select class="form-control"  name="optnivelacesso">
                                            <option value="1" <?php if($informacoes_usuario_atual['user_level'] == 1){ echo 'selected'; }?>>Administrador</option>
                                            <option value="0" <?php if($informacoes_usuario_atual['user_level'] == 0){ echo 'selected'; }?>>Usuário</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" name="editar" value="Editar">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger" name="excluir" value="Excluir Usuário">
                                </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});

</script>