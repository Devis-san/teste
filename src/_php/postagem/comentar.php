<?php
    

    include  __DIR__.'/../../_sql/sql.php';
    session_start();


    $iduser = isset($_POST['iduser']) ? $_POST['iduser']: 'null';
    $idpost = isset($_POST['idpost']) ? $_POST['idpost']: 'null';
    $coment = isset($_POST['coment']) ? $_POST['coment']: 'null';

    $msg = $iduser . ' ' . $idpost . ' ' . $coment;


    $sql = new Sql();

    $query = "INSERT INTO tb_comentarios (idpost, idusuario, mensagem) VALUES (:iduser, :idusuario, :mensagem)";
    
    try {
        $sql->QuerySQL($query,[
            ':iduser' => $iduser,
            ':idusuario' => $idpost,
            ':mensagem' => $coment
        ]);
        echo json_encode(array('status' => 'success', 'message' => 'Comentado com sucesso!'));
    } catch (Exception $e) {
        echo json_encode(array('status' => 'success', 'message' => $e->getMessage())); 
    }

   
   

   
?>