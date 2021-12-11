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
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    
    </head>
    
    <style>

    @import url(http://fonts.googleapis.com/css?family=Lato:400,700);
    body
    {
        font-family: 'Lato', 'sans-serif';
        }
    .profile 
    {
        min-height: 355px;
        display: inline-block;
        }
    figcaption.ratings
    {
        margin-top:20px;
        }
    figcaption.ratings a
    {
        color:#f1c40f;
        font-size:11px;
        }
    figcaption.ratings a:hover
    {
        color:#f39c12;
        text-decoration:none;
        }
    .divider 
    {
        border-top:1px solid rgba(0,0,0,0.1);
        }
    .emphasis 
    {
        border-top: 4px solid transparent;
        }
    .emphasis:hover 
    {
        border-top: 4px solid #1abc9c;
        }
    .emphasis h2
    {
        margin-bottom:0;
        }
    span.tags 
    {
        background: #1abc9c;
        border-radius: 2px;
        color: #f5f5f5;
        font-weight: bold;
        padding: 2px 4px;
        }
    .dropdown-menu 
    {
        background-color: #34495e;    
        box-shadow: none;
        -webkit-box-shadow: none;
        width: 250px;
        margin-left: -125px;
        left: 50%;
        }
    .dropdown-menu .divider 
    {
        background:none;    
        }
    .dropdown-menu>li>a
    {
        color:#f5f5f5;
        }
    .dropup .dropdown-menu 
    {
        margin-bottom:10px;
        }
    .dropup .dropdown-menu:before 
    {
        content: "";
        border-top: 10px solid #34495e;
        border-right: 10px solid transparent;
        border-left: 10px solid transparent;
        position: absolute;
        bottom: -10px;
        left: 50%;
        margin-left: -10px;
        z-index: 10;
    }
    </style>

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
                    <a class="navbar-left"><img style="max-width:100px; margin-top: -7px; margin-bottom: -4px;" src="/src/_img/logo.jpg"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../../index.php">Início</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/src/_html/dashboard/index.php">Dashboard</a>
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
                          
                    </div>
                </div>
            </nav>
        </header>                    
            <br>
        <div class="container-fluid" >
            
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
                        <div class="well profile">
                            <div class="col-sm-12">
                                <div class="col-xs-12 col-sm-8">
                                    <h2>nome</h2>
                                    <p><strong>About: </strong> Web Designer / UI. </p>
                                    <p><strong>Hobbies: </strong> Read, out with friends, listen to music, draw and learn new things. </p>
                                    <p><strong>Skills: </strong>
                                        <span class="tags">html5</span> 
                                        <span class="tags">css3</span>
                                        <span class="tags">jquery</span>
                                        <span class="tags">bootstrap3</span>
                                    </p>
                                </div>             
                                
                            </div>            
                            <div class="col-xs-12 divider text-center">
                                <div class="col-xs-12 col-sm-4 emphasis">
                                    <h2><strong> 20,7K </strong></h2>                    
                                    <p><small>Followers</small></p>
                                    <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Follow </button>
                                </div>
                                <div class="col-xs-12 col-sm-4 emphasis">
                                    <h2><strong>245</strong></h2>                    
                                    <p><small>Following</small></p>
                                    <button class="btn btn-info btn-block"><span class="fa fa-user"></span> View Profile </button>
                                </div>
                                <div class="col-xs-12 col-sm-4 emphasis">
                                    <h2><strong>43</strong></h2>                    
                                    <p><small>Snippets</small></p>
                                    <div class="btn-group dropup btn-block">
                                    <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Options </button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu text-left" role="menu">
                                        <li><a href="#"><span class="fa fa-envelope pull-right"></span> Send an email </a></li>
                                        <li><a href="#"><span class="fa fa-list pull-right"></span> Add or remove from a list  </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><span class="fa fa-warning pull-right"></span>Report this user for spam</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" class="btn disabled" role="button"> Unfollow </a></li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
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



