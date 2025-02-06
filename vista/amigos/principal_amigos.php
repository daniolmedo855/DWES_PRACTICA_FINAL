<?php require_once("../vista/inicio.html");?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_amigos.html");
    ?>
</div>
<div class="menu">
    <h2>Amigos</h2>
    <?php
        if(isset($_GET["acc"])){
            if($_GET["acc"] == 1){
                echo '<p style="color:green">Amigo insertado correctamente</p>';
                header("refresh: 2; url= ../controlador/index.php?action=amigos");
            }
            if($_GET["acc"] == 2){
                echo '<p style="color:green">Amigo modificado correctamente</p>';
                header("refresh: 2; url= ../controlador/index.php?action=amigos");
            }
        }
        if(isset($_GET["err"])){
            if($_GET["err"] == 1){
                echo '<p style="color:red">Fecha no Valida</p>';
                header("refresh: 2; url= ../controlador/index.php?action=amigos");
            }
        }
    ?>
    <table>
        <?php
            if(count($amigos) == 0){
                echo '<tr><td>No hay amigos</td></tr>';
            } else {
                echo "<tr><th>Nombre</th><th>Apellido</th><th>Fecha Nacimiento</th>";
                if(isset($_SESSION["admin"])){
                    echo "<th>Dueño</th>";
                }
                echo"</tr>";
            }
        ?>
            <?php
                foreach($amigos as $amigo){
                    echo '<tr>';
                    echo '<td>'.$amigo->__get("nombre").'</td>';
                    echo '<td>'.$amigo->__get("apellidos").'</td>';
                    echo '<td>'.cambiar_fecha($amigo->__get("fecha")).'</td>';
                    if($_SESSION["admin"]==1){
                        echo '<td>'.$bd_usuarios->get_nombre($amigo->__get("usuario")).'</td>';
                    }
                    echo '<td><a href="../controlador/index.php?action=modificar_amigo&id='.$amigo->__get("id").'" class="boton">Modificar</a></td>';
                    echo '</tr>';
                }
            ?>
    </table>
    
</div>
<?php require_once("../vista/fin.html");?>