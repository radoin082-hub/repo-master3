<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['level'])) {
    // Vérifier si la session est active et que le niveau est correct
    if ($_SESSION['level'] == "L3") {
        // Rediriger vers page3.php si la session est active et le niveau est valide
        header("Location: page3.php");
        exit();
    } elseif ($_SESSION['level'] == "M2") {
        // Rediriger vers page33.php si le niveau est "M2"
        header("Location: page33.php");
        exit();
    } else {
        // Rediriger vers home.php si le niveau n'est pas valide
        header("Location: home.php");
        exit();
    }
} else {
    // Rediriger vers index.php si la session n'est pas active
    header("Location: index.php");
    exit();
}
?>
