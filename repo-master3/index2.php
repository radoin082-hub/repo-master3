<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .logo img {
            width: 50px;
        }
        nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .nav-link {
            margin-left: 20px;
            color: #333;
            text-decoration: none;
            background-color: #777;
            color: white;
            padding: 10px 15px;
            border-radius: 15px;
        }
        .nav-link:hover {
            background-color: #8f9dc8;
        }
        form {
            width: 500px;
            border: none;
            padding: 30px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
            background-color: #a9b7e0;
            color: white;
            padding: 20px;
            border-radius: 15px;
        }
        p {
            background-color: #f2f2f2;
            color: #555;
            padding: 10px;
            border-radius: 15px;
            margin: 20px auto;
            width: 95%;
        }
        .error {
            background-color: #ff6666; /* Couleur de fond pour l'erreur */
            color: white; /* Couleur du texte pour l'erreur */
        }
        label {
            color: #0c0b0b;
            font-size: 18px;
            padding: 10px;
        }
        input, select {
            display: block;
            border: none;
            width: 95%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 15px;
            color: #000;
            background-color: #e6e6e6;
        }
        a, button {
            background-color: #a9b7e0;
            color: white;
            padding: 10px 15px;
            border-radius: 15px;
            text-decoration: none;
            border: none;
            transition: background-color 0.3s;
        }
        a:hover, button:hover {
            background-color: #8f9dc8;
        }
        .copy {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        
    </header>
    <form action="login2.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Email</label>
        <input type="text" name="uname" placeholder="Email">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password">
        <label>Select Your Level</label>
        <select name="level">
            <option value="L3">L3</option>
            <option value="M2">M2</option>
        </select>
        <a href="page2.php">Leave</a>
        <button type="submit">Login</button>
    </form>
    <div class="copy text-center py-3" style=" color: black; font-weight: bold;">
    &copy; 2024 - faculté des sciences exacte et science de vie. All Rights Reserved.
</div>
</body>
</html>