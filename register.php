<?php 
    require('config_/config.php');
    require('config_/db.php');
    
      
    if(isset($_POST['submit'])){
        $userName = htmlentities($_POST['uName']);
        $userEmail = htmlentities($_POST['uEmail']);
        $userPassword1 = htmlentities($_POST['password1']);
        $userPassword2 = htmlentities($_POST['password2']);
        if ($userPassword1 != $userPassword2){
            echo "Passwords does not match";
        }
        else{
            $query = "INSERT INTO user(userName, userPassword, email) Values ('$userName', '$userPassword1', '$userEmail')"; 
        
            if (mysqli_query($conn, $query)){ 
                header('Location: login.php ');
             }
            else{
                echo "ERROR: " . mysqli_error($conn);
            }
    }
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Log In</title>
</head>
<body class="red">
<h1>Sign up with DB Clinic</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Name: <input type="text" name="uName" required>
        <br>
        Email:            <input type="email" name="uEmail" required>
        <br>
        Password:        <input type="password" name="password1" required>
        <br>
        Confirm Password: <input type="password" name="password2" required>
        <br>
        <input type="submit" name="submit" value="Register" style="height:40px;width:100px;">
    </form>
</body>
</html>