<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: looogin.php");
} else {
   // التحقق مما إذا كان المستخدم قد دخل لأول مرة
   if (!isset($_SESSION["first_login"])) {
       $_SESSION["first_login"] = true; // تعيين متغير الجلسة للدخول الأول
       header("Location: dashboard.php");
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index-style.css">
    
    <title>User Dashboard</title>
</head>
<body>
    
<div class="container">
        <h1> Thank You , Come Back To See The Result</h1>
        <a href="loguuut.php" class="btn btn-warning">Loguuut</a>
</body>
</html>
