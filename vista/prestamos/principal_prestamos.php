<?php
    require_once("../vista/inicio.html");
?>
<body>
<?php
    require_once("../vista/header.html");
    require_once("header_prestamos.html");
?>
<h2>PRESTAMOS</h2>
<table>
    <?php
        if(count($prestamos) == 0){
            echo "<tr><td>No hay prestamos</td></tr>";
        } else {
            echo "<tr><th>AMIGO</th><th>JUEGO</th><th></th><th>FECHA</th><th>DEVUELTO</th></th><th></th></tr>";
        }

        foreach($prestamos as $prestamo){
            echo "<tr>";
            echo "<td>".$prestamo["amigo"]."</td>";
            echo "<td>".$prestamo["titulo"]."</td>";
            echo "<td><img src='".$prestamo["imagen"]."'</td>";
            echo "<td>".cambiar_fecha($prestamo["fecha"])."</td>";

            echo "<td>";
            if($prestamo["devuelto"]){
                echo "Si";
            } else {
                echo "No";
            }
            echo "</td>";
            echo "<td>";
            if($prestamo["devuelto"] == 0){
                echo "<a href='../controlador/index.php?action=devolver_prestamo&id=".$prestamo["id"]."'>Devolver</a>";
            } else {
                echo "Devolver";
            }
            echo "</td>";
            echo "</tr>";
        }
?>
</table>
<?php
    if(isset($_GET["acc"])){
        if($_GET["acc"] == 1){
            echo '<p style="color:green">Prestamo insertado correctamente</p>';
            header("refresh: 2; url= ../controlador/index.php?action=prestamos");
        }
        if($_GET["acc"] == 2){
            echo '<p style="color:green">Prestamo devuelto correctamente</p>';
            header("refresh: 2; url= ../controlador/index.php?action=prestamos");
        }
    }
    if(isset($_GET["error"])){
        if($_GET["error"] == 1){
            echo '<p style="color:red">Fecha para el prestamo no valida</p>';
            header("refresh: 2; url= ../controlador/index.php?action=prestamos");
        }
    }
?>
</body>
<?php
    require_once("../vista/fin.html");
?>