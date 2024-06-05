<?php
// Get infos from database

// All users
$userStatement = $sqlClient->prepare('SELECT * FROM users');
$userStatement->execute();
$users = $userStatement->fetchAll();

// All recipes
$recipeStatement = $sqlClient->prepare('SELECT * FROM recipes WHERE is_enabled = TRUE');
$recipeStatement->execute();
$recipes = $recipeStatement->fetchAll();
?>