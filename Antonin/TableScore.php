<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <head></head>
    <main>
        <?php
           


        
            


            /*$scoretable = [
                ["pseudo" => "Batman", "point" => "10", "place" => "1"],
                ["pseudo" => "Joker", "point" => "6", "place" => "3"],
                ["pseudo" => "SpiderMan", "point" => "8", "place" => "2"]
               ];*/


            if(isset($_POST['hard'])){
                 $recupScore = $dbh->prepare('SELECT * FROM scoreboard WHERE difficulty = "Difficile"');
            $recupScore -> execute();
            while($score = $recupScore->fetch()){
                
                    {echo "Le pseudo = " . $score['pseudo'] . "/";
                    echo "Les points =" . $score['points'] . "/";
                    echo "La difficulté = " . $score['difficulty'] . "<br>"; }       
            }}
             if(isset($_POST['Easy'])){
                 $recupScore = $dbh->prepare('SELECT * FROM scoreboard WHERE difficulty = "Facile"');
            $recupScore -> execute();
            while($score = $recupScore->fetch()){
                
                    {echo "Le pseudo = " . $score['pseudo'] . "/";
                    echo "Les points =" . $score['points'] . "/";
                    echo "La difficulté = " . $score['difficulty'] . "<br>"; }       
            }}
            if(isset($_POST['Middle'])){
                 $recupScore = $dbh->prepare('SELECT * FROM scoreboard WHERE difficulty = "Moyen"');
            $recupScore -> execute();
            while($score = $recupScore->fetch()){
                
                    {echo "Le pseudo = " . $score['pseudo'] . "/";
                    echo "Les points =" . $score['points'] . "/";
                    echo "La difficulté = " . $score['difficulty'] . "<br>"; }       
            }} 
        ?>
            
            <!--
           echo "Vous avez choisie le Tableau des scores difficiles.";
           
           elseif(isset($_POST['Easy'])){
                echo "Vous avez choisie le Tableau des scores Faciles";
            }elseif(isset($_POST['Middle'])){
                echo "Vous avez choisie le Tableau des scores Moyen";
            }//-->
       
        <form method="post">
            <button type="submit"><a href="Choix_Jeu.php">Retour</a></button>
            <button type="submit" name="Easy">Tableau des scores facile</button>
            <button type="submit" name="Middle">Tableau des scores moyen</button>
            <button type="submit" name="hard">Tableau des scores difficiles</button>
        </form>
    </main>
    <footer></footer>
</body>
</html>