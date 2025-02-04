<?php
    require_once("../vista/inicio.html");
    ?>
<body>
<?php
    require_once("../vista/header.html");
    require_once("header_juegos.html");
?>
<form action="../controlador/index.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="modificar_juego">
    <input type="hidden" name="id" value="<?php echo $juego->__get("id");?>">
    <label for="titulo">Titulo:</label>
    <input type="text" name="titulo" id="titulo" value="<?php echo $juego->__get("titulo");?>" required>
    <label for="plataforma">Plataforma:</label>
    <input type="text" name="plataforma" id="plataforma" value="<?php echo $juego->__get("plataforma");?>" required>
    <label for="anio">Año</label>
    <input type="number" name="anio" id="anio" value="<?php echo $juego->__get("anio");?>" required>
    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" id="imagen" accept="image/*">
    <input type="submit" name="enviar" value="Enviar">
</form>
<a href="../controlador/index.php?action=juegos">Volver</a>
<?php
    require_once("../vista/fin.html");
?>