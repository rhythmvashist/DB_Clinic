<?php 
    require('config_/config.php');
    require('config_/db.php');
       
    if(isset($_POST['submit'])){
        $userEmail = htmlentities($_POST['uEmail']);
        $userPassword = htmlentities($_POST['uPassword']);
        $query = "SELECT userID, userName FROM user WHERE email = '$userEmail' AND userPassword = '$userPassword' ";
        if (mysqli_query($conn, $query)){
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            session_start();
            session_destroy();
            session_start(); //Start the session
            if(isset($user[0]["userName"])){
                $_SESSION['uName'] = $user[0]["userName"];
                $_SESSION['uID'] = $user[0]["userID"];
                $_SESSION['loggedin'] = true;
                header('Location: index.php');
            }
            else{
                echo "Login error";
            }
            
        }
        
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
	 <link rel="stylesheet" href="css/styleslogin.css">
</head>
<body>
<h1>DB Clinic</h1> <a href="index.php"><img src="css/logosymbol.png" alt="logo database" height="100" width="100" ></a> 
<div class="whiteboxinner">
<h2>DB Clinic Login</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Email: <input type="email" name="uEmail">
        <br><br>
        Password: <input type="password" name="uPassword">
        <br><br>
        <input type="submit" name="submit" value="Log In">
    </form>
    <a href="docLogin.php">Staff log in</a>
    <br>
    <a href="register.php">Register</a>
	</div>
</body>
</html>