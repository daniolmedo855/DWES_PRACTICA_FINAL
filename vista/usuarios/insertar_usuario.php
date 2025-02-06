<?php require_once("../vista/inicio.html");?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_usuarios.html");
    ?>
</div>
<div class="form">
    <h3>Insertar Usuario</h3>
    <form action="../controlador/index.php" method="POST">
        <input type="hidden" name="action" value="insertar_usuario">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" required>
        <label for="contrasenia">Contraseña:</label><br>
        <input type="password" name="contrasenia" id="contrasenia" required>
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <a href="../controlador/index.php?action=usuarios" class="boton">Volver</a>
        </div>
    </form>
</div>
<?php require_once("../vista/fin.html");?>