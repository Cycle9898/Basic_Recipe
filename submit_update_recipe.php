<?php
session_start();

require_once(__DIR__ . '/utils/isConnect.php');
require_once(__DIR__ . '/database/credentials.php');
require_once(__DIR__ . '/database/dbConnect.php');

$postData = $_POST;

// Form validations
if (
    !isset($postData['id'])
    || !is_numeric($postData['id'])
    || empty($postData['title'])
    || empty($postData['recipe'])
    || trim(strip_tags($postData['title'])) === ''
    || trim(strip_tags($postData['recipe'])) === ''
) {
    echo 'Il manque des informations pour permettre la soumission de ce formulaire.';
    echo '<br />';
    echo '<br />';
    echo "<a href='update_recipe.php?id={$postData['id']}'>Revenir à l'édition de la recette</a>";
    return;
}

$id = (int)$postData['id'];
$title = trim(strip_tags($postData['title']));
$recipe = trim(strip_tags($postData['recipe']));

// Update in DB
$updateRecipe = $sqlClient->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :id');
$updateRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
    'id' => $id
]);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Enregistrement des modifications de la recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Header -->
        <?php require_once(__DIR__ . '/components/header.php'); ?>

        <h1 class="text-center mt-5 mb-5">Recette modifiée avec succès !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?></h5>
                <p class="card-text"><span class="fw-bold">Email</span> : <?php echo $_SESSION['LOGGED_USER']['email']; ?></p>
                <p class="card-text"><span class="fw-bold">Recette</span> : <?php echo $recipe; ?></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>

</html>