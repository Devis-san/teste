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


<style>
.main{
    max-width: 900px;
    margin: 0 auto;
}

body{
background-image: url("https://img.wallpapersafari.com/desktop/1920/1080/97/63/Hv4kZr.jpg"); 
background-repeat: no-repeat;
background-position: center center;
background-size: cover;
background-attachment: fixed;  
}

div.newPost{
    width: 90%;
    height: 250px;
    display:flex;
    flex-direction: column;
    align-items: flex-start;
    margin: 25px auto;
    padding: 25px;
    background:#e5e5e5;
    border-radius:10px;
    box-shadow: 1px 0 3px rgba(0,0,0,0.2);
}
div.newPost div.infoUser{
    display:flex;
    align-items:center;
    justify-content: center;
}
div.newPost div.infoUser div.imgUser{
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: #333;
}
div.newPost div.infoUser strong{
    font-size: 16px;
    margin-left: 10px;
    color: #b247d1;
}
div.newPost form.formPost{
    display: flex;
    flex-direction: column;
    width: 100%;
} 
div.newPost form.formPost textarea{
    margin:15px 0;
    padding:20px;
    border-width: 1px;
    border-radius:10px;
    resize:none;
    outline:none;
    border-color: #b247d1;
    font-family:'Roboto', sans-serif;
    font-weight:bold;
    background:#cccccc;
    

}
div.newPost form.formPost div.iconsAndbutton{
    display:flex;
    align-items:center;
    justify-content:space-between;

}
div.newPost form.formPost div.iconsAndbutton button.btnSubmitForm{
    background:#462159;
    padding:5px 50px;
    color:#fff;
    font-weight:bold;
    outline:none;
    cursor:pointer;
    border:0;
    border-radius:10px;
    transition: background 0.2s;
}
div.newPost form.formPost div.iconsAndbutton button.btnSubmitForm:hover{
    background: #4a3063;
}
div.posts div.post{
    width: 90%;
    margin: 0 auto;
    margin-bottom:10px;
    background:#fff;
    border-radius:20px;
    padding: 20px;
    box-shadow: 1px 0 3px rgb(0,0,0,0.05);

}
div.posts div.post div.infoUserPost{
    display:flex;
    align-items:center;
}
div.posts div.post div.infoUserPost div.imgUserPost{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#333;
}


</style>

<body style='
background-color: rgb(255, 250, 255); 
background-repeat: no-repeat;
background-position: center center;
background-size: cover;
background-attachment: fixed;  
' >
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
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/src/_html/dashboard/index.php">dashboard</a>
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
                    
                <form class="d-flex" method="GET" action="/src/_html/busca/busca.php">
                    <input class="form-control me-2" name="buscar" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-info" type="submit">Search</button>
                </form>
                    
                </div>
            </div>
        </nav>
    </header>


                
    


            <!-- 3 ROWS ALINHADAS HORIZONTALMENTE PREENCHENDO A TELA
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

            </div>-->

           <!-- <div class="row text-center" > 
                 <br>
                    <div style='align-items: center;' class="col-md-10">
                        <div class="card text-white bg-dark mb-3" style="max-width: 100%;">
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
            </div>-->
             
           
             
            
            <main class="main">
                <div class="container-fluid" >   
                    <div class="newPost">
                        <div class="infoUser">
                            <div class="imgUser"> </div>
                            <strong> Eu</strong>
                        </div>
                        <form action="_php/postagem/publicar.php" method="post" class="formPost">
                            <div class="form-outline w-100 mb-4"> 
                                <textarea name="mensagem" class="form-control" rows="3" placeholder="O que há de novo?"></textarea>
                                <div class="iconsAndbutton">
                                    <div class="icons">
                                    <button type="submit" class="btnSubmitForm">enviar</button>
                                    </div>
                                </div>    
                            </div>
                        </form>                
                    </div>

                
                      
                        <?php
                        include  __DIR__.'/_sql/sql.php';
                        $sql = new Sql();
                        $query = "SELECT * FROM tb_postagens ORDER BY idpost DESC";
                        $results = $sql->select($query);
                        //if para deletar a postagem
                        


                        
                        
                        foreach($results as $item){
                        
                            $getUser = "SELECT * FROM tb_usuarios WHERE id = :idusuario";
                            $usuario = $sql->select($getUser,[
                                ':idusuario'=>$item['idusuario']
                            ])[0];

                            if(isset($_POST['deletar']) && $_POST['deletar'] == $item['idpost']){
                                $deletePost = "DELETE FROM tb_postagens WHERE idpost = :idpost";
                                $sql->query($deletePost,[
                                    ':idpost'=>$item['idpost']
                                ]);

                               
                            }
                            
                            
                            $nome = $usuario['desnome'];
                            $data = date('d/m/Y H:i', strtotime($item['data']));
                            $mensagem = $item['mensagem'];

                            
                          
                            
                            echo  "
                            
                            <div class='posts'>
                                <div class='post'>    
                                    <div class='infoUserPost'>
                                        <div class='imgUserPost'></div>
                                            <div class='nameAndHour'>
                                                <strong class='text-dark'>$nome</strong>
                                                <p class='text-dark'>$data</p>
                                            </div>
                                        </div>
                                        <p class='text-dark'>$mensagem</p>
                                        <div class='actionBtnPost'>
                                            <button type='button' class='filesPost'><img src='https://cdn.discordapp.com/attachments/733818296755028052/915004948981383198/coracao.png' alt='Curtir'></button>
                                            <button type='button' class='filesPost'><img src='https://cdn.discordapp.com/attachments/733818296755028052/915004948595499048/comment.png' alt='Comentar'></button>
                                            <button type='button' class='filesPost'><img src='https://cdn.discordapp.com/attachments/733818296755028052/915004948775841872/share.png' alt='Compartilhar'></button>
                                            <input type='submit' class='btn btn-danger' name='deletar' value='Deletar'>
                                        </div>    
                                    </div>  
                                </div>  
                            </div>  
                            ";
                        }
                    
                        ?>
                    

                </div>


            </main> 
    

</body>
<footer>

    
<!-- Import do jQuery + JS do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</footer>
</html>


<!-- style='
background-image: url("https://img.wallpapersafari.com/desktop/1920/1080/97/63/Hv4kZr.jpg"); 
background-repeat: no-repeat;
background-position: center center;
background-size: cover;
background-attachment: fixed;  
' 





Nesta etapa deverão ser entregues:

- Criar Postagem check
- Editar Postagem (restrito ao autor)
- Excluir Postagem (restrito ao autor e ao administrador)
- Exibir timeline do Usuário (todas as postagens do usuário, apresentado após escolher um usuário na busca por palavra-chave) -->