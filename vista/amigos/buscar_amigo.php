<?php require_once("../vista/inicio.html"); ?>
<?php
    require_once("../vista/header.html");
    require_once("header_amigos.html");
?>
<div class="form">
    <h3>Buscar Amigo</h3>
    <form action="../controlador/index.php" method="POST">
        <input type="hidden" name="action" value="buscar_amigo">
        <label for="buscar">Nombre del amigo/Apellidos del amigo</label>
        <input type="text" name="buscar" id="buscar" required>
        <input type="submit" name="enviar" value="Enviar">
    </form>
    <a href="../controlador/index.php?action=amigos" class="boton">Volver</a>
</div>
<?php require_once("../vista/fin.html");?>