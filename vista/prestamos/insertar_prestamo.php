<?php require_once("../vista/inicio.html");?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_prestamos.html");
    ?>
</div>
<div class="form">
    <h3>Insertar Prestamo</h3>
    <form action="../controlador/index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="insertar_prestamo">
        <label for="amigo">Amigo:</label><br>
        <select name="amigo" id="amigo" required>
            <option value="" selected disabled>--Seleccionar amigo--</option>
            <?php
                foreach($amigos as $amigo){
                    echo "<option value='".$amigo->__get("id")."'>".$amigo->__get("nombre")." ".$amigo->__get("apellidos")."</option>";
                }
            ?>
        </select>
        <label for="juego">Juego</label><br>
        <select name="juego" id="juego" required>
            <option value="" selected disabled>--Seleccionar juego--</option>
            <?php
                foreach($juegos as $juego){
                    echo "<option value='".$juego["id"]."'>".$juego["titulo"]."</option>";
                }
            ?>
        </select>
        <label for="fecha">Fecha de devolucion:</label><br>
        <input type="date" name="fecha" id="fecha" required>
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <a href="../controlador/index.php?action=amigos" class="boton">Volver</a>
        </div>
    </form>
</div>

<?php require_once("../vista/fin.html");?>