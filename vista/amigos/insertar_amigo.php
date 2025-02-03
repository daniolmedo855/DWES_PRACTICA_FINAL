<?php require_once("../inicio.html");?>
<body>
<?php
    require_once("../header.html");
    require_once("../header_amigos.html");
?>
<form action="../../controlador/index.php" method="POST">
    <input type="hidden" name="action" value="insertar_amigo">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" required>
    <label for="fecha">Fecha Nacimiento:</label>
    <input type="text" name="fecha" id="fecha" required placeholder="dd-mm-aaaa">
    <input type="submit" value="Insertar">
</form>
<a href="../../controlador/index.php?action=amigos">Volver</a>
<?php require_once("../fin.html");?>