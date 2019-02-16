<?php

require 'conexao/conexao.php';

abstract class ProfessorDao extends DB {

    protected $table;

    abstract public function insert();

    abstract public function update($id_professor);

    public function find($id_professor) {
        $sql = "SELECT * FROM $this->table WHERE id_professor = :id_professor";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($id_professor) {
        $sql = "DELETE FROM $this->table WHERE id_professor = :id_professor";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
        return $stmt->execute();
    }

   
    public function listagem($nome) {
        $sql = "select *from  professor where nome  like :nome";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', "%$nome%");
        $stmt->execute();
        return $stmt->fetch();
    }

}
