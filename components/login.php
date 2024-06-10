<?php
if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <form action="submit_login.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>

            <input type="email" class="form-control" id="email" name="email" placeholder="you@exemple.com" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>

            <input type="password" class="form-control" id="password" name="password" />
        </div>

        <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
            <div class="mb-3 alert alert-danger" role="alert">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary m-auto d-block">Se connecter</button>
    </form>

<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $_SESSION['LOGGED_USER']['email']; ?> et bienvenue sur le site !
    </div>
<?php endif ?>