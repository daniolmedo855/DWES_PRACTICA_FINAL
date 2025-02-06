<div class="header">
    <div>
        <h3>AGENDA PERSONAL</h3>
        <ul>
            <?php
                sesion();
                if($_SESSION["admin"] == true){
                    echo '<li><a href="../controlador/index.php?action=amigos">CONTACTOS</a></li>';
                    echo '<li><a href="../controlador/index.php?action=usuarios">USUARIOS</a></li>';
                } else {
                    echo '<li><a href="../controlador/index.php?action=amigos">AMIGOS</a></li>';
                    echo '<li><a href="../controlador/index.php?action=juegos">JUEGOS</a></li>';
                    echo '<li><a href="../controlador/index.php?action=prestamos">PRESTAMOS</a></li>';
                }
                echo '<li><a href="../controlador/index.php?action=salir">SALIR</a></li>';

            ?>
        </ul>
    </div>
</div>