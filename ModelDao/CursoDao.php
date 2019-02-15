<?php

require 'conexao/conexao.php';

abstract class CursoDao extends DB {

    protected $table;

    abstract public function insert();

    abstract public function update($id_professor);

    public function find($id_curso) {
        $sql = "SELECT * FROM $this->table WHERE id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    

    public function findAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function findAllProfessor() {
        $sql = "SELECT * FROM professor";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllComInner() {
        $sql = "SELECT c.id_curso, c.nome, c.data_criacao, p.nome as professor from curso c INNER JOIN professor p on c.idprofessor=p.id_professor";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findAllComNome($id_curso) {
        $sql = "SELECT c.id_curso, c.nome, c.data_criacao, p.nome as professor from curso c INNER JOIN professor p on c.idprofessor=p.id_professor where c.idprofessor = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function delete($id_curso) {
        $sql = "DELETE FROM $this->table WHERE id_curso = :id_curso";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        return $stmt->execute();
    }
   
    

}
