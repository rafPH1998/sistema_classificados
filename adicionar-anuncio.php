<?php
require 'pages/header.php';
require_once 'dao/CategoriasDaoMysql.php';

$c = new CategoriasDaoMysql($pdo);
$cats = $c->getLista();

?>

<?php if(!empty($_SESSION['aviso'])):?>
    <?=$_SESSION['aviso'];?>
    <?=$_SESSION['aviso'] = ''; ?>
<?php endif;?>

<div class="container">
    <h1>Meus anúncios - Adicionar Anúncio</h1>
    
    <form method="POST" enctype="multipart/form-data" action="adicionar_Action.php">
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
                <?php foreach($cats as $item):?>
                    <option value="<?=$item->getId();?>"><?=$item->getNomeCategoria();?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control">
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0">Ruim</option>
                <option value="1">Bom</option>
                <option value="2">Ótimo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="add_foto">Fotos do anúncio:</label>
            <input type="file" name="fotos[]" multiple><br/>
        </div>

        <input type="submit" value="Adicionar" class="btn btn-default">

 
    </form>

</div>


<?php require 'pages/footer.php';