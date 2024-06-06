<?php
session_start();

require_once(__DIR__ . '/utils/isConnect.php');
require_once(__DIR__ . '/database/credentials.php');
require_once(__DIR__ . '/database/dbConnect.php');

$postData = $_POST;

// Form validations
if (
    empty($postData['title'])
    || empty($postData['recipe'])
    || trim(strip_tags($postData['title'])) === ''
    || trim(strip_tags($postData['recipe'])) === ''
) {
    echo 'Il faut un titre et une recette pour soumettre le formulaire.';
    echo '<br />';
    echo '<br />';
    echo '<a href=\'/create_recipe.php\'>Revenir à la création de recette</a>';
    return;
}

$title = trim(strip_tags($postData['title']));
$recipe = trim(strip_tags($postData['recipe']));

// Save in DB
$saveRecipe = $sqlClient->prepare('INSERT INTO recipes (title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');
$saveRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'author' => $_SESSION['LOGGED_USER']['email'],
    'is_enabled' => 1
]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Enregistrement de la recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Header -->
        <?php require_once(__DIR__ . '/components/header.php'); ?>

        <h1 class="text-center mt-5 mb-5">Recette ajoutée avec succès !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $title ; ?></h5>
                <p class="card-text"><span class="fw-bold">Email</span> : <?php echo $_SESSION['LOGGED_USER']['email']; ?></p>
                <p class="card-text"><span class="fw-bold">Recette</span> : <?php echo $recipe; ?></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>
</html>