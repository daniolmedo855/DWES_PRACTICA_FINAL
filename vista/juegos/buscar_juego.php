<?php require_once("../vista/inicio.html"); ?>
<?php
    require_once("../vista/header.php");
    require_once("header_juegos.html");
?>
<div class="form">
    <h3>Buscar Juegos</h3>
    <form action="../controlador/index.php" method="POST">
        <input type="hidden" name="action" value="buscar_juego">
        <label for="buscar">Titulo del Juego/Plataforma</label>
        <input type="text" name="buscar" id="buscar" required>
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <a href="../controlador/index.php?action=juegos" class="boton">Volver</a>
        </div>
    </form>
</div>
<?php require_once("../vista/fin.html");?>