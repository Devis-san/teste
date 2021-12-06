<?php 
	session_start();
	if( empty($_SESSION['USER_GLOBAL_DATA']) == true ){
		Header('Location: /src/_html/_login/login.php');
        exit;
	}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=devicewidth, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible"
content="ie=edge">
<title>Horizon</title>
<!-- Import do CSS do Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>

<body style='
 background-image: url("https://img.wallpapersafari.com/desktop/1920/1080/97/63/Hv4kZr.jpg"); 
background-repeat: no-repeat;
background-position: center center;
background-size: cover;
background-attachment: fixed;  
'>
       <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-left" href="#"><img style="max-width:100px; margin-top: -7px; margin-bottom: -4px;" src="_img/logo.jpg"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                    
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                        </li>

                        <?php   
                        if( !empty($_SESSION['USER_GLOBAL_DATA']) ){
                            echo '<li class="nav-item btn-danger rounded">
                            <a class="nav-link text-white"  style="font-weight:bold!important;" href="/src/_html/_login/logout.php">Sair</a>
                            </li>';
                        }else{
                            echo '<li class="nav-item btn-info rounded">
                            <a class="nav-link text-white"  style="font-weight:bold!important;" href="/src/_html/_login/login.php">Login</a>
                            </li>';
                        }
                        ?> 
                    </ul>

                    <!-- REMOVER O SRC DEPOIS -->
                    <form class="d-flex" method="GET" action="/src/_html/busca/busca.php">
                        <input class="form-control me-2" name="buscar" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    
                    </div>
                </div>
            </nav>
        </header>


                
    <div class="container-fluid" >


            <!-- 3 ROWS ALINHADAS HORIZONTALMENTE PREENCHENDO A TELA-->
            <div class="row text-center">
                <hr>
                <div class="col-md-12">
                    <div class="card text-white bg-dark mb-3" style="max-width: 100%;">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h4 class="card-title">Bem-vindo <?php echo $_SESSION['USER_GLOBAL_DATA']['desnome'] ?>!</h4>
                            <p class="card-text">
                                <a class="btn btn-success" href="/src/_html/dashboard/index.php" style="font-weight: bold;"> Visitar Dashboard</a>
                                <a class="btn btn-success " style="font-weight: bold;">Fazer Publicação</a>
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
             </div>


             

             <!-- row alinhada horizontalmente no centro -->
                <div class="row text-center">
                 <br>
                    <div class="col-md-10">
                        <div class="card text-white bg-dark mb-3" style="max-width: 50%;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h4 class="card-title">Título da Postagem</h4>
                                <p class="card-text">
                                    <p>Esse é um layout simples para um site de exemplo</p>
                                    <p class="lead">
                                        <a class="btn btn-danger btn-lg" href="#" role="button">Curtir</a>
                                        <a class="btn btn-danger btn-lg" href="#" role="button">Comentários</a>
                                    </p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>



    </div>
    
</body>
<footer>

    
<!-- Import do jQuery + JS do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</footer>
</html>
