<?php require_once("../vista/inicio.html"); ?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_amigos.html");
        ?>
</div>
<div class="form">
    <h3>Modificar Amigo</h3>
    <form action="../controlador/index.php" method="POST">
        <input type="hidden" name="action" value="modificar_amigo">
        <input type="hidden" name="id" value="<?php echo $amigo->__get("id");?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" value="<?php echo $amigo->__get("nombre");?>" required>
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" name="apellidos" id="apellidos" value="<?php echo $amigo->__get("apellidos");?>" required>
        <label for="fecha">Fecha Nacimiento:</label><br>
        <input type="date" name="fecha" id="fecha" value="<?php echo $amigo->__get("fecha"); ?>" required>
        <?php
            if($_SESSION["admin"]==1){
                echo '<label for="usuario">Usuario:</label><br>';
                echo '<select name="usuario" id="usuario" required>';
                foreach($usuarios as $usuario){
                    echo '<option value="'.$usuario->get_id($usuario->__get("nombre")).'"';
                    if($amigo->__get("usuario")==$usuario->__get("id")){
                        echo ' selected';
                    } 
                    echo '>'.$usuario->__get("nombre").'</option>';
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
<?php
    require_once("../vista/fin.html");
?>