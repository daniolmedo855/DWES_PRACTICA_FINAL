<body>
    <h1>Inicio de sesion</h1>
    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"<?php
        if(isset($_SESSION["usuario"])){
            echo ' value="'.$_SESSION["usuario"].'"';
        }
    ?>><br>
        <label for="contrasenia">Contrasenia:</label>
        <input type="password" name="contrasenia" id="contrasenia"><br>
        <label for="recordar">Recordar</label>
        <input type="checkbox" name="recordar" id="recordar"<?php if(isset($_SESSION["recordar"])) echo ' checked'; ?>><br>
        <input type="submit" name="action" value="Iniciar sesion"><br>
    </form>
</body>