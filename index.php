<!DOCTYPE html>
<html>
<head>
    <title>Clientes</title>
    <script type="text/javascript" src="https://raw.githubusercontent.com/vic/jwmscript/master/core/src/main/resources/com/jwmsolutions/jwmscript/applet.js"></script>
    <script type="text/javascript">
        JWMScript({
            archive: "https://raw.githubusercontent.com/vborja/jwmscript-example/master/signed/jwmscript-core-0.0.1.jar",
            types: ["text/java", "text/beanshell"],
            setup: function(scripting) {
                alert("Setting up JWMScript");
                scripting.addClassPath("https://raw.githubusercontent.com/vborja/jwmscript-example/master/signed/bsh-2.0b4.jar");
                var interpreter = scripting.wrapClass("bsh.Interpreter").newInstance();
                interpreter.set("jwmscript", scripting.getHandle());
                return function(script) {
                    try {
                        interpreter.eval(script.innerHTML);
                    } catch (e) {
                        console.error("Error executing script:", e);
                    }
                };
            }
        });
    </script>
    <script type="text/beanshell">
        jwmscript.alert("Hello from BeanShell");
    </script>
</head>
<body>
    <h1>Datos de Clientes</h1>
    <?php
    // Conexión a la base de datos MySQL
    $con = new mysqli("192.168.189.140", "root", "kevin", "usuarios");

    // Verificar la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    // Preparar y ejecutar la consulta SQL
    $query = "SELECT * FROM clientes";
    $result = $con->query($query);

    // Mostrar los datos obtenidos en el HTML
    if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Username</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['correo']); ?></td>
                    <td><?php echo htmlspecialchars($row['contra']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif;

    // Cerrar la conexión a la base de datos
    $con->close();
    ?>
</body>
</html>
