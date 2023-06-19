<?php
function data($search)
{
  $consulta = "SELECT * FROM usuarios";
  $query = search($search, $consulta);
  return $query;
}

function search($search, $consulta)
{
  $filter = "";
  if ($search && strlen($search) > 3) {
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