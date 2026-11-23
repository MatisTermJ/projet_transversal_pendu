<?php
    require '../Antonin/config.php';
    try{
        $query = $dbh->query("SELECT id, word, difficulty, theme FROM words");
        $parties = $query->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
    }


    //Bouton de choix de thèmes
        if(isset($_POST['Easy'])){
            $_SESSION['difficulty'] = 'Easy';
        }elseif(isset($_POST['Medium'])){
            $_SESSION['difficulty'] = 'Medium';
        }elseif(isset($_POST['Hard'])){
            $_SESSION['difficulty'] = 'Hard';
        }
        if(isset($_POST['retour'])){
            unset($_SESSION['difficulty'], $_SESSION['word']);
            header('Location: choix_theme.php');
        }
        if(isset($_POST['new_word'])){
            unset($_SESSION['difficulty'], $_SESSION['word']);
        }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>jean du jeu</title>
</head>
<body>
    <main>
        <form method="POST">
            <button name="retour">Retour</button>
        </form>

        <?php if(!isset($_SESSION['difficulty']) || isset($_POST['new_word'])){?>
            <div class="difficulty" >
                <form method="POST" name="diff">
                    <button name="Easy">Facile</button>
                    <button name="Medium">Moyen</button>
                    <button name="Hard">Difficile</button>
                </form>
            </div>
         <?php }?>
        
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
        // Voir pour les caractères spéciaux, pour les points, pour le message de fin, pour le début en révélant X lettres, garder l'historique de parties en insérant chaque parties dans la base de données...
        
   
        
        if(isset($_SESSION['difficulty'])){
        if ($_SESSION['difficulty'] === 'Easy'){
            $reveal_letter = 2;
        }elseif ($_SESSION['difficulty'] === 'Medium'){
            $reveal_letter = 1;
        }else{
            $reveal_letter = null;
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
        
        

        if(!isset($_SESSION['word']) ||  isset($_POST["new_word"])){
            if (count($list_words) > 0) {
                $_SESSION['word'] = $list_words[random_int(0, count($list_words) - 1)];
                $word_decomposition = mb_str_split(mb_strtolower($_SESSION['word'], 'UTF-8'));
                $_SESSION['letters_found'] = [];
                $_SESSION['alphabet'] = array_fill_keys(range('a', 'z'), null);
                $_SESSION['tries'] = [];
                $_SESSION['tries_remaining'] = 7;

                // On révèle ou non des lettres
                
                if ($reveal_letter !== null){
                    $wd = $word_decomposition;
                    for ($i = 0; $i < $reveal_letter; $i++){
                        $l = $wd[array_rand($wd)];
                        $wd = array_values(array_filter($wd, fn($element) => $element !== $l)); //On enlève les occurences de la lettre du tableau
                        $_SESSION['letters_found'][] = $l;
                        $_SESSION['alphabet'][$l] = "green";
                    }
                }
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
            echo '<span class="letter_' . ($couleur ?? 'black') . '">' . htmlspecialchars($letter, ENT_QUOTES, 'UTF-8') . ' </span>';
        }
        echo '<h4> Essais restant : ' . $_SESSION['tries_remaining'] . '/7</h4>';
        echo '<h4> Essais : </h4>';
        foreach($_SESSION['tries'] as $letter => $couleur){
            echo '<span class="letter_' . ($couleur ?? 'black') . '">' . htmlspecialchars($letter, ENT_QUOTES, 'UTF-8') . ' </span>';
        }

        //Ajout admin
            $query = $dbh->prepare("SELECT admin FROM users WHERE pseudo = ?");
            $query->execute([$_SESSION['pseudo']]);
            $user = $query->fetch();

        if(isset($_POST['show_word'])){
            echo $_SESSION['word'];
        }
        ?>
            <form method="POST">
                <?php if ($_SESSION['tries_remaining'] > 0): ?>
                    <input type="text" placeholder="pamplemousse" name="word_test">
                    <button name="word_button">Tester le mot</button><br>

                    <input type="text" placeholder="A, a, ..." name="letter_test">
                    <button name="letter_button">Tester la lettre</button><br>
                <?php endif; ?>
                <form method="POST">
                    <button name="new_word">Nouveau mot</button>
                </form>
            </form>
            <div>
                
            </div>

            <?php
                if ($user && $user['admin'] == 1) {
            ?>
                <form method="POST">
                    <button name="show_word">Montrer le mot</button>
                </form>
            <?php }?>
    </main>
    <footer>

    </footer>
    
</body>
    <?php }?> 
</html>