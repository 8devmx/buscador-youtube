<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>Buscador</title>
</head>

<body>
  <?php
  // $search = (isset($_GET['search'])) ? $_GET['search'] : "";
  ?>
  <div id="search">
    <form action="index.php">
      <input type="text" name="search" id="fieldSearch">
      <input type="submit" id="btnSearch">
    </form>
  </div>
  <?php
  // $pagination = pagination($result);
  // $pages = $pagination["pages"];
  // $paginationData = $pagination["data"];
  // $consulta =  $query . $paginationData;
  // $result = mysqli_query($enlace, $consulta);
  // $concatParams = ($search != "") ? "&search=" . $search : "";
  ?>
  <!-- <div id="pagination">
    <ul>
      <?php
      // for ($i = 1; $i <= $pages; $i++) {
      ?>
        <li>
          <a href="index.php?page=<?php //echo $i . $concatParams; 
                                  ?>"><?php //echo $i; 
                                      ?></a>
        </li>
      <?php
      // }
      ?>
    </ul>
  </div> -->
  <div id="selectedAllWrapper">
    <span>
      <input type="checkbox" name="selectedAll" id="selectedAll" /> Seleccionar todo
    </span>
    <a href="#" id="deleteItem">Borrar</a>
  </div>
  <div id="results"></div>
  <script src="js/index.js"></script>
</body>

</html>