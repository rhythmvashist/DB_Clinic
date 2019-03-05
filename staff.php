<?php include('config_/userLogIN.php'); ?>

<?php 
  require('config_/config.php');
  require('config_/db.php');  

  $query = "SELECT * FROM doctor"; 
  $result = mysqli_query($conn, $query);

  $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);

  if(isset($_POST['submit'])){
     $currDoctor = htmlentities($_POST['currDoc']);
     header("Location: appointment.php");
  }

  if(isset($_POST['docSearch'])){
     $docType = htmlentities($_POST['doctype']);
     $querysearch = "SELECT * FROM doctor WHERE docType LIKE '%$docType%'";
	 $resultsearch = mysqli_query($conn, $querysearch);
	 
	 $doctors = mysqli_fetch_all($resultsearch, MYSQLI_ASSOC);
  	}


?>
<?php include('inc/header.php'); ?>        
<?php include('inc/navbar.php'); ?>
<div  class="doctypeform">
<form action="<?php echo $_SERVER["PHP_SELF"];  ?>" method="POST"> 
	<input type="text" name="doctype" style="height:30px"> 
	<input type="submit" name="docSearch" value="Search by type" style="height:30px">
</form>
</div>
    <?php foreach($doctors as $doctor): ?>
	 
    <section id="doctor" class="section">
        <div class="container">
            <div class="doctor">
                
                <div>
                    <img src="<?php echo $doctor["docImage"] ?>" height="302px" width="445px" alt="">
                </div>
                <div>
                    <h2><?php echo $doctor["docName"]; ?></h2>
                    <p><?php echo $doctor["docType"]; ?></p>
                    <p><?php echo $doctor["docInfo"]; ?></p>
                    <hr>
                    <form method="GET" action="appointment.php">
                            <input type="hidden" name="currDoc" value="<?php echo $doctor["docid"] ?>">
                            <i class="fas fa-chevron-right"></i>
                            <input class= "button" type="submit" name="submit" value="Book an Appointment">
                        </form>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach; ?>
<?php include('inc/footer.php'); ?>        

