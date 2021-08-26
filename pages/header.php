<?php
require 'config.php';
require_once 'dao/UsuarioDaoMysql.php';                  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Classificados</title>
</head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Classificados</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                   
                    <?php if(!empty($_SESSION['login'])):?>  <!--se existir um usuario cadastrado-->
                        <?php
                        $u = new UsuarioDaoMysql($pdo);
                        $nameUser = $u->getName();
                        ?>
                        <li><a href=""><?php echo "Bem vindo(a) ".$nameUser->getNome();?></a></li>
                        <li><a href="meus-anuncios.php">Meus anúncios</a></li>
                        <li><a href="sair.php">Sair</a></li>
                    <?php else:?>
                        <li><a href="cadastre-se.php">Cadastre-se</a></li> <!--se nao existir aparecer isso-->
                        <li><a href="login.php">Login</a></li>
                    <?php endif ;?>

                </ul>
            </div>
        </nav>

