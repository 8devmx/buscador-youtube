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
  $search = (isset($_GET['search'])) ? $_GET['search'] : "";
  ?>
  <div id="search">
    <form action="index.php">
      <input type="text" name="search" value="<?php echo $search; ?>">
      <input type="submit">
    </form>
  </div>
  <?php
  require_once 'conexion.php';
  require_once 'functions.php';
  $query = data($search);
  $result = mysqli_query($enlace, $query);
  $pagination = pagination($result);
  $pages = $pagination["pages"];
  $paginationData = $pagination["data"];
  $consulta =  $query . $paginationData;
  $result = mysqli_query($enlace, $consulta);
  $concatParams = ($search != "") ? "&search=" . $search : "";
  ?>
  <div id="pagination">
    <ul>
      <?php
      for ($i = 1; $i <= $pages; $i++) {
      ?>
        <li>
          <a href="index.php?page=<?php echo $i . $concatParams; ?>"><?php echo $i; ?></a>
        </li>
      <?php
      }
      ?>
    </ul>
  </div>
  <div id="results">
    <?php
    $items = "";
    while ($row = mysqli_fetch_array($result)) {
      $nombre = $row['nombre'];
      $correo = $row['correo'];
      $telefono = $row['telefono'];
      $items .= "
        <div class='item'>
          <h2>$nombre</h2>
          <h3>$correo</h3>
          <p>$telefono</p>
        </div>
      ";
    }
    echo $items;
    ?>
  </div>
</body>

</html>