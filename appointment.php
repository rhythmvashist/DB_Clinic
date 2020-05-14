<?php include('config_/userLogIN.php'); ?>

<?php 
    if(isset($userID)){}
    else{
        header('Location: login.php');        
    }
  require('config_/config.php');
  require('config_/db.php'); 
  
  if(isset($_POST['submit'])){
    $appointmentTime = str_replace("'", "", $_POST['appointmentTime']);
    $appointmentDate = str_replace("'", "", $_POST['appointmentDate']);
    $appointmentDay = str_replace("'", "", $_POST['appointmentDay']);
    $docid = (int)($_POST['Docid']);
    $room = 101;

    $currDoctor = $docid;

    $sql = "INSERT INTO appointments(userid, docid, appointmentTime, appointmentDate, appointmentDay, room) Values ('$userID', '$docid', '$appointmentTime', '$appointmentDate', '$appointmentDay', '$room')";

    if (mysqli_query($conn, $sql)){
        $sql2 = "UPDATE `docavailability` SET `Booked` = '1' WHERE `docavailability`.`Docdate` = '$appointmentDate' AND `docavailability`.`Doctime` = '$appointmentTime'";
        if (mysqli_query($conn, $sql2)){
            header('Location: staff.php ');
        }
        else{
        }
    }
    else{
    }
  }
  if(isset($_GET['submit'])){
    $currDoctor = $_GET['currDoc'];
  }

 // Schedule of the doctor with a given doctor id
  $query = "SELECT doca.Docid, doca.Docdate, doca.Docdate, doca.Docday, doca.Doctime, doc.docName, doca.Booked 
            FROM docavailability doca, doctor doc 
            WHERE doca.Docid = doc.docid AND doca.Docid = '$currDoctor' "; 
  $result = mysqli_query($conn, $query);
  $fullSchedule = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  //print_r($fullSchedule);
?>

<?php include('inc/header.php'); ?>        
<?php include('inc/navbar.php'); ?>
    <section class="apphome">
        <div class="Home">
            <div class="section2">
                <?php foreach($fullSchedule as $schedule): ?> 
                    <div class="container">
                        <h1><?php echo $schedule["docName"]; ?></h1>
                        <p><?php echo $schedule["Docdate"]; ?></p>
                        <p>Day: <?php echo $schedule["Docday"]; ?> Time: <?php echo $schedule["Doctime"]; ?></p>
                        <p>Available? <?php if ($schedule["Booked"]) echo "No"; else echo "Yes"?></p>
                        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <input type="hidden" name="Docid" value="<?php echo $schedule["Docid"]; ?>">
                                <input type="hidden" name="appointmentTime" value="'<?php echo $schedule["Doctime"]; ?>'">
                                <input type="hidden" name="appointmentDay" value="'<?php echo $schedule["Docday"]; ?>'">
                                <input type="hidden" name="appointmentDate" value="'<?php echo $schedule["Docdate"]; ?>'">
                                <input type="submit" name="submit" value="<?php if ($schedule["Booked"]) echo "Not Available"; else echo "Book an Appointment" ?>">
                        </form>                    
                    </div>    
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php include('inc/footer.php'); ?>   

