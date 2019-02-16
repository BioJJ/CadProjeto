<?php

require 'conexao/conexao.php';

abstract class AlunoDao extends DB {

    protected $table;

    abstract public function insert();

    abstract public function update($id_aluno);

    public function find($id_aluno) {
        $sql = "SELECT * FROM $this->table WHERE id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllCurso() {
        $sql = "SELECT * FROM curso";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllComInner() {
//        $sql = "SELECT c.id_curso, c.nome, c.data_criacao, p.nome as professor from curso c INNER JOIN professor p on c.idprofessor=p.id_professor";
        $sql = "SELECT a.id_aluno, a.nome, a.data_nascimento, a.logradouro, a.numero, a.bairro, a.cidade, a.estado, a.data_criacao, a.cep, c.nome as curso from aluno a INNER JOIN curso c ON a.id_aluno=c.id_curso";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllComNome($id_aluno) {
        $sql = "SELECT a.id_aluno, a.nome, c.nome as curso from aluno a INNER JOIN curso c on a.idcurso=c.id_curso where a.idcurso = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function Relatorio() {
        $sql = "select a.id_aluno, a.nome, c.nome as curso, p.nome as professor from aluno a INNER JOIN curso c on a.idcurso=c.id_curso INNER JOIN professor p on c.idprofessor=p.id_professor";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($id_aluno) {
        $sql = "DELETE FROM $this->table WHERE id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
