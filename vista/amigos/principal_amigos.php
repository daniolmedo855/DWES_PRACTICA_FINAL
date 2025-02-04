<?php require_once("../vista/inicio.html");?>
<body>
<?php
    require_once("../vista/header.html");
    require_once("header_amigos.html");
?>
<h2>Amigos</h2>
<table>
    <?php
        if(count($amigos) == 0){
            echo '<tr><td>No hay amigos</td></tr>';
        } else {
            echo "<tr><th>Nombre</th><th>Apellido</th><th>Fecha Nacimiento</th></tr>";
        }
    ?>
        <?php
            foreach($amigos as $amigo){
                echo '<tr>';
                echo '<td>'.$amigo->__get("nombre").'</td>';
                echo '<td>'.$amigo->__get("apellidos").'</td>';
                echo '<td>'.cambiar_fecha($amigo->__get("fecha")).'</td>';
                echo '<td><a href="../controlador/index.php?action=modificar_amigo&id='.$amigo->__get("id").'">Modificar</a></td>';
                echo '</tr>';
            }
        ?>
</table>
<?php
    if(isset($_GET["acc"])){
        if($_GET["acc"] == 1){
            echo '<p style="color:green">Amigo insertado correctamente</p>';
            header("refresh: 2; url= ../controlador/index.php?action=amigos");
        }
    }
    if(isset($_GET["err"])){
        if($_GET["err"] == 1){
            echo '<p style="color:red">Fecha Incorrecto</p>';
            header("refresh: 2; url= ../controlador/index.php?action=amigos");
        }
    }
?>
</body>
<?php require_once("../vista/fin.html");?>