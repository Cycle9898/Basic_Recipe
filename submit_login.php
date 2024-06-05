<?php
session_start();
require_once(__DIR__ . '/database/credentials.php');
require_once(__DIR__ . '/database/dbConnect.php');
require_once(__DIR__ . '/utils/variables.php');
require_once(__DIR__ . '/utils/functions.php');

$postData = $_POST;

// Form validation
if (isset($postData['email']) && isset($postData['password'])) {
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Votre mail n\'est pas valide, merci de le vérifier';
    } else {
        foreach($users as $user) {
            if ($user['email'] === $postData['email']
            && $user['password'] === $postData['password']) {
                $_SESSION['LOGGED_USER'] = [
                    'email' => $user['email'],
                    'user_id' => $user['user_id']
                ];
            }
        }

        if (!isset($_SESSION['LOGGED_USER'])) {
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'L\'email et/ou le mot de passe sont invalides, merci de les vérifier';
        }
    }
    
    redirectToUrl('/');
}
?>