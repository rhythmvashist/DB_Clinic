<?php include('config_/userLogIN.php'); ?>

<?php
    require('config_/config.php');
    require('config_/db.php'); 
    $passwordChanged = 0;
    $addressChanged = 0;
    $paymentChanged = 0;

    if(isset($userID)){

    }
    else{
        header('Location: login.php');        
    }
    
    $currDate = date('Y-m-d');
    if(isset($_POST['currOrders']) || isset($_POST['oldOrders'])){
        if (isset($_POST['currOrders'])){
            $query1 = "SELECT medicine_info.name, orders.quantity, orders.arrivalDate FROM medicine_info, orders WHERE orders.userID = '$userID' AND orders.medid=medicine_info.MedID AND arrivalDate >= '$currDate' ";
        }
        else{           
            $query1 = "SELECT medicine_info.name, orders.quantity, orders.arrivalDate FROM medicine_info, orders WHERE orders.userID = '$userID' AND orders.medid=medicine_info.MedID AND arrivalDate < '$currDate'  ";
        }
        $result1 = mysqli_query($conn, $query1);    
        $orders = mysqli_fetch_all($result1, MYSQLI_ASSOC);
        mysqli_free_result($result1);
    }

    if(isset($_POST['appointments']) || isset($_POST['appointmentsHistory'])){
        if (isset($_POST['appointments'])){
            $query2 = "SELECT appointmentDate, appointmentTime, appointmentDay, doctor.docName, room FROM appointments, doctor WHERE appointments.docid=doctor.docid AND appointments.userID = '$userID' AND appointments.appointmentDate >= '$currDate' ";
        }
        else{           
            $query2 = "SELECT appointmentDate, appointmentTime, appointmentDay, doctor.docName, room FROM appointments, doctor WHERE appointments.docid=doctor.docid AND appointments.userID = '$userID' AND appointments.appointmentDate < '$currDate' ";
        }
        $result2 = mysqli_query($conn, $query2);
        $appointments = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        mysqli_free_result($result2);
    }

    
?>

<?php include('inc/header.php'); ?>        
<?php include('inc/navbar.php'); ?>           
    <section style="background:#F0FFFF">
        <br>
        <div class="Home" style="width:1000px; padding:20px; border:6px solid lightsteelblue ">
            <form method="POST"  action="<?php echo $_SERVER["PHP_SELF"]; ?>" style="width:100%">
                <input type="submit" name="currOrders" value="Current Orders" style="font-size:20px; width:300px">
            </form>
            <div>
            <?php if(isset($_POST['currOrders'])){ 
                foreach($orders as $order):    
            ?> <div style="border:2px solid lightsteelblue; width:400px; margin:auto; text-align:center; background-color:white; margin-bottom:20px">
                <p>Medicine Name: <?php echo $order["name"] ?></p>
                <p>Date Arriving: <?php echo $order["arrivalDate"] ?></p>
                <p>Quantity Ordered: <?php echo $order["quantity"] ?></p>
                </div> <?php endforeach; ?>
                
            <?php } ?>
                
    
            <form method="POST"  action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="submit" name="oldOrders" value="Old Orders" style="font-size:20px; width:300px">
            </form>

            <?php if(isset($_POST['oldOrders'])){ 
                foreach($orders as $order):    
            ?>  <div style="border:2px solid lightsteelblue; width:400px; margin:auto; text-align:center; background-color:white; margin-bottom:20px">
                <p>Medicine Name: <?php echo $order["name"] ?></p>
                <p>Date received: <?php echo $order["arrivalDate"] ?></p>
                <p>Quantity Ordered: <?php echo $order["quantity"] ?></p>
                </div> <?php endforeach; ?>
            <?php } ?>

            <form method="POST"  action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="submit" name="appointments" value="Your Appointments" style="font-size:20px; width:300px">
            </form>

            <?php if(isset($_POST['appointments'])){ 
                foreach($appointments as $appointment):    
            ?><div style="border:2px solid lightsteelblue; width:400px; margin:auto; text-align:center; background-color:white; margin-bottom:20px">
                <p>Doctor Name: <?php echo $appointment["docName"] ?></p>
                <p>Appointment Date: <?php echo $appointment["appointmentDate"] ?></p>
                <p>Appointment Time: <?php echo $appointment["appointmentTime"] ?></p>
                <p>Appointment Day: <?php echo $appointment["appointmentDay"] ?></p>
                <p>Room No. : <?php echo $appointment["room"] ?></p>
                </div> <?php endforeach; ?>
            <?php } ?>

            <form method="POST"  action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="submit" name="appointmentsHistory" value="Appointments History" style="font-size:20px; width:300px">
            </form>

            <?php if(isset($_POST['appointmentsHistory'])){ 
                foreach($appointments as $appointment):    
            ?><div style="border:2px solid lightsteelblue; width:400px; margin:auto; text-align:center; background-color:white; margin-bottom:20px">
                <p>Doctor Name: <?php echo $appointment["docName"] ?></p>
                <p>Appointment Date: <?php echo $appointment["appointmentDate"] ?></p>
                <p>Appointment Time: <?php echo $appointment["appointmentTime"] ?></p>
                <p>Appointment Day: <?php echo $appointment["appointmentDay"] ?></p>
                <p>Room No. : <?php echo $appointment["room"] ?></p>
                </div> <?php endforeach; ?>
            <?php } ?>
                
            <button style="font-size:20px; width:300px" onclick="openForm()">Change Password</button>        
            <div id="myOverlay" class="overlay">  
                 <span class="closebtn" onclick="closeForm()" title="Close Overlay"> &#215 </span>
                 <div class="wrap">
                    <h1>Change Password</h1>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="order">
                        Old Password: <input type="password" name="password0">
                        New Password: <input type="password" name="password1">
                        Confirm Password: <input type="password" name="password2">
                        <input type="submit" name="pass" value="Change Password" >
                    </form>
                </div>
             </div>

             <?php
                 if(isset($_POST['pass'])){ 
                    $oldpassword = htmlentities($_POST['password0']);
                    $newpassword = htmlentities($_POST['password1']);
                    $conpassword = htmlentities($_POST['password2']);
             
                    //query
                    $query0="SELECT userPassword FROM user WHERE userid=$userID";
                        
                    // get resul
                    $result0=mysqli_query($conn,$query0);
                    //fetch data
                    $post=mysqli_fetch_all($result0,MYSQLI_ASSOC);
                    //FREE THE RESULT
                    mysqli_free_result($result0);
                 
                    if($oldpassword==$post[0]["userPassword"]){
                        if($newpassword==$conpassword){
                            $query="UPDATE user SET userPassword = '$conpassword' WHERE userid=$userID";
                            if (mysqli_query($conn, $query)){
                                $passwordChanged = 1;
                            }
                            else{
                            }
                            
                        }
                        else{
                        } 
                    }
                    else{
                    }
                }            
             ?>


            <br><br>


              <button style="font-size:20px; width:300px" onclick="openForm2()">Update your Address </button>        
            <div id="myOverlay2" class="overlay">  
                 <span class="closebtn" onclick="closeForm2()" title="Close Overlay"> &#215 </span>
                 <div class="wrap">
                    <h1>Update Address</h1>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="order">
                        Your Address: <input name="adds" type="text" value="" required>
                        <input type="submit" name="uaddress" value="Update Address ">
                    </form>
                </div>
             </div>

            <?php 
                if(isset($_POST['uaddress'])){ 
                        $newaddress=htmlentities($_POST['adds']);

                        $query0="UPDATE  user SET address='$newaddress' WHERE userid='$userID';";
                        if(mysqli_query($conn,$query0)){
                            $addressChanged = 1;
                        }
                        else{
                        }
                    
                }
            ?>

                <br><br>

          
                 
            <button style="font-size:20px; width:300px" onclick="openForm3()">Manage your Payment info </button>        
            <div id="myOverlay3" class="overlay">  
                 <span class="closebtn" onclick="closeForm3()" title="Close Overlay"> &#215 </span>
                 <div class="wrap">
                    <h1>Update Payment info </h1>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="order">
                        Card Number: <input name="cno" type="text" value="" required>
                        CVV: <input name="cvv" type="password" value="">
                        Expiry date: <input name="date" type="text" value="">
                        <input type="submit" name="Upcard" value="Update">
                    </form>
                </div>
             </div>

    
         <?php 
            if(isset($_POST['Upcard'])){ 

              $card= htmlentities($_POST['cno']);
              $cvv= htmlentities($_POST['cvv']);
              $exdate= htmlentities($_POST['date']);

              $querypay = "SELECT * FROM payment_info where userID='$userID'";
              $resultpay = mysqli_query($conn, $querypay);

                // fetch data into an associative array
                $paymentInfo = mysqli_fetch_all($resultpay, MYSQLI_ASSOC);

                if (isset($paymentInfo[0]['userID'])){
                    $query0="UPDATE payment_info SET cardNumber='$card', cvv='$cvv',expiryDate='$exdate' where userID='$userID';";
                  
                    if(mysqli_query($conn,$query0)){
                        }
                    else{
                    }
                }
                else{
                    $queryinsert = "INSERT INTO payment_info(userID, cardNumber, cvv, expiryDate) Values ('$userID','$card', '$cvv', '$exdate')";
                    if (mysqli_query($conn, $queryinsert)){ 
                     }
                    else{
                    }
                }
                $paymentChanged = 1;

              
            }
         ?>
         <div id="snackbar">
                <?php
                    if($passwordChanged == 1){
                        ?>
                            <script>myMessege();</script>        
                        <?php  
                        echo "Password Updated";
                    }
                ?>
                <?php
                    if($addressChanged == 1){
                        ?>
                            <script>myMessege();</script>        
                        <?php  
                        echo "Address Updated";
                    }
                    if($paymentChanged == 1){
                        ?>
                            <script>myMessege();</script>        
                        <?php  
                        echo "Payment Info Updated";
                    }
                ?>

            </div>

            <div class="section1"></div>
        </div>
    </section>
<?php include('inc/footer.php'); ?>        
