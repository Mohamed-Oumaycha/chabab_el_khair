<?php
header("Content-Type: text/html; charset=UTF-8");

// اتصال بقاعدة البيانات
$host = "localhost";
$db   = "chabab_el_khair"; 
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال البيانات من النموذج
$fullname   = $_POST['fullname'];
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$age        = $_POST['age'];

// ملفات
$uploadDir = "uploads/"; // تأكد أنه موجود

// معالجة الصورة الشخصية
$photoName = time() . "_" . basename($_FILES["photo"]["name"]);
$photoPath = $uploadDir . $photoName;
move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath);

// معالجة البطاقة الوطنية
$idcardName = time() . "_" . basename($_FILES["idcard"]["name"]);
$idcardPath = $uploadDir . $idcardName;
move_uploaded_file($_FILES["idcard"]["tmp_name"], $idcardPath);

// معالجة الالتزام
$commitmentName = time() . "_" . basename($_FILES["commitment"]["name"]);
$commitmentPath = $uploadDir . $commitmentName;
move_uploaded_file($_FILES["commitment"]["tmp_name"], $commitmentPath);

// إدخال البيانات في الجدول
$sql = "INSERT INTO registrations 
        (fullname, email, phone, age, photo, idcard, commitment) 
        VALUES 
        ('$fullname', '$email', '$phone', '$age', '$photoPath', '$idcardPath', '$commitmentPath')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Inscription réussite ✔');
            window.location.href='index.html';
          </script>";
    exit;
} else {
    echo 'Erreur SQL : " . $conn->error;
}

$conn->close();
?>
