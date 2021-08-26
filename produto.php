<?php

require 'pages/header.php';
require_once 'dao/AnunciosDaoMysql.php';
require_once 'dao/UsuarioDaoMysql.php';
require_once 'dao/CategoriasDaoMysql.php';

$anuncios = new AnunciosDaoMysql($pdo);
$usuarios = new UsuarioDaoMysql($pdo);
$c = new CategoriasDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');
if($id) {
    $info =  $anuncios->findById($id);
    $usu = $usuarios->getTelefone();
    $categoria = $c->getCategoria(); 
}

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-6">
            <img src="assets/images/<?=$info->getUrl();?>">
        </div>

        <div class="col-sm-5">
            <h1><?=$info->getTitulo();?></h1>
            <h4><?=$categoria->getNomeCategoria();?></h4>
            <h3><?=$info->getDescricao();?></h3>
            <br/>
            <h3>R$ <?= number_format($info->getValor(), 2);?></h3>
            <h4><?=$usu->getTelefone();?></h4>
        </div>
    </div>

</div>
<?php require 'pages/footer.php';



