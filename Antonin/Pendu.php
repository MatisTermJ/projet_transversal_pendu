<?php
    require 'config.php';
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
    <title>Document</title>
</head>
<body>
    <header>
    </header>
    <main>
        <button><a href="Choix_Jeu.php">Retour</a></button>
        <p>Bonjour good boy, ici ta mommy, tu es un bon toutou, aboie pour moi grrrrrr</p>
            <p>Le pendu</p>
        <?php
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
        ?>

        
            <form method="POST">
                <input type="text" placeholder="pamplemousse" name="letter">
                <button name="word_button">Tester le mot</button><br>

                <input type="text" placeholder="A" name="lettre">
                <button name="letter_button">Tester la lettres</button><br>

                <button name="new_word">Nouveau mot</button>
            </form>
            <div>
                
            </div>
    </main>
    <footer>

    </footer>
    
</body>
</html>