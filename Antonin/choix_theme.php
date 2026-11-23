<?php
require "config.php";
    //  Bouton pour choisirs le thème, a voir si on le change pas de page celui la.(vue qu'on veut 
    //  faire une page pour choisir le thème, c'est peut être mieux de mettres ses boutons sur une autre page, enfin on verra.)
            
            if (isset($_POST['Zelda'])){
                $_SESSION['theme'] = 'zelda';
                header('Location: pendu_matis.php');
              
                ?>
                <div class ="background">
                </div>
           <?php

            }elseif(isset($_POST['Minecraft'])){
                $_SESSION['theme'] = 'minecraft';
                header('Location: pendu_matis.php');
             
            }elseif(isset($_POST['Endfield'])){
                $_SESSION['theme'] = 'endfield';
                header('Location: pendu_matis.php');
              
            }elseif(isset($_POST['retour'])){
                header('Location: Choix_Jeu.php');
            }
            
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     
    <form method="POST">
           <button name="retour">Retour</button><br>
            <button  name="Zelda">=Thème mot Zelda</button><br>
            <button  name="Minecraft"> Thème mot Minecraft</button><br>
            <button  name="Endfield">Thème mot endfield</button><br>
    </form>
</body>
</html>