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
  <div id="search">
    <form action="index.php">
      <input type="text" name="search" id="fieldSearch">
      <input type="submit" id="btnSearch">
    </form>
  </div>
  <div>
    <ul id="paginationWrapper"></ul>
  </div>
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