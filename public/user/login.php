<?php 
include('../includes/head.php'); 

$users = json_decode(file_get_contents("users.json"), 1);
if (!empty($_POST)) {
    if (!empty($users[$_POST['user']]) && $users[$_POST['user']] == $_POST['password'] ) {
        $_SESSION['name'] = $_POST['user'];
        header('Location: ../index.php');
    } else {
        echo '<div class="alert alert-danger">Usuario o contraseña no validos, pruebe de nuevo.</div>';
    }
}
?>
<div class="container text-center">
    <h1 class="mt-5">Inicia sesión en chat</h1>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="username">Usuario</label>
            <input type="text" name="user" class="form-control" id="username">
        </div>
        <div class="form-group mt-2">
            <label for="pwd">Contraseña</label>
            <input type="password" name="password" class="form-control" id="pwd">
        </div>
        <button type="submit" class="btn btn-success mt-2">Entrar</button>
    </form>
</div>


<?php include('../includes/footer.php'); ?>