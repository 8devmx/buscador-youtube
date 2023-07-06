<?php
require_once 'conexion.php';
global $enlace;

if (isset($_POST)) {
  switch ($_POST['function']) {
    case 'deleteItem':
      delete($enlace);
      break;
    case 'data':
      data($_POST['search'], $enlace);
      break;
  }
}

function delete($enlace)
{
  $item = $_POST["itemsChecked"];
  $consulta = "DELETE FROM usuarios WHERE id IN ($item)";
  $result = mysqli_query($enlace, $consulta);
  $response = [
    "text" => "No se ha eliminado",
    "status" => "error"
  ];
  if ($result == 1) {
    $response = [
      "text" => "Se ha eliminado correctamente",
      "status" => "success"
    ];
  }
  echo json_encode($response);
}
function data($search, $enlace)
{
  $consulta = "SELECT * FROM usuarios";
  $query = search($search, $consulta);
  $result = mysqli_query($enlace, $query);
  $array = [];
  while ($row = mysqli_fetch_array($result)) {
    $array[] = [
      "id" => $row['id'],
      "nombre" => $row['nombre'],
      "correo" => $row['correo'],
      "telefono" => $row['telefono']
    ];
  }
  echo json_encode($array);
}

function search($search, $consulta)
{
  $filter = "";
  if ($search && strlen($search) > 1) {
    $filter = " WHERE nombre like '%$search%'";
    $consulta = $consulta . $filter;
  }
  return $consulta;
}

function pagination($result)
{
  $total = $result->num_rows;
  $limit = 10;
  $pages = ceil($total / $limit);
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }
  $start = ($page - 1) * $limit;
  $pagination = " LIMIT $start, $limit";
  return [
    "pages" => $pages,
    "data" => $pagination
  ];
}
