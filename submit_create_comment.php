<?php
session_start();

require_once(__DIR__ . '/utils/isConnect.php');
require_once(__DIR__ . '/database/credentials.php');
require_once(__DIR__ . '/database/dbConnect.php');

$postData = $_POST;

if (
    !isset($postData['comment'])
    || !isset($postData['recipe_id'])
    || !is_numeric($postData['recipe_id'])
) {
    echo 'Le commentaire est invalide.';
    echo '<br />';
    echo '<br />';
    echo "<a href='/'>Revenir à la page d'accueil</a>";
    return;
}

$comment = trim(strip_tags($postData['comment']));
$recipeId = (int)$postData['recipe_id'];

if ($comment === '') {
    echo 'votre commentaire ne peut pas être vide !';
    echo '<br />';
    echo '<br />';
    echo "<a href='/read_recipe.php?id={$recipeId}'>Revenir à la page de la recette</a>";
    return;
}

$saveComment = $sqlClient->prepare('INSERT INTO comments (comment, recipe_id, user_id) VALUES (:comment, :recipe_id, :user_id)');
$saveComment->execute([
    'comment' => $comment,
    'recipe_id' => $recipeId,
    'user_id' => $_SESSION['LOGGED_USER']['user_id']
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

        <h1 class="text-center mt-5 mb-5">Commentaire sauvegardé avec succès !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Votre commentaire:</h5>

                <p class="card-text"><?php echo $comment; ?></p>
            </div>
        </div>
        <a href="/read_recipe.php?id=<?php echo $recipeId; ?>">Revenir à la page de la recette</a>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>

</html>