<?php
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $telefone;

    public function getId() {
        return $this->id;
    }

    public function setId($i) {
        $this->id = trim($i);
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($n) {
        $this->nome = trim(ucwords($n));
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($e) {
        $this->email = trim(strtolower($e));
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($s) {
        $this->senha = $s;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($t) {
        $this->telefone = $t;
    }


    
}


interface UsuarioDAO {
    public function cadastrar(Usuario $u);
    public function findByEmail($email);
    public function login($email, $senha);
    public function getName();
    public function getTotalUsuarios();
    public function getTelefone();
}

