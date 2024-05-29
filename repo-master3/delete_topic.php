<?php
// استقبال عنوان الموضوع من الجانب الأمامي
$title = $_POST['title'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إعداد الاستعلام لحذف الموضوع باستخدام العنوان
$sql = "DELETE FROM topic WHERE title='$title'";

// تنفيذ الاستعلام
if ($conn->query($sql) === TRUE) {
    // إذا نجحت العملية، أرسل استجابة ناجحة
    echo "success";
} else {
    // إذا فشلت العملية، أرسل رسالة خطأ
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
