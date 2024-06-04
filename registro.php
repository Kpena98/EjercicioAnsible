<?php 

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$username = $_POST['username'];
$contra = $_POST['contra'];

$con = mysqli_connect("192.168.189.140:3306","root","kevin","usuarios");
$query = "INSERT INTO clientes (username, nombre, correo, contra) VALUES ('$username', '$nombre', '$correo', '$pass')";

if($con){
    $result = mysqli_query($con, $query);
    if($result){
        echo'<script type="text/javascript">
        alert("Registro Correcto");
        window.location.href="index.html";
        </script>';
    }else{
        echo'<script type="text/javascript">
        alert("Algo salio mal :/");
        window.location.href="registro.html";
        </script>';
    }
}else{
    echo "no conectado bro..";
}

?>
