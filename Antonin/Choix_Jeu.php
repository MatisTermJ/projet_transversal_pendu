<?php
    require 'config.php';
   
            echo "Bonjour " . htmlspecialchars($_SESSION['pseudo']);
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button>
            <a href="Deconnexion.php">Déconnexion</a>
    </button>
    <button><a href="Pendu.php">Jeu du pendu</a></button>
</body>
</html>