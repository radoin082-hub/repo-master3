<?php
// بيانات اتصال قاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "choix";

// إنشاء اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استقبال البيانات المرسلة عبر AJAX
$title = $_POST['title'];
$priority = $_POST['priority'];

// إعداد استعلام SQL لإدخال البيانات
$sql = "INSERT INTO choix (title, priority) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $title, $priority);

// تنفيذ الاستعلام
if ($stmt->execute() === TRUE) {
    echo "تم إضافة العنصر بنجاح.";
} else {
    echo "خطأ: " . $stmt->error;
}

// إغلاق الاتصال
$stmt->close();
$conn->close();