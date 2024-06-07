<?php
session_start();

require_once(__DIR__ . '/utils/isConnect.php');
require_once(__DIR__ . '/database/credentials.php');
require_once(__DIR__ . '/database/dbConnect.php');
require_once(__DIR__ . '/utils/functions.php');

$postData = $_POST;

if (!isset($postData['id']) || !is_numeric($postData['id'])) {
    echo 'Il faut un identifiant valide pour supprimer une recette.';
    echo '<br />';
    echo '<br />';
    echo '<a href=\'/\'>Revenir à la page d\'accueil</a>';
    return;
}

$deleteRecipe = $sqlClient->prepare('DELETE FROM recipes WHERE recipe_id = :id');
$deleteRecipe->execute([
    'id' => (int)$postData['id']
]);

redirectToUrl('/');
