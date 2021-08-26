<?php
require 'pages/header.php';
require_once 'dao/AnunciosDaoMysql.php';
$anuncioDao = new AnunciosDaoMysql($pdo);

$categoria = filter_input(INPUT_POST, 'categoria');
$titulo = filter_input(INPUT_POST, 'titulo');
$valor = filter_input(INPUT_POST, 'valor');
$descricao = filter_input(INPUT_POST, 'descricao');
$estado = filter_input(INPUT_POST, 'estado');
if(isset($_FILES['fotos'])) {
    $fotos = $_FILES['fotos'];
} else {
    $fotos = [];
}

$id = filter_input(INPUT_POST, 'id');


if($categoria && $titulo && $valor && $descricao && $estado && $fotos && $id) {

    $newAnuncio = new Anuncio();
    $newAnuncio->setTitulo($titulo);
    $newAnuncio->setIdCategoria($categoria);
    $newAnuncio->setValor($valor);
    $newAnuncio->setDescricao($descricao);
    $newAnuncio->setEstado($estado);
    $newAnuncio->setId($id);
    $newAnuncio->setUrl($fotos);

    $anuncioDao->updateAnuncio($newAnuncio);
    
    $_SESSION['aviso'] = '<div class="alert alert-success">Produto editado com sucesso!</div>';
    header("Location: editar-anuncio.php?id=".$id);
    exit; 

}

?>
<?php require 'pages/footer.php';?>