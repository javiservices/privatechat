<?php include('includes/head.php');
if (!isset($_SESSION['name'])) {
    header('Location: user/login.php');
}
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Chat: <?= $_SESSION['name'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php if($_SESSION['name'] == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link text-end" id="clear-chatbox">Borrar conversación</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link text-end" href="user/logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END Navbar -->
<!-- CHATBOX -->
<div id="chatbox">
    <div class="container">
        <h1>Bienvenido</h1>
        <p>Si eres el administrador, cuando le des a cerrar sesión en el menú superior, se borrará definitivamente esta conversación.</p>
    </div>
</div>
<div id="input-area" class="container-flex px-auto">
    <form id="message-form" action="chat/post.php" method="POST">
        <div class="row">
            <div class="col-8">
                <input type="text" class="form-control form-control-lg ms-2" placeholder="Inserte mensaje" name="msg">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-lg btn-light mx-auto">Enviar</button>
            </div>
        </div>
    </form>
</div>
<!-- END CHATBOX -->
<script>
    var username = "<?= $_SESSION['name'] ?>";
</script>
<script src="assets/js/messages.js"></script>
<?php include('includes/footer.php') ?>