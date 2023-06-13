<!-- Page inscription -->

<?php

    $host = "localhost"; // L'adresse de l'hôte de la base de données. En général, c'est "localhost".
    $db = "moduleconnexion"; // Le nom de votre base de données
    $user = "hayley"; // L'identifiant de l'utilisateur de la base de données
    $pass = "monarque"; // Le mot de passe de l'utilisateur de la base de données

    try {
        // Créer une nouvelle connexion PDO à MySQL
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        // Configurer PDO pour qu'il lance une exception chaque fois qu'une erreur se produit
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        // Si la connexion échoue, afficher l'erreur
        die("Erreur : " . $e->getMessage());
    }

if (isset($_POST['submit'])){
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $confirm_password = $_POST['password_confirm'];
        
    if($password != $confirm_password){
        echo "Les mots de passe ne correspondent pas.";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt = $conn->prepare("INSERT INTO utilisateurs (login, prenom, nom, password) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $prenom);
        $stmt->bindParam(3, $nom);
        $stmt->bindParam(4, $password);
    
        if($stmt->execute()){
            header('Location: connexion.php');
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
    $conn = null; // Fermer la connexion à la base de données
}
    

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="inscription.css">
</head>
<body>
    <header class="header">
        <div>
            <h1>ZUBI</h1>
            <!-- <img src="logo.png" alt="logo"> -->
        </div>
        <nav class="nav">
            <a href="index.php">Accueil</a>
            <a href="connexion.php">Se connecter</a>
            <a href="profil.php">Modifier son compte</a>
        </nav>
    </header>

    <div class="form-container" id="form-container">
        <div class="container" id="form-box">
            <h3 class="title">Création de compte</h3>
            <form method="POST" action="inscription.php">
                Login : <input type="text" name="login" required><br>
                Prénom : <input type="text" name="prenom" required><br>
                Nom : <input type="text" name="nom" required><br>
                Mot de passe : <input type="password" name="password" required><br>
                Confirmer le mot de passe : <input type="password" name="password_confirm" required><br>
                <input type="submit" name="submit" value="S'inscrire" id="submit-button">

            </form>
        </div>
    </div>

    <footer>
        <h4>With a lot of fun by Eléonora Tartaglia<h4>
    </footer>
</body>
</html>
