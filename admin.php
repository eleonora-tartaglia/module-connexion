<!-- Page administrateur -->

<?php

session_start();
$host = "localhost"; 
$db = "moduleconnexion"; 
$user = "hayley"; 
$pass = "monarque"; 

try {
    // Créer une nouvelle connexion PDO à MySQL
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Configurer PDO pour qu'il lance une exception chaque fois qu'une erreur se produit
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Si la connexion échoue, afficher l'erreur
    die("Erreur : " . $e->getMessage());
}

// Vérifiez que l'utilisateur est administrateur
if($_SESSION['user']['login'] != 'admin') {
  header('Location: connexion.php');
  exit();
}

// Récupérer toutes les informations des utilisateurs
$sql = "SELECT * FROM utilisateurs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="admin.css">
</head>

<body>
  <video autoplay muted loop id="myVideo">
      <source src="media/arb.mp4" type="video/mp4">
  </video>

  <header class="header">
      <div>
          <h1>ZUBI</h1>
          <!-- <img src="logo.png" alt="logo"> -->
      </div>
      <nav class="nav">
          <a href="connexion.php">Se connecter</a>
          <a href="inscription.php">Créer un compte</a>
          <a href="profil.php">Modifier son profil</a>
      </nav>
  </header>

  <div class="admin-panel">
    <h1>Page d'administration</h1>
    <table>
      <tr>
        <th>Id</th>
        <th>Login</th>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Password</th>
      </tr>

      <?php 
      while($row = $result->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['login'] . "</td>";
        echo "<td>" . $row['prenom'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "</tr>";
      }
      $conn = null; // Fermez la connexion à la base de données
      ?>
    </table>
  </div>

  <footer>
      <h4>With a lot of fun by Eléonora Tartaglia<h4>
  </footer>
</body>
</html>
