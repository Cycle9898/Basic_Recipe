<?php
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

        <?php if (isset($loggedUser)) : ?>
        <div class="d-flex flex-column gap-3">
            <?php foreach (getRecipes($recipes) as $recipe) : ?>
                <article>
                    <h3 class="mb-3"><?php echo $recipe['title']; ?></h3>
                    <p><?php echo $recipe['recipe']; ?></p>
                    <p class="font-italic"><?php echo displayAuthor($recipe['author'], $users); ?></p>
                </article>
                <?php endforeach ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>


</html>