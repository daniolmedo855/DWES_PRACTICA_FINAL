<?php
    require_once("../vista/inicio.html");
?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_prestamos.html");
    ?>
</div>
<div class="menu">
    <h2>Prestamos</h2>
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
                    echo "<a href='../controlador/index.php?action=devolver_prestamo&id=".$prestamo["id"]."' class='boton'>Devolver</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
    ?>
    </table>
    <?php
        if(isset($_GET["acc"])){
            if($_GET["acc"] == 1){
                echo '<div class="mensaje"><p style="color:green">Prestamo insertado correctamente</p></div>';
                header("refresh: 2; url= ../controlador/index.php?action=prestamos");
            }
            if($_GET["acc"] == 2){
                echo '<div class="mensaje"><p style="color:green">Prestamo devuelto correctamente</p></div>';
                header("refresh: 2; url= ../controlador/index.php?action=prestamos");
            }
        }
        if(isset($_GET["err"])){
            if($_GET["err"] == 1){
                echo '<div class="mensaje"><p style="color:red">Fecha para el prestamo no valida</p></div>';
                header("refresh: 2; url= ../controlador/index.php?action=prestamos");
            }
        }
    ?>
</div>
<?php
    require_once("../vista/footer.html");
    require_once("../vista/fin.html");
?>