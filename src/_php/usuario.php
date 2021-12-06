<?php


    class usuario{

        //constante que vai armazenar as informações do usuário
        const USER_DATA = 'USER_GLOBAL_DATA';

        /**
         * função que irá receber as informações do usuário e armazenar na constante USER_DATA
         * @return null
        */
        public static function set($userData){
            //armazenando as informações do usuário na constante USER_DATA
            $_SESSION[self::USER_DATA] = $userData;
        }

        /**
         * Retorna as informações do usuário
         * @return array
        */
        public static function get(){
            //retornando as informações do usuário
            return $_SESSION[self::USER_DATA];
        }
    }

    

?>