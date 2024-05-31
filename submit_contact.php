<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $email = $_GET['email'];
    $message = $_GET['message'];

    if (
        !isset($email)
        || !filter_var($email, FILTER_VALIDATE_EMAIL)
        || !isset($message)
        || trim($message) === ''
        ) : ?>
    <h1>Un problème est survenu !</h1>

    <div class="card">
        <p>Il faut un email et un message valides pour soumettre le formulaire.</p>
    </div>

    <a href="contact.php">Retour au formulaire</a>
    
    <?php else : ?>
        <h1>Message bien reçu !</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Rappel de vos informations</h5>
            <p class="card-text"><b>Email</b> : <?php echo $_GET['email']; ?></p>
            <p class="card-text"><b>Message</b> : <?php echo $_GET['message']; ?></p>
        </div>
    </div>

    <a href="index.php">Retour à l'accueil</a>
    
    <?php endif ?>

</body>
</html>