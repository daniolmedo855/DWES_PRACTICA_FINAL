<?php
    require_once("../vista/inicio.html");
    ?>
<div>
    <?php
        require_once("../vista/header.php");
        require_once("header_juegos.html");
    ?>
</div>
<div class="menu">
    <h2>Juegos</h2>
    <table>
        <?php
            if(count($juegos) == 0){
                echo "<tr><td>No hay juegos</td></tr>";
            } else {
                echo "<tr><th>JUEGO</th><th>TITULO</th><th>PLATAFORMA</th><th>AÑO DE LANZAMIENTO</th><th></th></th></tr>";
            }
                foreach($juegos as $juego){
                    echo "<tr>";
                    echo "<td><img src='".$juego->__get("imagen")."'</td>";
                    echo "<td>".$juego->__get("titulo")."</td>";
                    echo "<td>".$juego->__get("plataforma")."</td>";
                    echo "<td>".$juego->__get("anio")."</td>";
                    echo '<td><a href="../controlador/index.php?action=modificar_juego&id='.$juego->__get("id").'" class="boton">Modificar</a></td>';
                    echo "</tr>";
                }
    ?>
    </table>
    <?php
        if(isset($_GET["acc"])){
            if($_GET["acc"] == 1){
                echo '<div class="mensaje"><p style="color:green">Juego insertado correctamente</p></div>';
                header("refresh: 2; url= ../controlador/index.php?action=juegos");
            }
            if($_GET["acc"] == 2){
                echo '<div class="mensaje"><p style="color:green">Juego modificado correctamente</p></div>';
                header("refresh: 2; url= ../controlador/index.php?action=juegos");
            }
        }
        if(isset($_GET["err"])){
            if($_GET["err"] == 1){
                echo '<div class="mensaje"><p style="color:red">Fecha no Valida</p></div>';
                header("refresh: 2; url= ../controlador/index.php?action=juegos");
            }
        }
    ?>
</div>
<?php
    require_once("../vista/footer.html");
    require_once("../vista/fin.html");
?>