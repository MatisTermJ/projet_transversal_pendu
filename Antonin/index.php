
<?php
    require 'config.php';   
    require 'functions.php';
    connect();
    register();
    deconnect();
    $user = hello_user($dbh);  
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
            <div>
                <?php if(!isset($_SESSION['pseudo'])){?>
                <form method="POST">
                    <button name="connect"  class="connect_btn">Se connecter</button>
                    <button name="register" class="connect_btn">S'enregistrer</button>
                <?php }?>
                    
                </form>
                <?php if(isset($_SESSION['pseudo'])){?>
                <form method="POST">
                    <button name="deco"  class="connect_btn">Déconnexion</button>
                </form>
                <?php }?>
            </div>
            <?php 
                
            if(isset($_SESSION['pseudo'])){


                        if(isset($_POST['scored'])){
                        ?>
                        <div class="scoreTable">
                            <form method="POST">
                                <button><a href="TableScore.php" class="connect_btn">Pendu score</a></button>
                                <button class="connect_btn">Star wars score</button>
                                <button class="connect_btn">Diddy score</button>
                            </form>
                        </div>
                        <?php
                        }
                        ?>                  
                    <form method="POST">
                        <div>
                            <button name="scored" class="connect_btn">Voir les scores !</button>
                        </div>
                    </form>
                </div>       
            </header>
            <main>           
                <h1 class="title"> Bienvenue sur le site de jeu vidéo Tyché !</h1>
                <div>
                    <?php echo "Bonjour " . htmlspecialchars($_SESSION['pseudo']) . "<br>";?>
                    
                    <h2 class="title">Catalogue de jeu !</h2>
                </div>
                <div class="game">
                    <div class="game_button">
                        <a href="choix_theme.php"><img src="Pendu.jpg" alt="zizou" class="img">
                        <div class="game_choice_text">
                            <p>Game : Jeu du pendu</p>
                            <p>Super jeu</p>
                        </div>    
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
                        <button class="connect_btn">Ajouter un jeu !</button>
                    </form>
                </div>
                <?php }?>
            <?php }?>
    </footer>
    
    
</body>
</html>
<!--
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
                    -->