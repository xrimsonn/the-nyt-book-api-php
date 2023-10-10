<?php
$apiUrl = 'https://api.nytimes.com/svc/books/v3/lists/full-overview.json';

$apiKey = 'X8k2AQF58ifQBYmnQWDHy9o2eNoqBoka';
$fecha = date("Y-m-d"); // Cambia la fecha según tus necesidades

$urlCompleta = "$apiUrl?date=$fecha&api-key=$apiKey";

$response = file_get_contents($urlCompleta);

if ($response === false) {
  die('Error al obtener la respuesta de la API');
}

$data = json_decode($response, true);

if ($data === null) {
  die('Error al decodificar la respuesta JSON');
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <title>The NY Times Best Sellers</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
  <link rel="stylesheet" href="./font.css">
</head>

<body>
  <main class="container">
    <nav aria-label="breadcrumb">
      <ul>
        <li><a href="#">Books</a></li>
        <li>Best Sellers</li>
      </ul>
    </nav>
    <hgroup>
      <h1 id="mb">The New York Times Best Sellers</h1>
      <p>By José Antonio Rosales</p>
    </hgroup>
    <div>
  <?php
  $i = 0; // Un contador para llevar un registro de los libros procesados
  foreach ($data['results']['lists'] as $list) {
    foreach ($list['books'] as $book) {
      if (isset($book['book_image'])) {
        // Comienza un nuevo div cada vez que se procesan 3 libros
        if ($i % 3 === 0) {
          echo '<div class="grid">';
        }
        // Abre un nuevo artículo
        echo '<article id="mt">';
        echo '<img src="' . $book['book_image'] . '" alt="Portada del libro">';
        echo '<hgroup>';
        echo '<h3>' . $book['title'] . '</h3>';
        echo '<p>' . $book['author'] . '</p>';
        echo '</hgroup>';
        echo '<p>' . $book['description'] . '</p>';
        echo '<footer>' . $list['list_name'] . '</footer>';
        echo '</article>';
        $i++;
        // Cierra un div después de procesar 3 libros
        if ($i % 3 === 0) {
          echo '</div>';
        }
      }
    }
  }
  
  // Cierra cualquier div restante si no se alcanzan múltiplos de 3
  while ($i % 3 !== 0) {
    echo '<article id="mt" style="visibility: hidden;"></article>';
    $i++;
  }
  ?>
</div>


  </main>
</body>

</html>