<?php
require 'pages/header.php';
require_once 'dao/AnunciosDaoMysql.php';
$a = new AnunciosDaoMysql($pdo);
$lista = $a->getMeusAnuncios();
?>
<div class="container">
    <h1>Meus Anúncios</h1>
    
    <?php if(!empty($_SESSION['msg'])):?>
        <?=$_SESSION['msg'];?>
        <?=$_SESSION['msg'] = ''; ?>
    <?php endif;?>

    <a href="adicionar-anuncio.php" class="btn btn-default">Adicionar Anúncio</a><br/>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Valor</th>
                <th>Ações</th>
             </tr>
        </thead>
        <?php foreach($lista as $anuncios) :?>
            <tr>
                <td>
                    <?php if(!empty($anuncios->getUrl())):?>
                        <img src="assets/images/<?=$anuncios->getUrl();?>" border="0" height="50">
                    <?php endif;?>
                </td>
                <td><?=$anuncios->getTitulo();?></td>
                <td>R$ <?php echo number_format($anuncios->getValor(), 2);?></td>
                <td>
                    <a href="editar-anuncio.php?id=<?=$anuncios->getId();?>" class="btn btn-primary">Editar</a>
                    <a href="exluir-anuncio.php?id=<?=$anuncios->getId();?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Exluir</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>

<?php require 'pages/footer.php';?>