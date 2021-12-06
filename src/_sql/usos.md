
# =================================================

# RECEBENDO INFORMAÇÕES DO BANCO DE DADOS SEM PASSAR PARAMETROS

- <1> INSTANCIE O SQL
- <php $Sql() sql = new ?>

- <2> DEFINA A QUERY, POR EXEMPLO :
- <php $query = "SELECT * FROM tb_usuarios"; ?>

- <3> UTILIZE O MÉTODO SELECT PARA OBTER OS RESULTADOS :
- <php $resultados = $sql->select($query) ?>

- <3> MOSTRE OS RESULTADOS NA TELA :
- <php $sql->show($resultados) ?>

# =================================================







# =================================================

# RECEBENDO INFORMAÇÕES DO BANCO DE DADOS PASSANDO PARAMETROS

- <1> INSTANCIE O SQL
- <php $sql = new Sql() ?>

- <2> DEFINA A QUERY, POR EXEMPLO :
- <php $query = "SELECT * FROM tb_usuarios WHERE nome = :nome AND email = :email" ; ?>

- <3> DEFINA OS PARAMETROS DA QUERY EM UM ARRAY:
- <php $parametros = array(
    ':nome' => Joao,
    ':email' => 'Joao@gmail.com'
    )
   ?>

- <4> UTILIZE O MÉTODO SELECT PARA OBTER OS RESULTADOS E PASSE JUNTO DO SELECT OS PARAMETROS :
- <php $resultados = $sql->select($query, $parametros) ?>

- <5> MOSTRE OS RESULTADOS NA TELA :
- <php $sql->show($resultados) ?>

# =================================================











# =================================================

# EFETUANDO AÇÕES NO BANCO DE DADOS SEM PARAMETROS

- <1> INSTANCIE O SQL
- <php $sql = new Sql() ?>

- <2> DEFINA A QUERY, EXEMPLO :
- <php $query = "DELETE FROM tb_usuarios" ; ?>

- <4> UTILIZE O MÉTODO QuerySQL PARA EFETUAR A AÇÃO  :
- <php $sql->QuerySQL($query) ?>

# =================================================








# =================================================

# EFETUANDO AÇÕES NO BANCO DE DADOS PASSANDO PARAMETROS

- <1> INSTANCIE O SQL
- <php $sql = new Sql() ?>

- <2> DEFINA A QUERY, POR EXEMPLO :
- <php $query = "INSERT INTO tb_usuarios (nome, email, senha) VALUES (:nome, :email, :senha);" ; ?>

- <3> DEFINA OS PARAMETROS DA QUERY EM UM ARRAY:
- <php $parametros = array(
    ':nome' => $_POST['nome'],
    ':email' => $_POST['email'],
    ':senha' => $_POST['senha']
    )
   ?>

- <4> UTILIZE O MÉTODO SELECT PARA OBTER OS RESULTADOS E PASSE JUNTO DO SELECT OS PARAMETROS :
- <php  $sql->QuerySQL($query, $parametros) ?>

# =================================================








# FAZER BUSCAS

  //SEMPRE CHAMAR O SQL
	   $sql = new Sql();
	   //CHAMA A QUERY QUE A GENTE QUER

	   $query = "SELECT * FROM tb_usuarios WHERE desnome LIKE CONCAT('%', :desnome, '%')";

	   //PASSA OS PAREMETROS (SE EXISTEREM)
		$parametros = array(
			":desnome" => 'r'
		);

		$sql->show($sql->select($query, $parametros));

