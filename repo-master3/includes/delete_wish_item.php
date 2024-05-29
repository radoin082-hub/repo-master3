<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$data = json_decode(file_get_contents("php://input"), true);

// استخراج المعرف من البيانات المرسلة
$id = $data['id'];

// استعلام لحذف البيانات من قاعدة البيانات
$sql = "DELETE FROM wishsheet WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// تنفيذ الاستعلام
if ($stmt->execute()) {
    http_response_code(200);
    echo "Wish item deleted successfully";
} else {
    http_response_code(500);
    echo "Error deleting wish item";
}

// إغلاق الاتصال بقاعدة البيانات
$stmt->close();
$conn->close();
?>
