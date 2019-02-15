<?php
require 'ModelDao/AlunoDao.php';
class Aluno extends AlunoDao{

    protected $table = 'aluno';
    
    private $id_aluno;
    private $nome;
    private $data_nascimento;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $data_criacao;
    private $cep;
    private $idcurso;

    function getId_aluno() {
        return $this->id_aluno;
    }

    function setId_aluno($id_aluno) {
        $this->id_aluno = $id_aluno;
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

    function getLogradouro() {
        return $this->logradouro;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getData_criacao() {
        return $this->data_criacao;
    }

    function setData_criacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }

    function getCep() {
        return $this->cep;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function getIdcurso() {
        return $this->idcurso;
    }

    function setIdcurso($idcurso) {
        $this->idcurso = $idcurso;
    }

        public function getData() {
        date_default_timezone_set('America/manaus');
        $date = date('Y-m-d');
        $hora = date('H:i:s');
        return $date . ' ' . $hora;
    }
    
    public function insert() {

        $sql = "INSERT INTO $this->table (nome, data_criacao, data_nascimento, logradouro, numero, bairro, cidade, estado, cep, idcurso) VALUES (:nome, :data_criacao, :data_nascimento, :logradouro, :numero, :bairro, :cidade, :estado, :cep, :idcurso)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':data_criacao', $this->getData());
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':logradouro', $this->logradouro);
        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':bairro', $this->bairro);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':idcurso', $this->idcurso);
        return $stmt->execute();
    }

    public function update($id_aluno) {
        $sql = "UPDATE $this->table SET nome = :nome, data_criacao = :data_criacao, data_nascimento =: data_nascimento, logradouro =: logradouro, numero =: numero, bairro =: bairro, cidade =: cidade, estado =: estado, cep =: cep, idcurso =: idcurso WHERE id_aluno = :id_aluno";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':data_criacao', $this->getData());
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':logradouro', $this->logradouro);
        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':bairro', $this->bairro);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':idcurso', $this->idcurso);
        $stmt->bindParam(':id_aluno', $id_aluno);
        return $stmt->execute();
    }
}
