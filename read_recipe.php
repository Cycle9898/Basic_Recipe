<?php
session_start();

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
    <title>Site de recettes - <?php echo($recipe['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Header -->
        <?php require_once(__DIR__ . '/components/header.php'); ?>

        <h1 class="text-center mt-5 mb-5"><?php echo($recipe['title']); ?></h1>

        <div class="d-flex flex-column gap-5">
            <article>
                <?php echo($recipe['recipe']); ?>
            </article>

            <aside>
                <p class="fst-italic">Recette ajoutée par <?php echo($recipe['author']); ?></p>
            </aside>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>
</html>