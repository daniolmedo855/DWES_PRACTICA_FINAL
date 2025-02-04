<?php require_once("../vista/inicio.html");?>
<body>
<?php
    require_once("../vista/header.html");
    require_once("header_prestamos.html");
?>
<form action="../controlador/index.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="insertar_prestamo">
    <label for="amigo">Amigo:</label>
    <select name="amigo" id="amigo" required>
        <option value="" selected disabled>--Seleccionar amigo--</option>
        <?php
            foreach($amigos as $amigo){
                echo "<option value='".$amigo->__get("id")."'>".$amigo->__get("nombre")." ".$amigo->__get("apellidos")."</option>";
            }
        ?>
    </select>
    <label for="juego">Juego</label>
    <select name="juego" id="juego" required>
        <option value="" selected disabled>--Seleccionar juego--</option>
        <?php
            foreach($juegos as $juego){
                echo "<option value='".$juego["id"]."'>".$juego["titulo"]."</option>";
            }
        ?>
    </select>
    <label for="fecha">Fecha de devolucion:</label>
    <input type="date" name="fecha" id="fecha" required>
    <input type="submit" name="enviar" value="Enviar">
</form>
<a href="../controlador/index.php?action=prestamos">Volver</a>
<?php require_once("../vista/fin.html");?>