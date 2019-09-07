<?php 
    
    echo '<html> <a href=http://localhost/ILSprolija/inscripcion.html>Volver.</a> </html> <br>';
        $s = "localhost";
        $bd = "ils";
        $u= "root";
        $p = "";
        $conexion = new mysqli ($s,$u,$p,$bd);
        $sql = "SELECT * FROM ils.drivers INNER JOIN ils.championships ON ils.drivers.guid_id = ils.championships.guid_id";     
    $result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " - Nombre: " . $row["driver_name"]. " Numero: " . $row["pref_number"].  " Nombre del skin: " . $row["skin_name"]."<br>";
    }
} else {
    echo "0 results";
}
$conexion->close();

