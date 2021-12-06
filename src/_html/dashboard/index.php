<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="/src/_html/dashboard/css/style.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">


<?php 

session_start();

    function isAdmin() {
        if ( $_SESSION['USER_GLOBAL_DATA']['user_level'] != 0 ) {
            //É administrador
            return true;
        } else {
            //Retorna Falso
            return false;
        }
    }

    if( empty($_SESSION['USER_GLOBAL_DATA']) == true ){
        Header('Location: /src/_html/_login/login.php');
        exit;
    }

    if(isset($_POST['editando'])){

        include $_SERVER['DOCUMENT_ROOT']."/src/_sql/sql.php";
        $sql = new Sql();
        $update = "UPDATE tb_usuarios SET desnome = :desnome, desemail = :desemail WHERE id = :id";

        //ATUALIZA NO BANCO DE DADOS
        $sql->QuerySQL($update, array(
            ':desnome'=>$_POST['nome'],
            ':desemail'=>$_POST['email'],
            ':id' => $_SESSION['USER_GLOBAL_DATA']['id']
        ));

        //ATUALIZA NA SESSÃO
        $_SESSION['USER_GLOBAL_DATA']['desnome'] = $_POST['nome'];
        $_SESSION['USER_GLOBAL_DATA']['desemail'] = $_POST['email'];
    }


?>

<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
               
                <div class="navi">
                <img src="/src/_img/logo.jpg" style="width: 175px!important; height: 70px!important;" &nbsp; alt="mercado" class="hidden-xs hidden-sm">
                    <ul>
                        <li class="active"><a href="/src/_html/dashboard/index.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Início</span></a></li>
                        <?php if (isAdmin()) : ?>
                            <li><a href="/src/_html/dashboard/lista.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Lista de Usuários</span></a></li>
                        <?php endif; ?>
                        <li ><a href="/src/_html/dashboard/editar.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Alterar Senha</span></a></li>
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
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Editar Informações</h4>
                                        </div>
                                        <div class="panel-body">
                                            <form action="/src/_html/dashboard/index.php" method="post">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nome</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Nome" <?php echo "value='".$_SESSION['USER_GLOBAL_DATA']['desnome']."'" ?>  name="nome" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Email" <?php echo "value='".$_SESSION['USER_GLOBAL_DATA']['desemail']."'" ?>  name="email">
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="editando">Editar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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