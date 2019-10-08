<?php include('config_/userLogIN.php'); ?>

<?php 
 require('config_/config.php');
    require('config_/db.php');
	
	 $tablequery = "SELECT medicine_info.MedID, name, cost, medImage, count(*) FROM medicine_info,orders 
WHERE medicine_info.MedID=orders.MedID AND medicine_info.MedID IN (SELECT medID FROM orders
GROUP BY medID 
ORDER BY count(*)                             
)
GROUP BY orders.medId 
LIMIT 3"; 
    $tableresult = mysqli_query($conn, $tablequery);
	
	$topmedicines = mysqli_fetch_all($tableresult, MYSQLI_ASSOC);
	
	
$recentsquery = "SELECT * FROM medicine_info 
ORDER BY MedID DESC limit 3";

$recentsresult = mysqli_query($conn, $recentsquery);


$recentmedicines = mysqli_fetch_all($recentsresult, MYSQLI_ASSOC);

$division = "SELECT d.docid, d.docname, d.doctype
FROM doctor d
WHERE NOT EXISTS (SELECT app.docid
                  FROM appointments app
                  WHERE NOT EXISTS (SELECT da.docid
                                    FROM appointments a, docavailability da
                                    WHERE da.Docdate = a.appointmentdate and da.Doctime=a.appointmentTime and da.Docday=a.appointmentDay and d.docid=a.docid
                                    ))";
$divisionresult= mysqli_query($conn, $division);

$allbooked = mysqli_fetch_all($divisionresult, MYSQLI_ASSOC);

?>


<?php include('inc/header.php'); ?>        
<?php include('inc/navbar.php'); ?>
    <section class="HomePage">
        <div class="Home">
            <h1 class="homepagetitle">Welcome to DB Clinic</h1>
			
			
            <div class="section1">
		
			<div class="sidebar">
			<div class="booked" style="float:right;">
 <a href="division.php"> <button class="dropbtn" style="font-size:30px" > ALL BOOKED </button> </a>
  
</div>
</div>

			<div class="bigbox1">
			<h3 class="hometext"> Top Selling Medicines <i class="fas fa-star" id="starhome"></i></h3>
			<div class="box1">
			
		<p> <?php echo $topmedicines[0]['name']?> </p>
<p>$<?php echo $topmedicines[0]['cost']?> </p>	
<img src="<?php echo $topmedicines[0]['medImage']?>" height="200px" width="200px">	
<p> Sold: <?php echo $topmedicines[0]['count(*)']?></p>
	</div>
			<div class="box2">	<p> <?php echo $topmedicines[1]['name']?> </p>
<p> $<?php echo $topmedicines[1]['cost']?> </p>		
<img src="<?php echo $topmedicines[1]['medImage']?>" height="200px" width="200px">	<p> Sold: <?php echo $topmedicines[1]['count(*)']?></p>
</div>
				<div class="box3">	<p> <?php echo $topmedicines[2]['name']?> </p> <p>$<?php echo $topmedicines[2]['cost']?> </p>		
<img src="<?php echo $topmedicines[2]['medImage']?>" height="200px" width="200px">	<p> Sold: <?php echo $topmedicines[2]['count(*)']?></p>
</div>
			
			</div>
        </div>
		
		<br><br><br> 

		
		<div class="bigbox2">
		<h3 class="hometext">Recently Added Medicines</h3>
		<div class="box1a">
		<p> <?php echo $recentmedicines[0]['Name']?></p>
		<p> $<?php echo $recentmedicines[0]['Cost']?></p>
		<img src="<?php echo $recentmedicines[0]['medImage']?>" height="200px" width="200px">
		</div>
		<div class="box1b">
		<p> <?php echo $recentmedicines[1]['Name']?></p>
		<p> $<?php echo $recentmedicines[1]['Cost']?></p>
		<img src="<?php echo $recentmedicines[1]['medImage']?>" height="200px" width="200px">
		
		</div>
		<div class="box1c">
		<p> <?php echo $recentmedicines[2]['Name']?></p>
		<p> $<?php echo $recentmedicines[2]['Cost']?></p>
		<img src="<?php echo $recentmedicines[2]['medImage']?>" height="200px" width="200px">
		</div>
	
		
		</div>
		
		
		
		
		
    </section>
<?php include('inc/footer.php'); ?>        
