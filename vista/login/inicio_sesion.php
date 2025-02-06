<?php require_once("../vista/inicio.html");?>
<body>
    <div class="inicio_sesion">
        <div>
            <h2>Inicio de sesion</h2>
            <form action="../controlador/index.php" method="POST">
                <label for="nombre">Nombre:</label><br>
                <input type="text" name="nombre" id="nombre"
                <?php
                    if(isset($_COOKIE["usuario"])){
                        echo ' value="'.$_COOKIE["usuario"].'"';
                    }
                ?>required>

                <label for="contrasenia">Contraseña:</label><br>
                <input type="password" name="contraseña" id="contrasenia" required>
                <div>
                    <label for="recordar">Recordar</label>
                    <input type="checkbox" name="recordar" id="recordar"<?php 
                        if(isset($_COOKIE["usuario"])){
                            if($_COOKIE["usuario"] != ""){
                                echo ' checked';
                            }
                        }
                        ?>
                        ><br>
                    <?php
                        if(isset($_GET["err"])){
                            if($_GET["err"] == 1){
                                echo '<p style="color:red">Usuario o Contraseña incorrectos</p>';
                            }
                            header("refresh: 2; url= index.php");
                        }
                    ?>
                </div>
                
                <input type="submit" name="action" value="Iniciar" class="boton">
            </form>
        </div>
    </div>
        
</body>
<?php require_once("../vista/fin.html");?>