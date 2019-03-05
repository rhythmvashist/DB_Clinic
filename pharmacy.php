<?php include('config_/userLogIN.php'); ?>
<?php          
    require('config_/config.php');
    require('config_/db.php');
    $ordered = 0;
    $suggest = 0;
 
    if ($loggedIn == 1){
        $query2 = "SELECT email, address FROM user where userid = '$userID'";
        $result2 = mysqli_query($conn, $query2);
        $userEmailArray = mysqli_fetch_all($result2, MYSQLI_ASSOC);

        $userEmail = $userEmailArray[0]['email'];
        $userAddress = $userEmailArray[0]['address'];
    }
    if(isset($_POST['order'])){
        
        $yourName = htmlentities($_POST['YourName']);
        $yourEmail = htmlentities($_POST['Email']);
        $deliveryAddress = htmlentities($_POST['Address']);
        $quantity = htmlentities($_POST['Quantity']);
        $arrivalDate = date('Y-m-d', strtotime("+5 day"));

        $medID = (int)($_POST['medID']);

        if($loggedIn == 0){
            $query5 = "INSERT INTO user(userName, email, address) Values ('$yourName', '$yourEmail', '$deliveryAddress')";
            if (mysqli_query($conn, $query5)){
            }
            else{
                echo "ERROR: " . mysqli_error($conn);
            } 
            $query6 = "SELECT userID FROM user WHERE email = '$yourEmail' ";
            if (mysqli_query($conn, $query6)){
                $result6 = mysqli_query($conn, $query6);
                $user = mysqli_fetch_all($result6, MYSQLI_ASSOC);
                $userID = $user[0]['userID'];
            }
        
            }
        
        $query3 = "INSERT INTO orders(medID, userID, arrivalDate, quantity, DeliveryAddress) Values ('$medID', '$userID', '$arrivalDate', '$quantity', '$deliveryAddress')";
        $ordered = 1;
        if (mysqli_query($conn, $query3)){
            $query4 = "UPDATE medicine_info SET quantity=quantity - '$quantity' WHERE MedID='$medID' ";
            if (mysqli_query($conn, $query4)){
                $updated = 1;
            }
            else{
                echo "ERROR: " . mysqli_error($conn);
            }
            
        }
        else{
            echo "ERROR: " . mysqli_error($conn);
        }
    }
    
    $query = "SELECT * FROM medicine_info"; 
    $result = mysqli_query($conn, $query);

    // fetch data into an associative array
    $medicines = mysqli_fetch_all($result, MYSQLI_ASSOC);
    


    // free result
    mysqli_free_result($result);

    // If user applies any filter, then update the array
    if(isset($_POST['submit'])){
        $medNames = htmlentities($_POST['medNames']);
        $medInfo = htmlentities($_POST['medInfo']);
        $maxPrice = htmlentities($_POST['maxPrice']);
        $newArray = array();
        if ($medNames == "" && $maxPrice == "" && $medInfo == ""){
            $medicines = $medicines;
        }
        else{
            if ($maxPrice == ""){
                $maxPrice = 999999999;
            }
            foreach($medicines as $medicine):
                $medInDatabase = $medicine["Name"];
                $infoInDatabase = $medicine["Info"];
                if ($medNames == "" || $medNames == "All"){
                    $medInDatabase = "All";
                    $medNames = "All";
                }
                if ($medInfo == "" || $medInfo == "All"){
                    $infoInDatabase = "All";
                    $medInfo = "All";
                }
                if (strpos(strtoLower($medInDatabase), strtolower($medNames)) !== false ){
                    if (strpos(strtoLower($infoInDatabase), strtolower($medInfo)) !== false){
                        if ($medicine["Cost"] <= $maxPrice){
                            $newArray[] = $medicine;
                        }
                    }
                }
            endforeach;    
            $medicines = $newArray;
            if($maxPrice == 999999999){
                $maxPrice = "";
            }
            if ($medNames == "All"){
                $medNames = "";
            }
            if ($medInfo == "All"){
                $medInfo = "";
            }
        }
        
    }

    if (isset($_POST['suggest'])){
        $medName = htmlentities($_POST['medName']);
        $medInfo = htmlentities($_POST['medInfo']);

        $query6 = "INSERT INTO suggest(medName, medInfo) Values ('$medName', '$medInfo')"; 
        

        if (mysqli_query($conn, $query6)){
            $suggest = 1;
        }
        else{
            $suggest = 2;
        }

    }

    
                
    $overlayCounter = 1;
    $conn->close();
    ?>

    <?php include('inc/header.php'); ?>        
    <?php include('inc/navbar.php'); ?>        
    <section>
    <button style="margin:auto; text-align:center" class="openbtn" onclick="openForm()">Suggest a medicine</button>
        <div id="myOverlay" class="overlay">
                    <span class="closebtn" onclick="closeForm()" title="Close Overlay"> &#215 </span>
                    <div class="wrap">
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="order">
                            Medicine Name: <input name="medName" type="text" value="" required>
                            About Medicine: <input name="medInfo" type="text" value="">
                            <input type="submit" name="suggest" value="Suggest Medicine">
                        </form>
                    </div>
                </div>
        <div class="Home">
            <br>
            <div>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="text" name="medNames" placeholder="Medicines" value="<?php echo isset($_POST["medNames"]) ? $medNames : ""; ?>" style="height:30px">
                    <input type="text" name="medInfo" placeholder="Keywords (eg. stomach, headace)" value="<?php echo isset($_POST["medInfo"]) ? $medInfo : ""; ?>"  style="height:30px">
                    <input type="number" min="0" name="maxPrice" placeholder="Max Price" value="<?php echo isset($_POST["maxPrice"]) ? $maxPrice : ""; ?>"  style="height:30px">
                    <input type="submit" name="submit" value="Search" style="height:30px">
                </form>
            </div>
            <div class="section2">
                <?php foreach($medicines as $medicine): ?> 
                    <div class="container">
					<img src="<?php echo $medicine["medImage"]?>" height="200px" width="200px" alt="medicine" onerror=this.src="https://images.pexels.com/photos/860378/pexels-photo-860378.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                        <h1><?php echo $medicine["Name"]; ?></h1>
                        <p><?php echo $medicine["Info"]; ?></p>
                        <p>Cost: $<?php echo $medicine["Cost"]; ?> Quantity Left: <?php echo $medicine["quantity"]; ?></p>
                        <button class="openbtn" onclick="openForm<?php echo $overlayCounter; ?>()">Buy Medicine</button>
                    </div>  
                <div id="myOverlay<?php echo $overlayCounter; ?>" class="overlay">
                    <span class="closebtn" onclick="closeForm<?php echo $overlayCounter; ?>()" title="Close Overlay"> &#215 </span>
                    <div class="wrap">
                        <h2><?php echo $medicine["Name"] ?></h2>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="order">
                            <input type="hidden" name="medID" value="<?php echo $medicine["MedID"]; ?>">
                            Your Name: <input name="YourName" type="text" value="<?php if ($loggedIn == 1) echo $userName; ?>" required>
                            Email: <input name="Email" type="text" value="<?php if ($loggedIn == 1) echo $userEmail; ?>" required>
                            Delivery Address: <input name="Address" type="text" value="<?php if ($loggedIn == 1) echo $userAddress; ?>" required>
                            Quantity: <input name="Quantity" class="half" type="number" min="1" max="<?php echo $medicine["quantity"]; ?>" value="0" onclick="myFunction()"  required>
                            Medicine Cost: $<?php echo $medicine["Cost"]; ?>
                            <p>Payment Info</p>
                            <hr>
                            Card No: <input type="number" required>
                            CVV: <input class="half" type="number" required>
                            Expiry Date: <input class="half" type="text" required>
                            <input type="submit" name="order" value="Confirm Order">
                        </form>
                    </div>
                </div>
                <script>
                        function openForm<?php echo $overlayCounter; ?>(){
                            document.getElementById("myOverlay<?php echo $overlayCounter; ?>").style.display = "block";
                        }
                        function closeForm<?php echo $overlayCounter; ?>(){
                            document.getElementById("myOverlay<?php echo $overlayCounter; ?>").style.display="none";
                        }
                </script>
                <?php $overlayCounter++; ?>
  
                <?php endforeach; ?>
            </div>
            <div id="snackbar">
                <?php
                    if($ordered == 1){
                        ?>
                            <script>myMessege();</script>        
                        <?php  
                        echo "Order Confirmed";
                    }
                ?>
                <?php
                    if($suggest == 1){
                        ?>
                            <script>myMessege();</script>        
                        <?php  
                        echo "New Medicine Suggested";
                    }
                    if($suggest == 2){
                        ?>
                            <script>myMessege();</script>        
                        <?php  
                        echo "Medicine Already Suggested";
                    }
                ?>

            </div>
        </div>
    </section>


<?php include('inc/footer.php'); ?>        
    