<?php
require 'config.php';
if(isset($_POST['envoie'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['password']) AND !empty($_POST['email'])){
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = htmlspecialchars($_POST['email']);
            $insert = $dbh->prepare('INSERT INTO register(pseudo, password, email)VALUES(?, ?, ?)');
            $insert->execute(array($pseudo, $mdp, $email));
            
            $recupUser = $dbh->prepare('SELECT * FROM register WHERE pseudo = ? AND password = ? AND email = ?');
            $recupUser->execute(array($pseudo, $mdp, $email));
            if($recupUser->rowCount() > 0 ){
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['password'] = $mdp;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $recupUser->fetch()['id'];        
            }
            header('Location: homepage.php');    
                }else{
                            echo "Vous n'avez pas tout renseigné.";
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
            <input type="text" name="pseudo" placeholder="Tanoxy" autocomplete="off"><br>
            <input type="password" name="password" placeholder="PassWord" autocomplete="off"><br>
            <input type="email" name="email" placeholder="Tanoxy@gmail.com" autocomplete="off"><br>
            <input type="submit" name="envoie">
        </form>
    </main>
    <footer>
    </footer>
</body>
</html>