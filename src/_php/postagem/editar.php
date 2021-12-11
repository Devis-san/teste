<?php

    include  __DIR__.'/../../_sql/sql.php';
    session_start();
  

    $idpost = isset($_POST['idpost']) ? $_POST['idpost']: 'null';
    $mensagem = isset($_POST['mensagem']) ? $_POST['mensagem']: 'null';
 
    $sql = new Sql();
    $query__ = "UPDATE tb_postagens SET mensagem = :mensagem WHERE idpost = :idpost";

    try {
        $sql->QuerySQL($query__,[
            ':idpost' => $idpost,
            ':mensagem' => $mensagem
        ]);
        $pai = $idpost . ' ' . $mensagem;
        echo  json_encode(array('status' => 'success', 'message' => 'Editado com sucesso'));
    } catch (\Throwable $th) {
        echo  json_encode(array('status' => 'error', 'message' => 'erro'));
    }
    
   

?>