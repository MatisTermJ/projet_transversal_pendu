<?php
    require 'config.php';
    if(isset($_POST['envoie'])){
        if(!empty($_POST['password']) AND !empty($_POST['email'])){
            $email = htmlspecialchars($_POST['email']);
           
            // 1. On cherche l'utilisateur uniquement par son email
            $recupUser = $dbh->prepare('SELECT * FROM register WHERE email = ?');
            $recupUser->execute(array($email));

            $user = $recupUser->fetch();

            // 2. On vérifie le mot de passe avec password_verify
            if($user && password_verify($_POST['password'], $user['password'])){
                
                // 3. On extrait le pseudo directement depuis les données trouvées en base ($user)
                $_SESSION['pseudo'] = $user['pseudo']; 
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $user['id'];
                
                header('Location: homepage.php');
            }else{
                echo "screugneugneu";
            }
        }else{
            echo "Vous n'avez pas remplie tout les champs.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>tchitcho</title>
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <header>
    </header>
    <main>
        <button>
            <a href="homepage.php">retourner a la home page</a>
        </button>
        <form method="POST" align="center">
           
            <input type="password" name="password" placeholder="PassWord" autocomplete="off"><br>
            <input type="email" name="email" placeholder="Tanoxy@gmail.com" autocomplete="off"><br>
            <input type="submit" name="envoie">
        </form>
    </main>
    <footer>
    </footer>
</body>
</html>
