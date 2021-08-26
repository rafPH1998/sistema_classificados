<?php
require 'pages/header.php';
require_once 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');
$telefone = filter_input(INPUT_POST, 'telefone');

if($name && $email && $senha && $telefone) {
    if($usuarioDao->findByEmail($email) === false) {

        $newUsuario = new Usuario();
        $newUsuario->setNome($name);
        $newUsuario->setEmail($email);
        $newUsuario->setSenha($senha);
        $newUsuario->setTelefone($telefone);
    
        $usuarioDao->cadastrar($newUsuario);
       
        $_SESSION['msg'] = '<div class="alert alert-success">Usuário cadastrado com sucesso! <a href="login.php" class="alert-link">Faça o login agora</a></div><br/>';
        header("Location: cadastre-se.php");
        exit;

    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger">Este usuário já existe! <a href="login.php" class="alert-link">Faça o login</a></div>';
        header("Location: cadastre-se.php");
        exit;

    }
   
} else {
    $_SESSION['msg'] = '<div class="alert alert-warning">Preencha todos os campos!</div>';
    header("Location: cadastre-se.php");
    exit;
}

require 'pages/footer.php';