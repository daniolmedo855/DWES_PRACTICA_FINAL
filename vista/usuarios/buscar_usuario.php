<?php require_once("../vista/inicio.html"); ?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_usuarios.html");
    ?>
</div>
<div class="form">
    <h3>Buscar Usuario</h3>
    <form action="../controlador/index.php" method="POST">
        <input type="hidden" name="action" value="buscar_usuario">
        <label for="buscar">Nombre de Usuario</label>
        <input type="text" name="buscar" id="buscar" required>
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <a href="../controlador/index.php?action=usuarios" class="boton">Volver</a>
        </div>
    </form>
</div>
<?php require_once("../vista/fin.html");?>