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
$retrieveRecipeStatement = $sqlClient->prepare('SELECT r.*, c.comment_id, c.comment, c.user_id, DATE_FORMAT(c.created_at, "%d/%m/%Y") as comment_date, c.review, u.full_name
FROM recipes r 
LEFT JOIN comments c on c.recipe_id = r.recipe_id
LEFT JOIN users u ON u.user_id = c.user_id
WHERE r.recipe_id = :id
ORDER BY comment_date DESC');
$retrieveRecipeStatement->execute([
    'id' => (int)$getData['id']
]);
$recipeAndComments = $retrieveRecipeStatement->fetchAll(PDO::FETCH_ASSOC);

if ($recipeAndComments === []) {
    echo 'Cette recette n\'existe pas.';
    echo '<br />';
    echo '<br />';
    echo '<a href=\'/\'>Revenir à la page d\'accueil</a>';
    return;
}

$retrieveAverageRatingStatement = $sqlClient->prepare('SELECT ROUND(AVG(c.review), 1) AS rating
FROM recipes r 
LEFT JOIN comments c on c.recipe_id = r.recipe_id
WHERE r.recipe_id = :id');
$retrieveAverageRatingStatement->execute([
    'id' => (int)$getData['id']
]);
$averageRating = $retrieveAverageRatingStatement->fetch();

$recipe = [
    'recipe_id' => (int)$recipeAndComments[0]['recipe_id'],
    'title' => $recipeAndComments[0]['title'],
    'recipe' => $recipeAndComments[0]['recipe'],
    'author' => $recipeAndComments[0]['author'],
    'comments' => [],
    'rating' => $averageRating[0]
];

foreach ($recipeAndComments as $comment) {
    if (!is_null($comment['comment_id'])) {
        $recipe['comments'][] = [
            'comment_id' => $comment['comment_id'],
            'comment' => $comment['comment'],
            'user_id' => (int) $comment['user_id'],
            'full_name' => $comment['full_name'],
            'created_at' => $comment['comment_date'],
            'review' => (int)$comment['review']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - <?php echo ($recipe['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Header -->
        <?php require_once(__DIR__ . '/components/header.php'); ?>

        <h1 class="text-center mt-5 mb-5"><?php echo ($recipe['title']); ?></h1>

        <div class="d-flex flex-column gap-5">
            <article>
                <?php echo ($recipe['recipe']); ?>
            </article>

            <aside>
                <p class="fst-italic">Recette ajoutée par <?php echo ($recipe['author']); ?></p>

                <?php if ($recipe['rating'] !== null) : ?>
                    <p class="fw-bold">Évaluée par la communauté à <?php echo ($recipe['rating']); ?> / 5</p>
                <?php else : ?>
                    <p class="fw-bold">Aucune évaluation</p>
                <?php endif; ?>
            </aside>
        </div>

        <hr />

        <h2 class="mb-3">Commentaires</h2>

        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <?php require_once(__DIR__ . '/components/create_comment.php'); ?>

            <hr />
        <?php endif; ?>

        <div>
            <?php if ($recipe['comments'] !== []) : ?>
                <div class="row">
                    <?php foreach ($recipe['comments'] as $comment) : ?>
                        <div class="comment">
                            <p class="fw-bold">Le <?php echo $comment['created_at']; ?>:</p>
                            <p>(<span class="fw-bold">Note: <?php echo $comment['review']; ?>/5</span>) <?php echo $comment['comment']; ?></p>
                            <p class="fst-italic">(Posté par <?php echo $comment['full_name']; ?>)</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="row">
                    <p>Aucun commentaire</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once(__DIR__ . '/components/footer.php'); ?>
</body>

</html>