<?php

class Sql extends \PDO{

    private $conn;

    const DBNAME = "db_horizon";
    const HOST = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";


    /**
     * ESTA FUNÇÃO É CHAMADA TODA VEZ QUE ESTA CLASSE É INSTANCIADA ($sql = new Sql())
     * FAZENDO A CONEXÃO NO BANCO DE DADOS.
     * @param null
     * @return null
     */
    public function __construct(){
        $this->conn = new \PDO(
            "mysql:dbname=".Sql::DBNAME.";host=".Sql::HOST,
            Sql::USERNAME,
            Sql::PASSWORD
        );
    }

    /**
     * ESTA FUNÇÃO IRÁ DEFINIR O VALOR DO PARAMETRO PASSADO
     * EXEMPLO DE PAREMETROS (:NOME, :EMAIL, :SENHA)
     * @param array
     * @return null
    */
    public function setParam( $statement,$key, $value ){
        $statement->bindParam($key,$value);
    }

    /**
     * ESTA FUNÇÃO IRÁ DEFINIR OS PARAMETROS RECEBIDOS PARA A CONSULTA
     * IRÁ PERCORRER TODOS OS PARAMETROS E DEFINIR O VALOR DE CADA UM
     * PRA CADA VALOR IRÁ CHAMAR A FUNÇÃO SETPARAM
     * EXEMPLO DE PAREMETROS (:NOME, :EMAIL, :SENHA)
     * @param array
     * @return null
    */
    public function setParams( $statement, $parameters = array() ){
        foreach ($parameters as $key => $value) {
            $this->setParam( $statement, $key, $value );
        }
    }


    /**
     * ESTA FUNÇÃO IRÁ EXECUTAR A CONSULTA E NÃO RETORNAR NENHUM RESULTADO.
     * EXEMPLOS DE CONSULTAS PARA SEREM UTILIZADAS AQUI NESTE MÉTODO:
     * INSERT, UPDATE, DELETE
     * @param string
     * @param array
     */
    public function QuerySQL( $rawQuery, $params = array()){
        $stmt = $this->conn->prepare( $rawQuery );
        $this->setParams( $stmt, $params );
        $stmt->execute();
        return $stmt;
    }


    /**
     * ESTA FUNÇÃO IRÁ EXECUTAR A CONSULTA E RETORNAR RESULTADOS.
     * EXEMPLOS DE CONSULTAS PARA SEREM UTILIZADAS AQUI NESTE MÉTODO:
     * SELECT
     * @param string
     * @param array
     * @return array
    */
    public function select( $rawQuery, $params = array() ){
        $stmt = $this->QuerySQL( $rawQuery, $params );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }




    /**
     * ESTA FUNÇÃO IRÁ RECEBER OS RESULTADOS DA QUERY E MOSTRAR NA TELA
     * @param array
     * @return string
     */
    public function show($results){
        echo "<pre>";
        print_r($results);
        echo "</pre>";
        exit;
    }

}


?>