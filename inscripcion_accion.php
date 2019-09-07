<?php

//Esta parte se encarga de subir el skin
$direccion_objetivo = "uploads/";
$se_carga = 1;
$archivo_objetivo = $direccion_objetivo . basename($_FILES["fileToUpload"]["name"]);
$extension_archivo = strtolower(pathinfo($archivo_objetivo,PATHINFO_EXTENSION));
$nombre_archivo = strtolower(pathinfo($archivo_objetivo,PATHINFO_BASENAME));

//verifico tamaño del archivo
//no mas grande que 25M
if($_FILES["fileToUpload"]["size"] > 25600000‬){
    echo "Su archivo es demasiado grande, limite 25Mb";
    $se_carga = 0;
}

if($extension_archivo != "zip" && $extension_archivo != "rar" ){
    echo "solo se permite .zip o .rar";
    $se_carga = 0 ;
}

if($se_carga == 0){
    echo "No se pudo completar la carga";
} 
else
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$archivo_objetivo)){
        echo "El skin se cargo exitosamente " . "Skin: " . basename($_FILES["fileToUpload"]["name"]);
    }
    else
    {
        echo "Hubo un error al cargar tu registro, comunicate con un administrador para solucionar tu inconveniente"; 
        echo "Error Code: " . $_FILES["fileToUpload"]["error"];       
        //php.ini
        //; Maximum allowed size for uploaded files.
        //http://php.net/upload-max-filesize
        //upload_max_filesize=25M

    }
}


//esta parte se encarga de los otros datos
$s = "localhost";
$bd = "ils";
$u= "root";
$p = "";

$conexion = new mysqli ($s,$u,$p,$bd);

//if($conexion->connect_errno){
 //   echo "no conectado";
//}
//else {
 //   echo "conectado";
//}

$nombre =$_POST['nombre'];
$apellido =$_POST['apellido'];
$numero =$_POST['numero'];
$guid =$_POST['guid'];
$twitter =$_POST['twitter'];
$instagram =$_POST['instagram'];
$discord =$_POST['discord'];
$car_name = "PuntoAbarthCompetizione";

//esto carga la tabla drivers con toda la data
$sql = "INSERT INTO ils.drivers(driver_name,driver_surname,guid_id,twitter,instagram,discord,pref_number) VALUES ('$nombre','$apellido',$guid,'$twitter','$instagram','$discord',$numero)";
//echo "</br>";
//echo $sql;
//echo "</br>";

if ($conexion->query($sql) === TRUE) {
    echo "Datos guardados...";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

//esto de aca carga la tabla campeonatos

$sqlchamp = "INSERT INTO ils.championships(guid_id,car_name,skin_name) VALUES ($guid,'$car_name','$nombre_archivo')";
//echo "</br>";
//echo $sqlchamp;
//echo "</br>";

if ($conexion->query($sqlchamp) === TRUE) {
    echo "Registros al campeonato guardado...";
} else {
    echo "Error: " . $sqlchamp . "<br>" . $conexion->error;
}

$conexion->close();
