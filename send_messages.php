<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chabab_el_khair"; // سميّة قاعدة البيانات ديالك

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Erreur connexion: " . $conn->connect_error);
}

// التحقق أن الفورم مرسل
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $message = $conn->real_escape_string($_POST["message"]);

    // إدخال البيانات داخل جدول messages
    $sql = "INSERT INTO messages (fullname, email, message, date_sent)
            VALUES ('$fullname', '$email', '$message', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Message envoyé avec succès !');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo 'Erreur: ' . $conn->error;
    }
}

$conn->close();
?>