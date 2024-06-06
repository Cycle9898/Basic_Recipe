<?php
session_start();
require_once(__DIR__ . '/database/credentials.php');
require_once(__DIR__ . '/database/dbConnect.php');
require_once(__DIR__ . '/utils/variables.php');
require_once(__DIR__ . '/utils/functions.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Header -->
        <?php require_once(__DIR__ . '/components/header.php'); ?>

        <h1 class="text-center mt-5 mb-5">Site de recettes</h1>

        <!-- Login form -->
        <?php require_once(__DIR__ . '/components/login.php'); ?>

        <div class="d-flex flex-column gap-3">
            <?php foreach (getRecipes($recipes) as $recipe) : ?>
                <article>
                    <h3 class="mb-3"><a href="read_recipe.php?id=<?php echo($recipe['recipe_id']); ?>"><?php echo $recipe['title']; ?></a></h3>

                    <p><?php echo $recipe['recipe']; ?></p>

                    <p class="fst-italic"><?php echo displayAuthor($recipe['author'], $users); ?></p>

                    <?php if (isset($_SESSION['LOGGED_USER']) && $recipe['author'] === $_SESSION['LOGGED_USER']['email']) : ?>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item"><a class="link-warning" href="update_recipe.php?id=<?php echo($recipe['recipe_id']); ?>">Éditer la recette</a></li>

                        <li class="list-group-item"><a class="link-danger" href="delete_recipe.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer la recette</a></li>
                    </ul>
                <?php endif; ?>

                </article>
                <?php endforeach ?>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>
</html>