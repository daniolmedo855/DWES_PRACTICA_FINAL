<?php
    require_once("inicio.html");
    ?>
<body>
<?php
    require_once("header.html");
    require_once("header_amigos.html");
?>
<form action="../controlador/index.php" method="POST">
    <input type="hidden" name="action" value="modificar_amigo">
    <label for="buscar">Buscar:</label>
    <input type="text" name="buscar" id="buscar" required>
    <input type="submit" value="Enviar">
</form>
<a href="index.php?action=amigos">Volver</a>
<?php
    require_once("fin.html");
?>