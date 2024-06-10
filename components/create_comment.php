<?php
require_once('utils/isConnect.php')
?>

<form action="submit_create_comment.php" method="POST">
    <div class="mb-3 visually-hidden">
        <input class="form-control" type="text" name="recipe_id" value="<?php echo ($recipe['recipe_id']); ?>" />
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label">Poster un commentaire</label>

        <textarea class="form-control" placeholder="Votre commentaire..." name="comment" id="comment"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Poster</button>
</form>