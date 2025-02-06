<?php require_once("../vista/inicio.html");?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_usuarios.html");
    ?>
</div>
<div class="menu">
    <h2>Usuarios</h2>
    <?php
        if(isset($_GET["acc"])){
            if($_GET["acc"] == 1){
                echo '<p style="color:green">usuario insertado correctamente</p>';
                header("refresh: 2; url= ../controlador/index.php?action=usuarios");
            }
            if($_GET["acc"] == 2){
                echo '<p style="color:green">usuario modificado correctamente</p>';
                header("refresh: 2; url= ../controlador/index.php?action=usuarios");
            }
        }
        if(isset($_GET["err"])){
            if($_GET["err"] == 1){
                echo '<p style="color:red">Nombre no Disponible</p>';
                header("refresh: 2; url= ../controlador/index.php?action=usuarios");
            }
        }
    ?>
    <table>
        <?php
            if(count($usuarios) == 0){
                echo '<tr><td>No hay usuarios</td></tr>';
            } else {
                echo "<tr><th>ID</th><th>Nombre</th><th>Contraseña</th></tr>";
            }
        ?>
            <?php
                foreach($usuarios as $usuario){
                    echo '<tr>';
                    echo '<td>'.$usuario->get_id($usuario->__get("nombre")).'</td>';
                    echo '<td>'.$usuario->__get("nombre").'</td>';
                    echo '<td>'.modificar_contrasenia($usuario->__get("contrasenia")).'</td>';
                    echo '<td><a href="../controlador/index.php?action=modificar_usuario&id='.$usuario->__get("id").'" class="boton">Modificar</a></td>';
                    echo '</tr>';
                }
            ?>
    </table>
    
</div>
<?php require_once("../vista/fin.html");?>