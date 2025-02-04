<?php
    require_once("../vista/inicio.html");
    ?>
<body>
<?php
    require_once("../vista/header.html");
    require_once("header_amigos.html");
?>
<form action="../controlador/index.php" method="POST">
    <input type="hidden" name="action" value="modificar_amigo">
    <input type="hidden" name="id" value="<?php echo $amigo->__get("id");?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $amigo->__get("nombre");?>" required>
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" value="<?php echo $amigo->__get("apellidos");?>" required>
    <label for="fecha">Fecha Nacimiento:</label>
    <input type="text" name="fecha" id="fecha" value="<?php echo cambiar_fecha($amigo->__get("fecha"));?>" required>
    <input type="submit" name="enviar" value="Enviar">
</form>
<a href="../controlador/index.php?action=amigos">Volver</a>
<?php
    require_once("../vista/fin.html");
?>