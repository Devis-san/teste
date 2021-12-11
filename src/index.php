<?php

	session_start();
    
    include  __DIR__.'/_sql/sql.php';
    $sql = new Sql();
    $query = "SELECT * FROM tb_postagens ORDER BY idpost DESC";
    $results = $sql->select($query);

    if( empty($_SESSION['USER_GLOBAL_DATA'])){
        header('Location: /src/_html/_login/login.php');
        exit;
	}
                            
    //if para deletar as postagens
    if( isset($_POST['delete']) ){
        $id = $_POST['idpost'];
        $query = "DELETE FROM tb_postagens WHERE idpost = $id";
        $results = $sql->select($query);
        header('Location: index.php');
        exit;  
    }
    //if para editar as postagens
    if( isset($_POST['editpost']) ){
        $id = $_POST['editpost'];
        $mensagem = $_POST['editmensagem'];
        $query = "UPDATE tb_postagens SET mensagem = '$mensagem' WHERE idpost = $id";
        $results = $sql->select($query);
        header('Location: index.php');
        exit;
    }
    //if para adicionar comentarios
    if( isset($_POST['coment']) ){
        $idpost = $_POST['idpost'];
        $idusuario = $_SESSION['USER_GLOBAL_DATA']['id'];
        $mensagem = $_POST['mensagem'];
        $data = date('Y-m-d H:i:s');
        $insertComentario = "INSERT INTO tb_comentarios (idpost, idusuario, mensagem, data) VALUES (:idpost, :idusuario, :mensagem, :data)";
        $sql->QuerySQL($insertComentario,[
            ':idpost'=>$idpost,
            ':idusuario'=>$idusuario,
            ':mensagem'=>$mensagem,
            ':data'=>$data
        ]);
        
        header('Location: /src/index.php');
        exit;
    }

    //if para editar as postagens
    if( isset($_POST['curtir']) ){
        $id = $_POST['curtir'];

        $select_ = "SELECT incurtidas FROM tb_postagens WHERE idpost = :idpost ";
        $get =  $sql->select($select_,[
            ':idpost'=> $id
        ])[0];


        $old = $get['incurtidas'] + 1;

        $query = "UPDATE tb_postagens SET incurtidas = :old WHERE idpost = :id";
        $results = $sql->QuerySQL($query,[
            ':old'=> $old,
            ':id'=> $id
        ]);
        header('Location: index.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        background:#4a3063;
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
        background:#2a272b;
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
    
    div.comments{
        width: 70%;
        height: 140px;
        margin: 0 auto;
        margin-left:45px;
        margin-bottom:10px;
        background:#fff;
        border-radius:20px;
        padding: 20px;
        float:left;
        
        box-shadow: 1px 0 3px rgb(0,0,0,0.05);
        
    }
    div.comment div.infoUserComm{
        display:flex;
        align-items:center;
    }
    
    .right{
        float: right;
    }
    .left{
        float: left;
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
                            <a class="nav-link active" aria-current="page" href="/src/_html/dashboard/index.php">Dashboard</a>
                            </li>

                            <?php   
                                if( !empty($_SESSION['USER_GLOBAL_DATA']) ){
                                    echo '<li class="nav-item btn-secondary rounded">
                                    <a class="nav-link text-white"  style="font-weight:bold!important;" href="/src/_html/_login/logout.php">Sair</a>
                                    </li>';
                                }else{
                                    echo '<li class="nav-item btn-dark rounded">
                                    <a class="nav-link text-white"  style="font-weight:bold!important;" href="/src/_html/_login/login.php">Login</a>
                                    </li>';
                                }
                            ?>  
                        </ul>
                        <form class="d-flex" method="GET" action="/src/_html/busca/busca.php">
                            <input class="form-control me-2" name="buscar" type="search" placeholder="Procurando alguém?" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Pesquisar</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <main class="main">
            <div class="container-fluid" >   
                <div class="newPost">
                    <div class="infoUser">
                        <div class="imgUser"></div>
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

                    foreach($results as $item){                
                        $getUser = "SELECT * FROM tb_usuarios WHERE id = :idusuario";
                        $usuario = $sql->select($getUser,[
                            ':idusuario'=>$item['idusuario']
                        ])[0];             
                        $nome = $usuario['desnome'];
                        $data = date('d/m/Y H:i', strtotime($item['data']));
                        $mensagem = $item['mensagem'];
                        $curtidas = $item['incurtidas'];
                        $id__ = $item['idpost'];

                        $idlogado = $_SESSION['USER_GLOBAL_DATA']['id'];
                        echo "
                        <div class='posts'>
                            <div class='post'>
                                <form action='/src/index.php' method='post'>   
                                    <div class='infoUserPost'>
                                        <div class='imgUserPost'></div>
                                            <div class='nameAndHour'>
                                                <strong class='text-dark'>$nome</strong>
                                                <p class='text-dark'>$data</p>
                                            </div>
                                        </div>
                                        <p class='text-dark'>$mensagem</p>
                                        <div class='actionBtnPost'>
                                            <input type='hidden' name='idpost' value='$item[idpost]'>
                                            <i class='fas fa-thumbs-up'></i><button type='submit' class='btn btn-light' name='curtir' value='$id__'>Curtir</button>
                                            <i class='fas fa-comment'></i><b class='btn btn-light' onclick='comenta_postagem($id__,$idlogado)' >Comentar</b>
                                            <i class='fas fa-heart'></i> $curtidas Curtidas 
                                            <div class='right'> <i class='fas fa-trash-alt'></i><input type='submit' class='btn btn-light' name='delete' value='Excluir'>
                                            <i class='fas fa-edit'></i><b class='btn btn-light' onclick='edita_postagem($id__)'>Editar</b></div>
                                        </div>    
                                    </div>
                                </form>  
                            </div>
                            
                              
                     ";
                    }

                            /*<div class='comments'>
                                <div class='comment'>
                                    <form action='/src/index.php' method='post'>   
                                        <div class='infoUserComm'>
                                            <div class='imgUserComm'></div>
                                                <div class='nameAndHour'>
                                                    <strong class='text-dark'>$nome</strong> - $data
                                                </div>
                                            </div>
                                            <p class='text-dark'>$mensagem</p>
                                            <div class='actionBtnComm'>
                                                <input type='hidden' name='idpost' value='$item[idpost]'>
                                                <i class='fas fa-thumbs-up'></i><button type='submit' class='btn btn-light' name='curtir' value='$id__'>Curtir</button>
                                                <i class='fas fa-heart'></i> $curtidas Curtidas 
                                                <div class='right'> <i class='fas fa-trash-alt'></i><input type='submit' class='btn btn-light' name='delete' value='Excluir'>
                                                <i class='fas fa-edit'></i><b class='btn btn-light' onclick='edita_postagem($id__)'>Editar</b></div>
                                            </div>    
                                        </div>
                                    </form>  
                                </div>
                            </div>*/
                            

         
                    if( isset($_POST['comentar']) ){
                        $id = $_POST['idpost'];
                        $query = "SELECT * FROM tb_postagens WHERE idpost = $id";
                        $post = $sql->select($query);
                        $mensagem = $post[0]['mensagem'];
                                        
                        echo "
                        <div class='posts'>
                            <div class='post'>
                                <form action='/src/index.php' method='post'>   
                                    <div class='infoUserPost'>
                                        <div class='form-outline w-100 mb-4'>
                                            <input type='hidden' name='idpost' value='idpost'>
                                            <textarea name='coment' class='form-control' rows='3' placeholder='O que acha disso?'></textarea>
                                            <div class='actionBtnPost'>

                                                <input type='hidden' name='coment' value='$id'></input>
                                                <button type='submit' class='btn btn-danger'>Comentar</button>

                                            </div>
                                        </div>   
                                    </div>
                                </form>  
                            </div>  
                        </div>
                        ";
                    }

                    

                    if( isset($_POST['editar']) ){
                        $id = $_POST['idpost'];
                        $query = "SELECT * FROM tb_postagens WHERE idpost = $id";
                        $post = $sql->select($query);
                        $mensagem = $post[0]['mensagem'];
                        echo "
                        <div class='posts'>
                            <div class='post'>
                                <form action='/src/index.php' method='post'>   
                                    <div class='infoUserPost'>
                                        <div class='form-outline w-100 mb-4'>
                                            <input type='hidden' name='idpost' value='idpost'>
                                            <textarea name='editmensagem' class='form-control' rows='3'  >$mensagem</textarea>
                                            <div class='actionBtnPost'>
                                                <input type='hidden' name='editpost' value='$id'></input>
                                                <button type='submit' class='btn btn-danger'>Editar</button>
                                            </div>
                                        </div>   
                                    </div>
                                </form>  
                            </div>  
                        </div>
                        ";
                    }
                ?>
            </div>
        </main> 
    </body>

    <script>
                   
                    function edita_postagem(idpost){
                        Swal.fire({
                            title: 'Editar Postagem',
                            input: 'text',
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Enviar',
                            showLoaderOnConfirm: true,
                            preConfirm: (login) => {
                                return $.post({
                                    url: '/src/_php/postagem/editar.php',
                                    data: {
                                        idpost: idpost,
                                        mensagem: login,
                                    },
                                })
                                .done(response => {
                                    if (!response.ok) {
                                        throw new Error(response.statusText)
                                    }
                                    return response.json()
                                })
                                .fail(error => {
                                    Swal.showValidationMessage(
                                        `Request failed: ${error}`
                                    )
                                })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                            result.value = JSON.parse(result.value)
                            if (result.value) {
                                Swal.fire({
                                    title: 'Editado!',
                                    text: result.value.message,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                })
                             
                                 location.reload();
                            }
                        })
                    }
                    
                    
                    function comenta_postagem(idpost,iduser){
                        Swal.fire({
                            title: 'Comentar',
                            input: 'text',
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Enviar',
                            showLoaderOnConfirm: true,
                            preConfirm: (login) => {
                             
                                return $.post({
                                    url: '/src/_php/postagem/comentar.php',
                                    data: {
                                        idpost: idpost,
                                        iduser: iduser,
                                        coment: login
                                    },
                                })
                                .done(response => {
                                    if (!response.ok) {
                                        throw new Error(response.statusText)
                                    }
                                    return response.json()
                                })
                                .fail(error => {
                                    Swal.showValidationMessage(
                                        `Request failed: ${error}`
                                    )
                                })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                            if (result.value) {
                                result.value = JSON.parse(result.value);
                                Swal.fire({
                                    title: 'Comentado!',
                                    text: result.value.message,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                })
                            }
                        })
                    }


    </script>



    <footer>
        <!-- Import do jQuery + JS do Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </footer>
</html>

<!-- Nesta etapa deverão ser entregues:

Criar Comentário (associado a uma postagem) check
Editar Comentário (restrito ao autor)
Excluir Comentário (restrito ao autor e ao administrador) 
Exibir Comentário na Timeline (aninhada à postagem correspondente)
Curtir postagem/comentário check --> 