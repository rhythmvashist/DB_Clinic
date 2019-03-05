<?php 
    require('config_/config.php');
    require('config_/db.php');
       
    if(isset($_POST['submit'])){
        $docName = htmlentities($_POST['docName']);
        $docPassword = htmlentities($_POST['docPassword']);
        $query = "SELECT docid, docName FROM doctor WHERE docName = '$docName' AND docPassword = '$docPassword' ";
        if (mysqli_query($conn, $query)){
            $result = mysqli_query($conn, $query);
            $doctor = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            session_start(); //Start the session
            if(isset($doctor[0]["docName"])){
                $_SESSION['docName'] = $doctor[0]["docName"];
                $_SESSION['docid'] = $user[0]["docid"];
                $_SESSION['isDoctor'] = true;    
                header('Location: StaffArea/home.php');
            }
            else{
                echo "LogIN error";
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
<h1>DB Clinic</h1> <img src="css/logosymbol.png" alt="logo database" height="100" width="100" >
<div class="whiteboxinner">
<h2>Staff Log In</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Name: <input type="text" name="docName" required>
        <br><br>
        Password: <input type="password" name="docPassword" required>
        <br><br>
        <input type="submit" name="submit" value="Log In">
    </form>
    <a href="login.php">Login as User Instead?</a>
	</div>
</body>
</html>