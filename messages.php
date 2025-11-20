<?php
header("Content-Type: text/html; charset=UTF-8");

// Connexion MySQL
$host = "localhost";
$db   = "chabab_el_khair";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

// Activer UTF-8
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST["name"];   // لأن الفورم فيه name وليس fullname
    $email    = $_POST["email"];
    $message  = $_POST["message"];

    // Requête sécurisée
    $sql = $conn->prepare("INSERT INTO messages (fullname, email, message) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $fullname, $email, $message);

    if ($sql->execute()) {
        echo "<script>
                alert('Message envoyé avec succès ✔');
                window.location.href='index.html';
              </script>";
    } else {
        echo "Erreur SQL : " . $conn->error;
    }

} else {
    echo "Aucune donnée envoyée !";
}
?>
