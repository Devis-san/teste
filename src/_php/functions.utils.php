<?php

    function setPasswordHashing( $despassword ){
        return password_hash(
            $despassword,

            PASSWORD_DEFAULT,
            [
                'cost' => 12,
            ]
        );                                     
    }//end Method

  
    

?>