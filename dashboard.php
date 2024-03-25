<?php

// URL à partir de laquelle vous souhaitez récupérer des données
$url = "http://51.91.108.32/newsletters";

// Initialisation de cURL
$curl = curl_init($url);

// Configuration des options de cURL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Ignorer la vérification SSL pour les tests, à éviter en production

// Exécution de la requête et récupération de la réponse
$response = curl_exec($curl);

// Vérification des erreurs cURL
if ($response === false) {
    die("Erreur cURL : " . curl_error($curl));
}

// Fermeture de la session cURL
curl_close($curl);

// Conversion de la réponse JSON en tableau associatif PHP
$data = json_decode($response, true);

// Vérification si la conversion JSON a réussi
if ($data === null) {
    die("Erreur de décodage JSON");
}

// Début du tableau HTML
echo "<table border='1'>";
echo "<tr><th>Clé</th><th>Valeur</th></tr>";

// Parcourir les données et les afficher dans le tableau HTML
foreach ($data as $key => $value) {
    // Vérifier si la valeur est un tableau
    if (is_array($value)) {
        // Si c'est un tableau, convertissez-le en chaîne pour l'afficher
        $value = implode(", ", $value);
    }
    echo "<tr><td>$key</td><td>$value</td></tr>";
}

// Fin du tableau HTML
echo "</table>";

?>

    

  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
</head>
<body>
    
</body>
</html>