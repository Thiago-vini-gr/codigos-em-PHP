<?php
class Pessoa{  # Classe Pessoa
    private $conexao; # Atributo para armazenar a conexão com o banco de dados
    private $nome_tabela = "pessoa"; # Nome da tabela no banco de dados

    public $id; # Atributo para armazenar o ID da pessoa
    public $nome; # Atributo para armazenar o nome da pessoa
    public $idade; # Atributo para armazenar a idade da pessoa

    public function __construct($db){ # Construtor da classe que recebe a conexão com o banco de dados
        $this->conexao = $db;  # Atribui a conexão recebida ao atributo $conexao
    }
    public function criar(){ # Método para criar uma nova pessoa no banco de dados
        $query = "INSERT INTO " . $this->nome_tabela . " (nome, idade) VALUES (:nome, :idade)"; # Consulta SQL para inserir uma nova pessoa
        $stmt = $this->conexao->prepare($query); # Prepara a consulta SQL
    
        $this->nome = htmlspecialchars(strip_tags($this->nome)); # Sanitiza o nome da pessoa
        $this->idade = htmlspecialchars(strip_tags($this->idade)); # Sanitiza a idade da pessoa
    
        $stmt->bindParam(":nome", $this->nome); # Vincula o parâmetro :nome ao atributo $nome
        $stmt->bindParam(":idade", $this->idade); # Vincula o parâmetro :idade ao atributo $idade
    
        if ($stmt->execute()){ # Executa a consulta SQL
            return true;
        }
        return false; # Retorna false se a execução falhar
    }
    
    public function ler(){ # Método para ler todas as pessoas do banco de dados
        $query = "SELECT id, nome, idade FROM " . $this->nome_tabela . " ORDER BY id ASC"; // Ordena pelo ID em ordem crescente
        $stmt = $this->conexao->prepare($query); // Prepara a consulta SQL
        $stmt->execute(); // Executa a consulta SQL
        return $stmt; // Retorna o resultado da consulta
    }

    public function altera_idade($id, $novaIdade) {
        $query = "UPDATE " . $this->nome_tabela . " SET idade = :idade WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':idade', $novaIdade);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM pessoa WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>