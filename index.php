<?php

// phpinfo();
const API_URL = "https://whenisthenextmcufilm.com/api";

# Hacemos la llamada a la API, para eso debemos inicializar curl
$curl_handler = curl_init(API_URL);
// Indicar que queremos recibir el resultado de la peticion y no
// mostrarlo en pantalla
curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_handler, CURLOPT_SSL_VERIFYPEER, false);
/* Ejecutar la peticion
y guardamos el resultado  en la variable $response */
// una alternativa seria $response = file_get_contents(API_URL)

$response = curl_exec($curl_handler);
if ($response === false) {
    echo 'Error: ' . curl_error($curl_handler);
}

// $info = curl_getinfo($curl_handler);
// print_r($info);

$data = json_decode($response, true);

curl_close($curl_handler);

?>
<head>
    <title>Proxima Peli de Marvel</title>
    <!-- Centered viewport -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    >
</head>
<h1>
    La próxima peli de Marvel será:
</h1>

<main>


    <img 
    src="<?= $data["poster_url"]; ?>" 
    alt="<?= "Imagen de " . $data["title"]; ?>"
    width=250
    style="border-radius: 16px; margin-right: 30px;"
    >
    <hgroup>
        <h2><?=$data["title"]; ?></h2>
        <h5><?="Se estrena en " . $data["days_until"] . " días"; ?></h5>
        <p><?="Fecha de lanzamiento: " . $data["release_date"]; ?></p>
        <p><?="La siguiente peli es:<br> <b>" . $data["following_production"]["title"] . "</b>" ?></p>
    </hgroup>

</main>

<footer>
    <h5>by Alike &reg; 2024</h5>
</footer>

<style>
    :root {
        color-scheme: ligth dark;
    }
    body {
        display: grid;
        place-content: center;
    }

    main {
        display: flex;
        flex-direction: row;        
    }

    hgroup {
        align-self: center;
    }
    footer {
        display: grid;
        place-content: center;
    }

    

</style> 