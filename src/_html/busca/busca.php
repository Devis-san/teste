<?php

    include __DIR__."/../../_sql/sql.php";
    
    $sql = new Sql();

    $query = "SELECT * FROM tb_usuarios 
    WHERE desnome LIKE CONCAT('%', :desnome, '%') 
    ORDER BY 
    CASE
       WHEN desnome LIKE :desnome THEN 1
       ELSE 2
       END
       DESC";

       //PASSA OS PAREMETROS (SE EXISTEREM)
    $parametros = array(
    ":desnome" =>  isset($_GET['buscar']) ? $_GET['buscar'] : ''
    );       
    
    $results = $sql->select($query, $parametros);

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


<!-- IMAGEM ANTIGA -->
<!-- https://img.wallpapersafari.com/desktop/1920/1080/97/63/Hv4kZr.jpg -->
<!-- ================ -->


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
                    <a class="navbar-left" href="#"><img style="max-width:100px; margin-top: -7px; margin-bottom: -4px;" src="/src/_img/logo.jpg"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                    
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../index.php">Início</a>
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


                       
                 
<br>

        <?php

        
        if( empty($results) ){
            echo '<div class="alert alert-danger" role="alert">
            Nenhum resultado encontrado!
            </div>';
        }else{
            foreach($results as $result){
                echo '<div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://img.wallpapersafari.com/desktop/1920/1080/97/63/Hv4kZr.jpg" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">'.$result['desnome'].'</h5>
                <p class="card-text">'.$result['desemail'].'</p>
                <a href="#" class="btn btn-primary">Ver Perfil</a>
                </div>
                </div>';
            }
        }
        
                

                  

        ?>

    </div>
    
</body>
<footer>

    
<!-- Import do jQuery + JS do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</footer>
</html>



