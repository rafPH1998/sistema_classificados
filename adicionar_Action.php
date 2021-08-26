<?php
require 'pages/header.php';
require 'config.php';
require 'dao/AnunciosDaoMysql.php';

$usuarioDao = new AnunciosDaoMysql($pdo);

$titulo = filter_input(INPUT_POST, 'titulo');
$categoria = filter_input(INPUT_POST, 'categoria');
$valor = filter_input(INPUT_POST, 'valor');
$descricao = filter_input(INPUT_POST, 'descricao');
$estado = filter_input(INPUT_POST, 'estado');
if(isset($_FILES['fotos'])) {
    $fotos = $_FILES['fotos'];
} else {
    $fotos = [];
}

if($titulo && $categoria && $valor && $descricao && $estado && $fotos) {
    $newAnuncio = new Anuncio();

    $newAnuncio->setTitulo($titulo);
    $newAnuncio->setIdCategoria($categoria);
    $newAnuncio->setValor($valor);
    $newAnuncio->setDescricao($descricao);
    $newAnuncio->setEstado($estado);
    $newAnuncio->setUrl($fotos);

    $usuarioDao->addAnuncio($newAnuncio);

    $_SESSION['aviso'] = '<div class="alert alert-success">Produto adicionado com sucesso!</div>';
    header("Location: adicionar-anuncio.php");
    exit;

} else {
    $_SESSION['aviso'] = '<div class="alert alert-warning">Adicione todos os campos!</div>';
    header("Location: adicionar-anuncio.php");
    exit;
}
?>

<?php require 'pages/footer.php';


