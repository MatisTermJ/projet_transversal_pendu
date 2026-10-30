<?php
require 'config.php';
    if(isset($_SESSION['email'])){
        echo "Bonjour " . htmlspecialchars($_SESSION['pseudo']);
    }
    ?>
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
            <a href="Deconnexion.php">Déconnexion</a>
    </button>
        <button>
            <a href="Register.php">S'enregistrer</a>
        </button>
        <button>
            <a href="Connexion.php">Se connecter</a>
        </button>
    </main>
    <footer>
    </footer>
</body>
</html>