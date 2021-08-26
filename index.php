<?php
require 'pages/header.php';
require_once 'dao/AnunciosDaoMysql.php';
require_once 'dao/UsuarioDaoMysql.php';
require_once 'dao/CategoriasDaoMysql.php';
$a = new AnunciosDaoMysql($pdo);
$usuarios = new UsuarioDaoMysql($pdo);
$c = new CategoriasDaoMysql($pdo);

$totalAnuncios = $a->getTotalAnuncio();
$totalUsuarios = $usuarios->getTotalUsuarios();
$categorias = $c->getLista();

$anuncios = $a->getUltimosAnuncios();

?>

<div class="container-fluid">
    <div class="jumbotron">
        <h2>Nós temos hoje <?=$totalAnuncios;?> anúncios</h2>
        <p>E mais de <?=$totalUsuarios;?> cadastrados</p>
    </div>

        <div class="col-sm-9">
            <h4>Últimos Anúncios</h4>
            <table class="table table-striped">
                <tbody>
                    <?php foreach($anuncios as $anuncio):?>
                        <tr>
                            <td>
                                <?php if(!empty($anuncio->getUrl())):?>
                                    <img src="assets/images/<?=$anuncio->getUrl();?>" border="0" height="50">
                                <?php endif;?>
                            </td>
                            <td>
                                <a href="produto.php?id=<?=$anuncio->getId();?>"><?=$anuncio->getTitulo();?></a><br/>
                            </td>
                            <td>
                                R$ <?php echo number_format($anuncio->getValor(), 2);?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php require 'pages/footer.php';