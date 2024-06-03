<?php
$postData = $_POST;

// Test if fields are corrects
if (
    !isset($postData['email'])
    || !filter_var($postData['email'], FILTER_VALIDATE_EMAIL)
    || empty($postData['message'])
    || trim($postData['message']) === ''
) {
    echo('Il faut un email et un message valides pour soumettre le formulaire.');
    return;
}

$isFileLoaded = false;
// Test if uploaded file is correct
if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] === 0) {
    // Size
    if ($_FILES['screenshot']['size'] > 1000000) {
        echo "L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse";
        return;
    }

    // Extension
    $fileInfo = pathinfo($_FILES['screenshot']['name']);
    $extension = $fileInfo['extension'];
    $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
    if (!in_array($extension, $allowedExtensions)) {
        echo "L'envoi n'a pas pu être effectué, l'extension {$extension} n'est pas autorisée";
        return;
    }

    // Target folder
    $path = __DIR__ . '/assets/uploads/';
    if (!is_dir($path)) {
        echo "L'envoi n'a pas pu être effectué, le dossier uploads est manquant";
        return;
    }

    // Save file
    move_uploaded_file($_FILES['screenshot']['tmp_name'], $path . basename($_FILES['screenshot']['name']));
    $isFileLoaded = true;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Message bien reçu !</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Email</b> : <?php echo $postData['email']; ?></p>
                <p class="card-text"><b>Message</b> : <?php echo strip_tags($postData['message']); ?></p>
            </div>
        </div>
        
        <a href="index.php">Retour à l'accueil</a>
    </div>
</body>
</html>