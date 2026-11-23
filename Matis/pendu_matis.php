<?php
    require '../Antonin/config.php';
    require_once 'functions.php';
    try{
        $query = $dbh->query("SELECT id, word, difficulty, theme FROM words");
        $parties = $query->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src_jeu/style/style.css">
    <title>Jeu du Pendu</title>
</head>
<body>
    <main>
        <button><a href="Choix_Jeu.php">Retour</a></button>
            <p>Le pendu</p>
        <?php
        // Voir pour les caractères spéciaux, pour les points, pour le message de fin, pour le début en révélant X lettres, garder l'historique de parties en insérant chaque parties dans la base de données...
        // Faire l'export vers la base de données : user_id, word_id, difficulty, attemps, victory (0 ou 1), points, created_at (fin de partie)

        //user_id
        /*try{
            $query = $dbh->query("SELECT id FROM users WHERE pseudo = ?");
            $query->execute([$_SESSION['pseudo']]);
            $_SESSION['userId'] = $query->fetchColumn();
        }catch (PDOException $e) {
        die("Erreur lors de la récupération des données : " . $e->getMessage());
        }*/
        
        init($dbh);
        
        if(!isset($_SESSION['word']) || isset($_POST['new_word'])){
            new_game($_SESSION['list_words'], $_SESSION['reveal_letter']);
        }

        $word_decomposition = mb_str_split(mb_strtolower($_SESSION['word'], 'UTF-8'));
        $_SESSION['word_found'] = array_fill(0, count($word_decomposition), '_');

        if (!isset($_SESSION['letters_found'])) {
            $_SESSION['letters_found'] = [];
        }

        if (isset($_POST['letter_test'])) {
            $letter = mb_strtolower(trim($_POST['letter_test']), 'UTF-8');

            if (mb_strlen($letter, 'UTF-8') === 1) {
                if(in_array($letter, $word_decomposition, true)){
                    if(!in_array($letter, $_SESSION['letters_found'], true)) {
                        $_SESSION['letters_found'][] = $letter;
                        $_SESSION['alphabet'][$letter] = "green";
                        $_SESSION['tries'][$letter] = "green";
                    }
                }else{
                    if (!isset($_SESSION['tries'][$letter])) {
                        $_SESSION['tries'][$letter] = 'red';
                        $_SESSION['tries_remaining'] -= 1;
                    }
                    $_SESSION['alphabet'][$letter] = 'red';
                }  
            }
        }
        if (isset($_POST['word_test']) && trim($_POST['word_test']) !== ''){
            $guess = mb_strtolower(trim($_POST['word_test']), 'UTF-8');
            $secret_word = mb_strtolower(trim($_SESSION['word']), 'UTF-8');

            if ($guess === $secret_word){
                $_SESSION['letters_found'] = array_values(array_unique($word_decomposition));
                echo "Bravo, tu as trouvé le mot !<br>";
                $_SESSION['tries'][$guess] = "green";
                // Rajouter point ici
            } else {
                echo "Ce n'est pas le bon mot.<br>";
                if (!isset($_SESSION['tries'][$guess])){
                    $_SESSION['tries'][$guess] = "red";
                    if ($_SESSION['tries_remaining'] - 2 <= 0){
                        $_SESSION['tries_remaining'] = 0;
                    }else{
                        $_SESSION['tries_remaining'] -= 2;
                    }
                }
            }
        }

        $word_found = [];

        foreach ($word_decomposition as $character) {
            if (in_array($character, $_SESSION['letters_found'], true)) {
                $word_found[] = $character;
            } else {
                $word_found[] = '_';
            }
        }

        echo implode(' ', $word_found) . '<br>';
        if (!in_array('_', $word_found, true)) {
            echo "Bravo, tu as trouvé le mot !";
            // Ajouter point ici
        }
        if ($_SESSION['tries_remaining'] == 0){
            echo "Vous avez perdu !";
        }
        foreach($_SESSION['alphabet'] as $letter => $couleur){
            echo '<span class="letter_' . ($couleur ?? 'black') . '">' . htmlspecialchars($letter, ENT_QUOTES, 'UTF-8') . ' </span>';
        }
        echo '<h4> Essais restant : ' . $_SESSION['tries_remaining'] . '/7</h4>';
        echo '<h4> Essais : </h4>';
        foreach($_SESSION['tries'] as $letter => $couleur){
            echo '<span class="letter_' . ($couleur ?? 'black') . '">' . htmlspecialchars($letter, ENT_QUOTES, 'UTF-8') . ' </span>';
        }
        ?>
            <form method="POST">
                <?php if ($_SESSION['tries_remaining'] > 0): ?>
                    <input type="text" placeholder="pamplemousse" name="word_test">
                    <button name="word_button">Tester le mot</button><br>

                    <input type="text" placeholder="A, a, ..." name="letter_test">
                    <button name="letter_button">Tester la lettre</button><br>
                <?php endif; ?>

                <button name="new_word">Nouveau mot</button>
            </form>
            <div>
                
            </div>
    </main>
    <footer>

    </footer>
    
</body>
</html>