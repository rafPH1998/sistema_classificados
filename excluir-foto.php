<?php
require 'pages/header.php';

require 'dao/AnunciosDaoMysql.php';

$anuncioDao = new AnunciosDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $anuncioDao->deleteFoto($id);
    $_SESSION['aviso'] = '<div class="alert alert-success">Imagem excluida com sucesso!</div><br/>';
    header("Location: meus-anuncio.php");
    exit;

}


require 'pages/footer.php';
