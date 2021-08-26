<?php
require 'pages/header.php';
require 'config.php';
require 'dao/AnunciosDaoMysql.php';

$anuncioDao = new AnunciosDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $anuncioDao->deleteAnuncio($id);
    $_SESSION['msg'] = '<div class="alert alert-success">Anúncio excluido!</div><br/>';
    header("Location:meus-anuncios.php");
    exit;

}

header("Location:meus-anuncios.php");
exit;

require 'pages/footer.php';

