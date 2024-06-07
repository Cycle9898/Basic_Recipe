<?php
session_start();

require_once(__DIR__ . '/utils/isConnect.php');
require_once(__DIR__ . '/database/credentials.php');
require_once(__DIR__ . '/database/dbConnect.php');

$getData = $_GET;

// Validations
if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo 'Cette recette n\'existe pas.';
    echo '<br />';
    echo '<br />';
    echo '<a href=\'/\'>Revenir à la page d\'accueil</a>';
    return;
}

// Fetch in DB
$retrieveRecipeStatement = $sqlClient->prepare('SELECT title FROM recipes WHERE recipe_id = :id');
$retrieveRecipeStatement->execute([
    'id' => (int)$getData['id']
]);
$recipeTitle = $retrieveRecipeStatement->fetch();

if (!$recipeTitle) {
    echo 'Cette recette n\'existe pas.';
    echo '<br />';
    echo '<br />';
    echo '<a href=\'/\'>Revenir à la page d\'accueil</a>';
    return;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Suppression d'une recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Header -->
        <?php require_once(__DIR__ . '/components/header.php'); ?>

        <h1 class="text-center mt-5 mb-5">Suppression de la recette: <?php echo ($recipeTitle[0]); ?> ?</h1>

        <form action="submit_delete_recipe.php" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $getData['id']; ?>">
            </div>

            <p>Attention: la suppression de la recette est définitive !</p>

            <button type="submit" class="btn btn-danger m-auto d-block">Confirmer</button>
        </form>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>

</html>