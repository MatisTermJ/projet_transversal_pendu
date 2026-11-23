<?php
function init($dbh){
    if (!isset($_SESSION['difficulty'])){
        $_SESSION['difficulty'] = 'Medium';
    }
    if (!isset($_SESSION['theme'])){
        $_SESSION['theme'] = 'Zelda';
    }
    if (!isset($_SESSION['tries_remaining'])) {
        $_SESSION['tries_remaining'] = 7;
    }

    if ($_SESSION['difficulty'] === 'Easy'){
        $_SESSION['reveal_letter'] = 2;
    }elseif ($_SESSION['difficulty'] === 'Medium'){
        $_SESSION['reveal_letter'] = 1;
    }else{
        $_SESSION['reveal_letter'] = null;
    }
    if(!isset($_SESSION['list_words']) or count($_SESSION['list_words']) <= 0){
        $query = $dbh->prepare("SELECT word FROM words WHERE difficulty = ? AND theme = ?");
        $query->execute([$_SESSION['difficulty'], $_SESSION['theme']]);
        $_SESSION['list_words'] = $query->fetchAll(PDO::FETCH_COLUMN);
    }
}


function new_game($words, $reveal_letter){
    if (count($words) > 0) {
        $_SESSION['word'] = $words[random_int(0, count($words) - 1)];
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


?>