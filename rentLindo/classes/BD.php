<?php
class BD {
    private $host = "localhost";
    private $user = "admrent";
    private $password = "12345";
    private $database = "rent";
    private $conexao;
    
    function __construct() {
        $this->conexao = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        mysqli_query($this->conexao, "SET NAMES 'utf8'");
    }   
    
    function select($sql) {
        //recebe um select qualquer, executa e devolve um array de resultados.
        //o resultado será um array com índice numérico, onde cada linha conterá um array associativo com os dados selecionados no BD
        $retorno = mysqli_query($this->conexao, $sql); // $this->conexao->query($sql);
        $arrayResultados = array();   
        if (mysqli_num_rows($retorno) > 0) {
            while($linha = mysqli_fetch_assoc($retorno)) {
                $arrayResultados[] = $linha;
            }
        }
        return $arrayResultados;
    }
    
    function query($sql) { // outras queries
        return mysqli_query($this->conexao, $sql);
    }    
    
    function erro(){
        return mysqli_error($this->conexao);
    }
}
?>