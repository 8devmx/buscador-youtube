<?php
require_once 'conexion.php';
global $enlace;

if (isset($_POST)) {
  switch ($_POST['function']) {
    case 'deleteItem':
      delete($enlace);
      break;
    case 'data':
      $page = isset($_POST['page']) ? $_POST['page'] : 1;
      data($_POST['search'], $page, $enlace);
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
function data($search, $page, $enlace)
{
  $consulta = "SELECT * FROM usuarios";
  $query = search($search, $consulta);
  $result = mysqli_query($enlace, $query);
  $pagination = pagination($result, $page);
  $array = [
    "attributes" => [
      "total" => $pagination["total"],
      "pages" => $pagination["pages"],
      "page" => $pagination["page"]
    ]
  ];
  $query = $query . $pagination["limit"];
  $result = mysqli_query($enlace, $query);
  while ($row = mysqli_fetch_array($result)) {
    $array["data"][] = [
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

function pagination($result, $page = 1)
{
  $total = $result->num_rows;
  $limit = 5;
  $pages = ceil($total / $limit);
  $start = ($page - 1) * $limit;
  $limit = " LIMIT $start, $limit";
  return [
    "total" => $total,
    "pages" => $pages,
    "page" => $page,
    "limit" => $limit
  ];
}
