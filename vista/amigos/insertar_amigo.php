<?php require_once("../vista/inicio.html");?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_amigos.html");
    ?>
</div>
<div class="form">
    <h3>Insertar Amigo</h3>
    <form action="../controlador/index.php" method="POST">
        <input type="hidden" name="action" value="insertar_amigo">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" required>
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" name="apellidos" id="apellidos" required>
        <label for="fecha">Fecha Nacimiento:</label><br>
        <input type="date" name="fecha" id="fecha" required>
        <?php
            if($_SESSION["admin"]==1){
                echo '<label for="usuario">Usuario:</label><br>';
                echo '<select name="usuario" id="usuario" required>';
                echo '<option value="" selected disabled>--Seleccionar usuario--</option>';
                foreach($usuarios as $usuario){
                    echo '<option value="'.$usuario->get_id($usuario->__get("nombre")).'">'.$usuario->__get("nombre").'</option>';
                }
                echo '</select>';
            }
        ?>
        <div>
            <input type="submit" name="enviar" value="Enviar">
            <a href="../controlador/index.php?action=amigos" class="boton">Volver</a>
        </div>
    </form>
</div>
<?php require_once("../vista/fin.html");?>