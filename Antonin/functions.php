<?php
  function theme(){
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
                header('Location: index.php');
            }
          }

    function connect(){
        if(isset($_POST['connect'])){
        header('Location: Connexion.php');
    }
    };
    function register(){
        if(isset($_POST['register'])){
        header('Location: Register.php');
    }
    };
    function deconnect(){
       if(isset($_POST['deco'])){
        unset($_SESSION['pseudo']);
    }
    };
    function hello_user($dbh){
        if (!isset($_SESSION['pseudo'])) {
        return false;
    }
        $query = $dbh->prepare("SELECT admin FROM users WHERE pseudo = ?");
        $query->execute([$_SESSION['pseudo']]);
        return $query->fetch();
    }
    function difficulty_img(){
        if(isset($_SESSION['theme']) && $_SESSION['theme']=='zelda'){
             ?>
            <div class="difficulty" >
                <form method="POST" name="diff">
                    <button name="Easy" class="connect_btn"><img src="zelda_peacful.jpg" alt="zelda" width=120px class="imgg"></button>
                    <button name="Medium" class="connect_btn"><img src="medium_zelda.jpg" alt="medium zelda" width=130px class="imgg"></button>
                    <button name="Hard" class="connect_btn"><img src="hard_zelda.jpg" alt="hard zelda" width=70px class="imgg"></button>
                </form>
            </div>
             <?php
        }

        if(isset($_SESSION['theme']) && $_SESSION['theme']=='minecraft'){
             ?>
            <div class="difficulty" >
                <form method="POST" name="diff">
                    <button name="Easy" class="connect_btn"><img src="minecraft_peaceful.jpg" alt="zelda" width=120px class="imgg"></button>
                    <button name="Medium" class="connect_btn"><img src="minecraft_medium.jpg" alt="medium zelda" width=130px class="imgg"></button>
                    <button name="Hard" class="connect_btn"><img src="minecraft_hard.jpg" alt="hard zelda" width=70px class="imgg"></button>
                </form>
            </div>
             <?php
        }

        if(isset($_SESSION['theme']) && $_SESSION['theme']=='endfield'){
             ?>
            <div class="difficulty" >
                <form method="POST" name="diff">
                    <button name="Easy" class="connect_btn"><img src="minecraft_peacful.jpg" alt="zelda" width=120px class="imgg"></button>
                    <button name="Medium" class="connect_btn"><img src="minecraft_medium.jpg" alt="medium zelda" width=130px class="imgg"></button>
                    <button name="Hard" class="connect_btn"><img src="minecraft_hard.jpg" alt="hard zelda" width=70px class="imgg"></button>
                </form>
            </div>
             <?php
        }
    }

    function arrow(){
        if(isset($_POST['arrow'])){

        }
    }
    
?>