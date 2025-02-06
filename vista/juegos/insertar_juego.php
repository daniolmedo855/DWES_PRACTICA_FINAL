<?php require_once("../vista/inicio.html");?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_juegos.html");
    ?>
</div>
<div class="form">
    <h3>Insertar Juego</h3>
    <form action="../controlador/index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="insertar_juego">
        <label for="titulo">Titulo:</label><br>
        <input type="text" name="titulo" id="titulo" required>
        <label for="plataforma">Plataforma:</label><br>
        <input type="text" name="plataforma" id="plataforma" required>
        <label for="anio">Año</label><br>
        <input type="number" name="anio" id="anio" required>
        <label for="imagen">Imagen:</label><br>
        <input type="file" name="imagen" id="imagen" required accept="image/*">
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <a href="../controlador/index.php?action=juegos" class="boton">Volver</a>
        </div>
    </form>
</div>

<?php require_once("../vista/fin.html");?>
