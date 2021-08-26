<?php
require 'pages/header.php';
require_once 'dao/CategoriasDaoMysql.php';
require_once 'dao/AnunciosDaoMysql.php';


$c = new CategoriasDaoMysql($pdo);
$a = new AnunciosDaoMysql($pdo);

$cats = $c->getLista();

$usuario = false;
$foto = false;

$id = filter_input(INPUT_GET, 'id');
if($id) {
    $usuario = $a->findById($id);
    $foto = $a->getFoto($id);
}
if($usuario === false) {
    header("Location: login.php");
    exit;
}


?>

<?php if(!empty($_SESSION['aviso'])):?>
    <?=$_SESSION['aviso'];?>
    <?=$_SESSION['aviso'] = ''; ?>
<?php endif;?>

<div class="container">
    <h1>Editar Anúncio</h1>
    
    <form method="POST" enctype="multipart/form-data" action="editar-produto_Action.php">

    <input type="hidden" name="id" value="<?=$usuario->getId();?>" />

        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" class="form-control">
                <?php foreach($cats as $item):?>
                    <option value="<?=$item->getId();?>" <?php echo ($usuario->getIdCategoria() == $item->getId()) ? 'selected="selected"' : ''; ?> ><?=$item->getNomeCategoria();?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?=$usuario->getTitulo();?>">
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?=$usuario->getValor();?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" class="form-control"><?=$usuario->getDescricao();?></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado de Conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0" <?php echo ($usuario->getEstado() == '0') ? 'selected="selected"' : ''; ?>>Ruim</option>
                <option value="1" <?php echo ($usuario->getEstado() == '1') ? 'selected="selected"' : ''; ?>>Bom</option>
                <option value="2" <?php echo ($usuario->getEstado() == '2') ? 'selected="selected"' : ''; ?>>Ótimo</option>
            </select>
        </div>

        <div class="panel panel-default">
                
            <div class="panel-heading">Fotos do Anúncio</div><br/>
            <div class="form-group">
                <label for="add_foto">Trocar foto:</label>
                <input type="file" name="fotos[]" multiple><br/>
            </div>
            <div class="panel-body">
                <?php foreach($foto as $fotos): ?>
                    <div class="foto-item">
                        <img src="assets/images/<?=$fotos->getUrl(); ?>" border="0" class="img-thumbnail">
                    </div> 
                <?php endforeach;?>
            </div>
        </div>

        <input type="submit" value="Salvar" class="btn btn-default">

 
    </form>

</div>


<?php require 'pages/footer.php';

