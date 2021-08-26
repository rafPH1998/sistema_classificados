<?php
require 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDAO {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getTotalUsuarios() {
        $array = [];

        $sql = $this->pdo->query("SELECT COUNT(*) as u FROM usuarios");
        $row = $sql->fetch();

        return $row['u'];
    }

    public function cadastrar(Usuario $u) {

            $sql = $this->pdo->prepare("INSERT INTO usuarios SET  nome = :nome,
            email = :email, senha = :senha, telefone = :telefone");
            $sql->bindValue(':nome', $u->getNome());
            $sql->bindValue(':email', $u->getEmail());
            $sql->bindValue(':senha', md5($u->getSenha()));
            $sql->bindValue(':telefone', $u->getTelefone());
            $sql->execute();

            return true;
 
    }

    public function getName() {
        $sql = $this->pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $_SESSION['login']);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new Usuario();
            $u->setNome($data['nome']);

            return $u;

        } else {
            return false;
        }
        
    }

    public function findByEmail($email) {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new Usuario();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);
            $u->setSenha($data['senha']);
            $u->setTelefone($data['telefone']);

            return $u;

        } else {
            return false;
        }
    }

    public function login($email, $senha) {
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $_SESSION['login'] = $dado['id'];
            return true;
        } else {
            return false;
        }
        
    }

    public function getTelefone() {
        $array = [];

        $sql = $this->pdo->query("SELECT telefone FROM usuarios");
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $u = new Usuario();
            $u->setTelefone($data['telefone']);

            return $u;
        }

        return $array;

    }

   
       


}