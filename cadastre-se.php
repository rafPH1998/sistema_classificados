<?php require 'pages/header.php';?>

<div class="container">

    <h1>Cadastre-se</h1>

    <?php if(!empty($_SESSION['msg'])):?>
        <?=$_SESSION['msg'];?>
        <?=$_SESSION['msg'] = ''; ?>
    <?php endif;?>

    <form method="POST" action="cadastre-se_action.php">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>

        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control">
        </div>

        <input type="submit" value="Cadastrar" class="btn btn-default">
    </form>
</div>
<?php require 'pages/footer.php';