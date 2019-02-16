<?php

require 'ModelDao/ProfessorDao.php';

class Professor extends ProfessorDao {

    protected $table = 'professor';
    private $id_professor;
    private $nome;
    private $data_nascimento;
    private $data_criacao;

    function getId_professor() {
        return $this->id_professor;
    }

    function setId_professor($id_professor) {
        $this->id_professor = $id_professor;
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getData_nascimento() {
        return $this->data_nascimento;
    }

    function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    function getData_criacao() {
        return $this->data_criacao;
    }

    function setData_criacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }

    public function getData() {
        date_default_timezone_set('America/manaus');
        $date = date('Y-m-d');
        $hora = date('H:i:s');
        return $date . ' ' . $hora;
    }

    public function insert() {

        $sql = "INSERT INTO $this->table (nome, data_nascimento, data_criacao) VALUES (:nome, :data_nascimento, :data_criacao)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':data_criacao', $this->getData());
        return $stmt->execute();
    }

    public function update($id_professor) {
        $sql = "UPDATE $this->table SET nome = :nome, data_nascimento = :data_nascimento WHERE id_professor = :id_professor";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':id_professor', $id_professor);
        return $stmt->execute();
    }

     public function inverterData($data){
        return implode("-",array_reverse(explode("-",$data)));
      
    }

}
