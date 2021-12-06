<?php


   include  __DIR__.'/../../_sql/sql.php';
   session_start();
   $sql = new Sql();

   $query = "INSERT INTO tb_postagens (idusuario, mensagem) VALUES (:idusuario, :mensagem)";

   $create_post = $sql->QuerySQL($query,[
      ':idusuario'=> $_SESSION['USER_GLOBAL_DATA']['id'],
      ':mensagem' => $_POST['mensagem']
   ]);

   if($create_post){
       
       Header("Location: /src/index.php");
       exit;
   }else{
      echo "Erro ao publicar";
   }
?>