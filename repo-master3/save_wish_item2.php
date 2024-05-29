<?php
// استقبال البيانات المرسلة من الجافا سكريبت
$data = json_decode(file_get_contents('php://input'), true);
print_r($data);
// اتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    // Check if wishsheetid exists in the database
    $checkStmt = $conn->prepare("SELECT * FROM assamentstudent WHERE wishsheetid = :wishsheetid");
    $checkStmt->bindParam(':wishsheetid', $data['wishsheetid']);
    $checkStmt->execute();

    if ($checkStmt->rowCount() <= 0) {
        // wishsheetid exists in the database, execute the query
        $stmt = $conn->prepare("INSERT INTO assamentstudent ( studentid,wishsheetid) VALUES ( :studentid, :wishsheetid)");
        $stmt->bindParam(':studentid', $data['studentid']);
        $stmt->bindParam(':wishsheetid', $data['wishsheetid']);
        $stmt->execute();

        http_response_code(200);
        echo json_encode(array("message" => "Wish item saved successfully.", "data" => $data));
    } else {
        // wishsheetid does not exist in the database
        http_response_code(409);
        echo json_encode(array("message" => "wishsheetid exists in the database.", "data" => $data));
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error: " . $e->getMessage(), "data" => $data));
}
?>