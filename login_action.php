<?php
require 'pages/header.php';
require 'config.php';
require_once 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');
if($email && $email) {

    if($usuarioDao->login($email, $senha)) {

        header("Location: index.php");
        exit;

    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger">Usuário e/ou senha errados!</div>';
        header("Location: login.php");
        exit;
    }
}

require 'pages/footer.php';