
<?php
    require 'config.php';   
    if(isset($_POST['connect'])){
        header('Location: Connexion.php');
    }elseif(isset($_POST['register'])){
        header('Location: Register.php');
    }elseif(isset($_POST['deco'])){
        unset($_SESSION['pseudo']);
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
    <header>
        <div class="game_choice">
            <form method="POST">
                <button name="connect">Se connecter</button>
                <button name="register">S'enregistrer</button>
                <button name="deco">Déconnexion</button>
            </form>
            <?php 
                if(isset($_SESSION['pseudo'])){

                
                    if(isset($_POST['scored'])){
                    ?>
                    <div class="scoreTable">
                        <form method="POST">
                            <button><a href="TableScore.php">Pendu score</a></button>
                            <button>Star wars score</button>
                            <button>Diddy score</button>
                        </form>
                    </div>
                    <?php
                    }
                    ?>
                    
                    
                    
                <form method="POST">
                    <div>
                        <button name="scored">Voir les scores !</button>
                    </div>
                </form>
            </div>
        
        </header>

        <main>
            
            <h1 class="title"> Bienvenue sur le site de jeu vidéo Tyché !</h1>
            <?php
                $query = $dbh->prepare("SELECT admin FROM users WHERE pseudo = ?");
                $query->execute([$_SESSION['pseudo']]);
                $user = $query->fetch();

            
                
            echo "Bonjour " . htmlspecialchars($_SESSION['pseudo']) . "<br>";
            
            ?>
            <div>
                <h2 class="title">Catalogue de jeu !</h2>
            </div>
            <div class="game">
                <div class="game_button">
                    <a href="choix_theme.php"><img src="pendu.jpg" alt="zizou" class="img">
                    <p>Game : Jeu du pendu</p>
                    <p>Super jeu</p>
                    </a>
                </div>
                <div class="game_button">
                    <a href="super_game.php"><img src="images.jpg" alt="zizou" class="img2">
                    <p>Game : The legend of Star Wars</p>
                    <p>Uwu Kawai</p>
                    </a>
                </div>
                <div class="game_button">
                    <a href="super_game.php"><img src="diddy.jpg" alt="zizou" class="img2">
                    <p>Game : Five nights at diddy's</p>
                    <p>Tro drol mdéair</p>
                    </a>
                </div>
                
                



            </div>
            
        </main>

        <footer class="foter">
            <?php
                    if ($user && $user['admin'] == 1) {
                    
                ?>
                <div class="game_button">
                    <form method="POST">
                        <button>Ajouter un jeu !</button>
                    </form>
                </div>
                <?php }?>
            <?php }?>
    </footer>
    
    
</body>
</html>