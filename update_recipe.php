<?php
session_start();

require_once(__DIR__ . '/utils/isConnect.php');
require_once(__DIR__ . '/database/credentials.php');
require_once(__DIR__ . '/database/dbConnect.php');

$getData = $_GET;

// Validations
if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo 'Identifiant incorrect, impossible de trouver la recette à modifier.';
    echo '<br />';
    echo '<br />';
    echo '<a href=\'/\'>Revenir à la page d\'accueil</a>';
    return;
}

// Fetch in DB
$retrieveRecipeStatement = $sqlClient->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$retrieveRecipeStatement->execute([
    'id' => (int)$getData['id']
]);
$recipe = $retrieveRecipeStatement->fetch();

if (!$recipe) {
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
    <title>Site de recettes - Mise à jour d'une recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Header -->
        <?php require_once(__DIR__ . '/components/header.php'); ?>

        <h1 class="text-center mt-5 mb-5">Mettre à jour <?php echo ($recipe['title']); ?></h1>

        <form action="submit_update_recipe.php" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo ($getData['id']); ?>">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>

                <input type="text" class="form-control" id="title" name="title" placeholder="Choisissiez le titre de votre recette" value="<?php echo ($recipe['title']); ?>">
            </div>

            <div class="mb-3">
                <label for="recipe" class="form-label">Description de la recette</label>

                <textarea class="form-control" placeholder="Détails de la recette" id="recipe" name="recipe"><?php echo $recipe['recipe']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary m-auto d-block">Mettre à jour la recette</button>
        </form>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>

</html>