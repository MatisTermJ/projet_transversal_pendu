<?php
require "config.php";
require "functions.php";
theme();       
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
        <form method="POST">
             <button name="retour" class="connect_btn">Retour</button>
        </form>
     </header>
     <main>
        <form method="POST">
           <br>
                <div class="theme_bouton">
                    <button  name="Zelda" class="connect_btn"><img src="mojo.jpg" alt="mojo" width=100px class="imgg">Thème mot Zelda</button><br>
                    <button  name="Minecraft" class="connect_btn"> <img src="minecraft.jpg" alt="minecraft"width=100px class="imgg">Thème mot Minecraft</button><br>
                    <button  name="Endfield" class="connect_btn"><img src="endfield.jpg" alt="endfield"width=100px class="imgg">Thème mot endfield</button><br>
                </div>
        </form>
    </main>
</body>
</html>