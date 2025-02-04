<?php require_once("../vista/inicio.html");?>
<body>
<?php
    require_once("../vista/header.html");
    require_once("header_juegos.html");
?>
<form action="../controlador/index.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="insertar_juego">
    <label for="titulo">Titulo:</label>
    <input type="text" name="titulo" id="titulo" required>
    <label for="plataforma">Plataforma:</label>
    <input type="text" name="plataforma" id="plataforma" required>
    <label for="anio">Año</label>
    <input type="text" name="anio" id="anio" required>
    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" id="imagen" required accept="image/*">
    <input type="submit" name="enviar" value="Enviar">
</form>
<a href="../controlador/index.php?action=juegos">Volver</a>
<?php require_once("../vista/fin.html");?>
