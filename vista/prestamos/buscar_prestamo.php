<?php
    require_once("../vista/inicio.html");
    ?>
<body>
<?php
    require_once("../vista/header.html");
    require_once("header_prestamos.html");
?>
<h3>BUSCAR PRESTAMOS</h3>
<form action="../controlador/index.php" method="POST">
    <input type="hidden" name="action" value="buscar_prestamo">
    <label for="buscar">Nombre del amigo/Titulo del juego</label>
    <input type="text" name="buscar" id="buscar" required>
    <input type="submit" name="enviar" value="Enviar">
</form>
<a href="../controlador/index.php?action=prestamos">Volver</a>
<?php require_once("../vista/fin.html");?>