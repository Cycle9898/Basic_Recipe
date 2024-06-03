<?php
$postData = $_POST;

// Form validation
if (isset($postData['email']) && isset($postData['password'])) {
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Votre mail n\'est pas valide, merci de le vérifier';
    } else {
        foreach($users as $user) {
            if ($user['email'] === $postData['email']
            && $user['password'] === $postData['password']) {
                $loggedUser = [
                    'email' => $user['email']
                ];
            }
        }

        if (!isset($loggedUser)) {
            $errorMessage = 'L\'email et/ou le mot de passe sont invalides, merci de les vérifier';
        }
    }
}
?>

<?php if (!isset($loggedUser)) : ?>
    <form action="index.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>

            <input type="email" class="form-control" id="email" name="email" placeholder="you@exemple.com" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Votre message</label>

            <input type="password" class="form-control" id="password" name="password" />
        </div>

        <?php if (isset($errorMessage)) : ?>
            <div class="mb-3 alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary m-auto d-block">Se connecter</button>
    </form>

<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $loggedUser['email']; ?> et bienvenue sur le site !
    </div>
<?php endif ?>