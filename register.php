<?php
// بيانات الاتصال بقاعدة البيانات
$host = "localhost";
$db   = "Chabab_el_khair";
$user = "root"; // غيّره حسب إعداداتك
$pass = "";     // غيّره حسب إعداداتك

$conn = new mysqli($host, $user, $pass, $db);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال البيانات من النموذج
$fullname   = $_POST['fullname'];
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$age        = $_POST['age'];
$photo      = $_FILES['photo'];
$idcard     = $_FILES['idcard'];
$commitment = $_FILES['commitment'];
// معالجة رفع الملفات
$uploadDir = "./uploads/"; // تأكد أن هذا المجلد موجود وله صلاحيات الكتابة

// صورة شخصية
$photoName = basename($_FILES["photo"]["name"]);
$photoTmp  = $_FILES["photo"]["tmp_name"];
$photoPath = $uploadDir . time() . "_" . $photoName;
move_uploaded_file($photoTmp, $photoPath);

// البطاقة الوطنية
$idcardName = basename($_FILES["idcard"]["name"]);
$idcardTmp  = $_FILES["idcard"]["tmp_name"];
$idcardPath = $uploadDir . time() . "_" . $idcardName;
move_uploaded_file($idcardTmp, $idcardPath);

// ملف الالتزام
$commitmentName = basename($_FILES["commitment"]["name"]);
$commitmentTmp  = $_FILES["commitment"]["tmp_name"];
$commitmentPath = $uploadDir . time() . "_" . $commitmentName;
move_uploaded_file($commitmentTmp, $commitmentPath);

// إدخال البيانات في قاعدة البيانات
$sql = "INSERT INTO registrations (fullname, email, phone, age, photo, idcard, commitment) 
        VALUES ('$fullname', '$email', '$phone', '$age', '$photoPath', '$idcardPath', '$commitmentPath')";

if ($conn->query($sql) === TRUE) {
    echo "Inscription réussie !";
} else {
    echo "Erreur: " . $conn->error;
}
// بعد ما تنتهي عملية التسجيل:
echo "<script>
        alert('Inscription réussite ✔'); 
        window.location.href='index.html'; // الرابط للصفحة الرئيسية
      </script>";
exit;

$conn->close();
?>
