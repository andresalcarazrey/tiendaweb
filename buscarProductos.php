<?php

// Variables
$servername = "localhost";
$username = "php";
$password = "1234";
$dbname = "pruebas";
$busqueda = $_POST["ftext"];
$tipoBusqueda = $_POST["opcion"];
$sql = "SELECT * FROM productos WHERE ";

// Establecer conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: ".$conn->connect_error);
}

// Consulta para realizar la búsqueda en la base de datos
switch ($tipoBusqueda){
  case "ocod":
    $sql = $sql."cod = $busqueda;";
  break;
  case "odesc":
    $sql = $sql."descripcion like '%$busqueda%';";
  break;
  case "opre":
    $sql = $sql."precio <= $busqueda;";
  break;
  case "ostock":
    $sql = $sql."stock <= $busqueda;";
  break;
  default:
    echo "Se ha producido un error durante la búsqueda.";
}

$resultado = $conn->query($sql);
//$resultado = mysqli_query($conn, $sql);

// Consulta para realizar la busqueda en la base de datos
if ($resultado->num_rows > 0) {
  // Salida de datos por cada fila
  while($row = $resultado->fetch_assoc()) {
    echo "- Código: ".$row["cod"].", Descripción: ".$row["descripcion"].", Precio: ".$row["precio"].", Stock: ".$row["stock"]."<br>";
  }
}else{
  echo "No se han encontrado resultados.";
}

$conn->close();

?>
