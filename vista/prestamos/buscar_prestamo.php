<?php require_once("../vista/inicio.html"); ?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_prestamos.html");
    ?>
</div>
<div class="form">
    <h3>Buscar Prestamo</h3>
    <form action="../controlador/index.php" method="POST">
        <input type="hidden" name="action" value="buscar_prestamo">
        <label for="buscar">Nombre del amigo/Titulo del juego</label><br>
        <input type="text" name="buscar" id="buscar" required>
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <a href="../controlador/index.php?action=amigos" class="boton">Volver</a>
        </div>
    </form>
</div>
<?php require_once("../vista/fin.html");?>