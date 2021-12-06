<?php

    include __DIR__."/../../_sql/sql.php";
    $sql = new Sql();

    if(isset($_POST['excluir']) && filter_input(INPUT_POST, 'excluir', FILTER_VALIDATE_INT) !== false){
        $query_excluir_usuario = "DELETE FROM tb_usuarios WHERE id='$id'";
        $sql->QuerySql($query_excluir_usuario);
    
        header('Location: /src/_html/dashboard/lista.php');
        exit;
    }



    
        
        
?>

