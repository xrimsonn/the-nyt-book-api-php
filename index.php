<?php
// URL de la API de Best Sellers del New York Times (ruta full-overview.json)
$apiUrl = 'https://api.nytimes.com/svc/books/v3/lists/full-overview.json';

// Parámetros de la solicitud (asegúrate de incluir tu clave de API y la fecha deseada)
$apiKey = 'X8k2AQF58ifQBYmnQWDHy9o2eNoqBoka';
$fecha = date("Y-m-d"); // Cambia la fecha según tus necesidades

// Construye la URL completa con los parámetros
$urlCompleta = "$apiUrl?date=$fecha&api-key=$apiKey";

// Realiza la solicitud GET a la API
$response = file_get_contents($urlCompleta);

// Verifica si la solicitud fue exitosa
if ($response === false) {
  die('Error al obtener la respuesta de la API');
}

// Decodifica la respuesta JSON en un array asociativo
$data = json_decode($response, true);

// Verifica si la decodificación fue exitosa
if ($data === null) {
  die('Error al decodificar la respuesta JSON');
}

foreach ($data['results']['lists'] as $list) {

  foreach ($list['books'] as $book) {
    if (isset($book['book_image'])) {
      echo "Nombre de la lista: " . $list['list_name'] . "<br>";
      echo "Fecha de publicación: " . $list['bestsellers_date'] . "<br>";
      echo '<img src="' . $book['book_image'] . '" alt="Portada del libro"><br>';
      echo "Título: " . $book['title'] . "<br>";
      echo "Autor: " . $book['author'] . "<br>";
      echo "Descripción: " . $book['description'] . "<br>";
    }
    echo "<hr>";
  }
}
?>



<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <title>The NY Times Best Sellers</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css" />
</head>

<body>
  <main class="container">
    <nav aria-label="breadcrumb">
      <ul>
        <li><a href="#">The New York Times</a></li>
        <li><a href="#">Books</a></li>
        <li>Best Sellers</li>
      </ul>
    </nav>
    <article style="margin-top: 0px">
      <p>Hola antonio</p>
    </article>
  </main>
</body>

</html>