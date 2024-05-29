<?php
// استقبال البيانات من الطلب POST
// الوصف الجديد
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);
$oldTitle = $_POST['oldTitle']; // العنوان القديم
$newTitle = $_POST['newTitle']; // العنوان الجديد
$newDescription = $_POST['description']; 
// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التحديث في قاعدة البيانات
$sql = "UPDATE topic SET title='$newTitle', resume='$newDescription' WHERE title='$oldTitle'";

if ($conn->query($sql) === TRUE) {
    // إرسال رسالة نجاح إلى العميل
    echo "تم تحديث الموضوع بنجاح.";

    // قم بإغلاق اتصال قاعدة البيانات
    $conn->close();

    // إنهاء النص PHP
    exit();
} else {
    // إرسال رسالة خطأ إلى العميل
    echo "خطأ في التحديث: " . $conn->error;

    // قم بإغلاق اتصال قاعدة البيانات
    $conn->close();

    // إنهاء النص PHP
    exit();
}
?>
