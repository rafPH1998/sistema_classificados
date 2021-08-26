<?php require 'pages/header.php';?>

<div class="container">

    <h1>Login</h1>

    <?php if(!empty($_SESSION['msg'])):?>
        <?=$_SESSION['msg'];?>
        <?=$_SESSION['msg'] = ''; ?>
    <?php endif;?>

    <form method="POST" action="login_action.php">

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>

        <input type="submit" value="Fazer Login" class="btn btn-default">
    </form>
</div>
<?php require 'pages/footer.php';