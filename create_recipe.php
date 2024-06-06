<?php
session_start();

require_once(__DIR__ . '/utils/isConnect.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Ajout d'une recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Header -->
        <?php require_once(__DIR__ . '/components/header.php'); ?>

        <h1 class="text-center mt-5 mb-5">Ajout d'une recette</h1>

        <form action="submit_create_recipe.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>

                <input type="text" class="form-control" id="title" name="title" placeholder="Choisissiez le titre de votre recette">
            </div>

            <div class="mb-3">
                <label for="recipe" class="form-label">Description de la recette</label>

                <textarea class="form-control" placeholder="Détails de la recette" id="recipe" name="recipe"></textarea>
            </div>

            <button type="submit" class="btn btn-primary m-auto d-block">Soumettre la recette</button>
        </form>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>
</html>