<?php require_once("../vista/inicio.html"); ?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_usuarios.html");
        ?>
</div>
<div class="form">
    <h3>Modificar Usuario</h3>
    <form action="../controlador/index.php" method="POST">
        <input type="hidden" name="action" value="modificar_usuario">
        <input type="hidden" name="id" value="<?php echo $usuario->get_id($usuario->__get("nombre"));?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" value="<?php echo $usuario->__get("nombre");?>" required>
        <label for="contrasenia">Nueva Contraseña:</label><br>
        <input type="text" name="contrasenia" id="contrasenia">
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <a href="../controlador/index.php?action=usuarios" class="boton">Volver</a>
        </div>
    </form>
</div>
<?php
    require_once("../vista/fin.html");
?>