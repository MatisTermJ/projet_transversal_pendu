<?php

function interrogation_bdd($dbh, $select, $table, $where, $arg){
    try{
        $query = $dbh->prepare("SELECT $select FROM $table WHERE $where = ?");
        $query->execute([$arg]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
    }
}

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
        $_SESSION['victory'] = null;
        $_SESSION['wordId'] = null;
        $_SESSION['wordPoint'] = null;

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

function end_game($tries){
    if($tries <= 0){
        $_SESSION['victory'] = 0;
        $_SESSION['wordPoint'] = -5;
    }
}

function export_bdd($dbh, $user_id, $word_id, $difficulty, $attemps, $victory, $points){
    try{
        $query = $dbh->prepare("INSERT INTO games(user_id, word_id, difficulty, attempts, victory, points, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $query->execute([
            $user_id,
            $word_id,
            $difficulty,
            $attemps,
            $victory,
            $points
        ]);
    }catch (PDOException $e) {
    die("Erreur lors de l'exportation des données : " . $e->getMessage());
    }

}



?>