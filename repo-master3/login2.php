<?php 
session_start(); 
include "db_connn.php";

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['level'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $level = validate($_POST['level']);

    if (empty($uname)) {
        header("Location: index.php?error=Email is required");
        exit();
    } else if(empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM professor WHERE email='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_name'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['level'] = $level;

            // Rediriger vers home.php pour la vérification du niveau et de la session
            header("Location: home2.php");
            exit();
        } else {
            header("Location: index2.php?error=Incorrect email or password");
            exit();
        }
    }
} else {
    header("Location: index2.php");
    exit();
}
?>
