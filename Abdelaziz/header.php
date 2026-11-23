    <header class="site-header">
        <div class="container">

            <nav class="nav">
                <a href="../../Antonin/index.php">Accueil</a>
                <a href="../../Antonin/Choix_Jeu.php">Jeux</a>

                <?php if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])): ?>
                    <span>Bonjour <?= htmlspecialchars($_SESSION['pseudo'], ENT_QUOTES, 'UTF-8') ?></span>
                    <form class="logout-form" method="post" action="../../Antonin/Deconnexion.php">
                        <button class="btn btn-small" type="submit">Se déconnecter</button>
                    </form>
                <?php else: ?>
                    <a href="../../Antonin/Connexion.php">Connexion</a>
                    <a class="btn btn-small" href="../../Antonin/Register.php">Créer un compte</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
        <?php
        $flashMessage = null;
        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['flash']) && is_string($_SESSION['flash'])) {
            $flashMessage = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }
        ?>
        <?php if ($flashMessage !== null): ?>
            <div class="flash flash-success"><?= htmlspecialchars($flashMessage, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
