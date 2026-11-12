<?php
    require '../Antonin/config.php';
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
    <title>Jeu du Pendu</title>
</head>
<body>
    <main>
        <button><a href="Choix_Jeu.php">Retour</a></button>
            <p>Le pendu</p>
        <?php
        /*
        $word = $_SESSION['good_word'];
        if(!isset($_SESSION['counts'])){
            $_SESSION['counts'] = 0;
        }
            
        if(isset($_POST['new_word'])){
            if(!isset($_POST['good_word'])){
                $index_aleatoire = array_rand($parties);
                $_SESSION['good_word'] =  $parties[$index_aleatoire]["word"];
            }
            
            
        }elseif(isset($_POST['letter'])){
            if(!isset($_SESSION['good_word'])){
                $index_aleatoire = array_rand($parties);
                $_SESSION['good_word'] =  $parties[$index_aleatoire]["word"];
            }
        
            
           
            if(isset($_POST['letter']) && $_POST['letter'] == $word){
                echo  "Bravos vous avez trouver le mot ! <br/>";
                
                $_SESSION['counts']++;

                
            }else{
                echo "Vous n'avez pas trouver le mots <br/>";
            }
            
        }else{
            echo "Vous n'avez pas lancer le jeu, appuyer sur nouveau mot pour lancer un nouveau mot ! <br/>";
        }    
        echo "$word";
        for($i = 0; $i < strlen($word); $i++){
            echo "_ ";
            if(isset($_SESSION['good_word'])){               
            }
        }
            $search = trim($_GET['q'] ?? '');
            if ($search !== '') {
                    $conditions[] = 'fishs.name LIKE :search';
                }


        if(isset($_POST['lettre'])){
                $laitre = 'SELECT '
        }



        echo "Vos points :" . $_SESSION['counts'] . "<br/>";
        */?>
        <?php
        // Voir pour les caractères spéciaux, pour les points, pour le message de fin...

        if (!isset($_SESSION['difficulty'])){
            $_SESSION['difficulty'] = 'Medium';
        }
        if (!isset($_SESSION['theme'])){
            $_SESSION['theme'] = 'Zelda';
        }
        if (!isset($_SESSION['tries_remaining'])) {
            $_SESSION['tries_remaining'] = 7;
        }
        
        // On récupère la liste des mots pour faire un tirage aléatoire

        $query = $dbh->prepare("SELECT word FROM words WHERE difficulty = ? AND theme = ?");
        $query->execute([$_SESSION['difficulty'], $_SESSION['theme']]);
        $list_words = $query->fetchAll(PDO::FETCH_COLUMN);
        
        if(!isset($_SESSION['word']) || isset($_POST['new_word'])){
            if (count($list_words) > 0) {
                $_SESSION['word'] = $list_words[random_int(0, count($list_words) - 1)];
                $_SESSION['letters_found'] = [];
                $_SESSION['alphabet'] = array_fill_keys(range('a', 'z'), null);
                $_SESSION['tries'] = [];
                $_SESSION['tries_remaining'] = 7;
            }
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
            echo '<span style="color: ' . ($couleur ?? 'black') . ';">' . htmlspecialchars($letter, ENT_QUOTES, 'UTF-8') . ' </span>';
        }
        echo '<h4> Essais restant : ' . $_SESSION['tries_remaining'] . '/7</h4>';
        echo '<h4> Essais : </h4>';
        foreach($_SESSION['tries'] as $letter => $couleur){
            echo '<p style="color: ' . ($couleur ?? 'black') . ';">' . htmlspecialchars($letter, ENT_QUOTES, 'UTF-8') . ' </p>';
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