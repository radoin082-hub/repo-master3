<?php
session_start();
require_once('config/db.php');

if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
if (isset($_POST["submit"])) {
    $firstName = $_POST["firstname"];
    $secondName = $_POST["secondname"];
    $thirdName = $_POST["thirdname"];
    $fourthName = $_POST["fourthname"];
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    $educationLevel = $_POST["education_level"];
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();
    
    if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
        array_push($errors,"All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password)<8) {
        array_push($errors,"Password must be at least 8 characters long");
    }
    if ($password !== $passwordRepeat) {
        array_push($errors,"Password does not match");
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            array_push($errors,"Email already exists!");
        }
    }

    // التحقق من إدخال أسماء التلاميذ في حالة اختيار مستوى التعليم "L3"
    if ($educationLevel === "L3") {
        if (empty($firstName) || empty($secondName) || empty($thirdName) || empty($fourthName)) {
            array_push($errors, "All four student names are required for L3 education level");
        }
    }

    if (count($errors) > 0) {
        foreach ($errors as  $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
     
        $sql = "INSERT INTO users (first_name, second_name, third_name, fourth_name, full_name, email, password, education_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $firstName, $secondName, $thirdName, $fourthName, $fullName, $email, $passwordHash, $educationLevel);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        body {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px; /* زيادة عرض الحاوية */
            margin-top: 50px; /* تباعد من الأعلى */
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #a9b7e0; /* تغيير لون البوردو */
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 20px;
        }
        .btn-primary {
            background-color: #a9b7e0; /* تغيير لون البوردو */
            border: none;
            padding: 12px 24px; /* زيادة حجم الأزرار */
            font-size: 18px;
            border-radius: 15px;
        }
        .btn-primary:hover {
            background-color: #8799c1; /* لون التحويل عند التحويل */
        }
        .alert {
            border-radius: 20px;
            padding: 15px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3 style="background-color: #a9b7e0; color: white;">Registration</h3> <!-- تغيير لون الخلفية إلى اللون البوردو -->
            </div>
            <div class="card-body">
                <form action="registration.php" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="Full Name ">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
                    </div>
                    <div class="mb-3">
                        <label for="education_level">Education Level:</label>
                        <select class="form-control" name="education_level" id="education_level">
                            <option value="L3">L3</option>
                            <option value="M2">M2</option>
                        </select>
                    </div>
                    <!-- حقول الإدخال التي تم إضافتها لتحديد أسماء التلاميذ -->
                    <div class="mb-3 name-field">
                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                    </div>
                    <div class="mb-3 name-field">
                        <input type="text" class="form-control" name="secondname" placeholder="Second Name ">
                    </div>
                    <div class="mb-3 name-field">
                        <input type="text" class="form-control" name="thirdname" placeholder="Third Name ">
                    </div>
                    <div class="mb-3 name-field">
                        <input type="text" class="form-control" name="fourthname" placeholder="Fourth Name ">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Register</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <p class="text-muted mb-0">Already Registered? <a href="looogin.php">Login Here</a></p>
            </div>
        </div>
    </div>
    <!-- الجافا سكريبت لتحديد عدد حقول الإدخال بناءً على مستوى التعليم -->
    <script>
        // تحديد عدد حقول الإدخال المطلوبة اعتمادًا على مستوى التعليم المختار
        function setNumberOfNames() {
            var educationLevel = document.getElementById("education_level").value;
            var nameFields = document.querySelectorAll(".name-field");

            // إذا كان التعليم L3، عرض 4 حقول إدخال الأسماء
            if (educationLevel === "L3") {
                nameFields.forEach(function(field) {
                    field.style.display = "block";
                });
            } else { // إذا كان التعليم M2، عرض 2 حقول إدخال الأسماء
                for (var i = 0; i < nameFields.length; i++) {
                    if (i < 2) {
                        nameFields[i].style.display = "block";
                    } else {
                        nameFields[i].style.display = "none";
                    }
                }
            }
        }

        // استدعاء الدالة عند تغيير قيمة التحديد لمستوى التعليم
        document.getElementById("education_level").addEventListener("change", setNumberOfNames);
        // تحديد عدد حقول الإدخال عند تحميل الصفحة
        setNumberOfNames();
    </script>
</body>
</html>
