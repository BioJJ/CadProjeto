<?php
require 'ModelDao/CursoDao.php';
class Curso extends CursoDao{

    protected $table = 'curso';
    
    private $id_curso;
    private $nome;
    private $data_criacao;
    private $idprofessor;

    function getId_curso() {
        return $this->id_curso;
    }

    function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getData_criacao() {
        return $this->data_criacao;
    }

    function setData_criacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }

    function getIdprofessor() {
        return $this->idprofessor;
    }

    function setIdprofessor($idprofessor) {
        $this->idprofessor = $idprofessor;
    }

    public function getData() {
        date_default_timezone_set('America/manaus');
        $date = date('Y-m-d');
        $hora = date('H:i:s');
        return $date . ' ' . $hora;
    }
    
    public function insert() {

        $sql = "INSERT INTO $this->table (nome, data_criacao, idprofessor) VALUES (:nome, :data_criacao, :idprofessor)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':data_criacao', $this->getData());
        $stmt->bindParam(':idprofessor', $this->idprofessor);
        return $stmt->execute();
    }

    public function update($id_curso) {
        $sql = "UPDATE $this->table SET nome = :nome, data_criacao = :data_criacao, idprofessor = :idprofessor WHERE id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':data_criacao', $this->getData());
        $stmt->bindParam(':idprofessor', $this->idprofessor);
        $stmt->bindParam(':id_curso', $id_curso);
        return $stmt->execute();
    }

}
