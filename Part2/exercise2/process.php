<?php

function get_alert_html($error){
	return '<div class="alert alert-danger" role="alert">'. $error. '</div>';
}

function get_success($success){
  return '<div class="alert alert-success" role="alert">'. $success. '</div>';
}


?>
<html>
    <head>
        <title>Classification-hw4</title>

        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	      <link rel="stylesheet" href="./bootstrap.min.css">
	      <link rel="stylesheet" href="./style.css">
        <body>
  <?php
  
  $flag =0;

  // VALIDATE FORM PARAMETERS
  //CodT doesnt need to be checked since number 1 is default.
  if( !isset($_REQUEST['CodC']) or 
      !isset($_REQUEST['Name']) or 
      !isset($_REQUEST['Surname']) or
      !isset($_REQUEST['BirthYear']) or
      !isset($_REQUEST['Nationality']))
      {
        $error_message = "Error: insert all requested data";
        print(get_alert_html($error_message));
        die();
      }
  
  if( !is_numeric($_REQUEST["CodC"]) or 
      is_numeric($_REQUEST["Name"]) or
      is_numeric($_REQUEST["Surname"]) or
     !is_numeric($_REQUEST["BirthYear"]) or
      is_numeric($_REQUEST["Nationality"])
 ){
   $error_message2 = "Wrong type of format!";
   print(get_alert_html($error_message2));
   die();
     
 }

   // GET FORM PARAMETERS
  $CodC = $_REQUEST["CodC"];
  $Name = $_REQUEST["Name"];
  $Surname = $_REQUEST["Surname"];
  $BirthYear = $_REQUEST["BirthYear"];
  $Nationality = $_REQUEST["Nationality"];
  $CodT= $_REQUEST["CodT"];


  // DATABASE CONNECTION
$con = mysqli_connect('localhost','root','','exercise2'); //set your username and password
if (mysqli_connect_errno())
{
  $error_message = 'Failed to connect to MySQL: ' . mysqli_connect_error();
  print(get_alert_html($error_message));
  die();
  }
  
  //START TRANSACTION //

  $sql = "INSERT INTO Cyclist (CodC,Name,Surname,Nationality,CodT,BirthYear)
  VALUES ('$CodC','$Name','$Surname','$Nationality','$CodT','$BirthYear')";

  if ($con->query($sql) === TRUE) {
  print(get_success('Record created successfully'));

  }
    
   else {
    print(get_alert_html('Record not created.'));
    die();
     
   }


?>


    <h1 style="text-align:center;">Enter personal ranking position:</h1>
   </br>
   <form action="final.php" method="POST">

   <!--Correct form for each select button...Starting ftom C.Cod-->

   <p style="text-align:center;">Cyclist Code</p>
   
 


   <div style="text-align:center">
   
   <select class="form-control"  name="CodC">


      <option value="Cyclist Code" title="Cyclist Code"></option>
      
   <?php

   $query = "SELECT CodC FROM CYCLIST";
      
   $result = mysqli_query($con,$query);

   if( !$result ) {
    print(get_alert_html('Query error'));
    die();
   }

   while ($row = mysqli_fetch_row($result)) {
     $option = $row[0];
     echo "<option value=$option>$option</option>";
   }
     ?>
     </select>
     </div>



     
   <p style="text-align:center;">Stage code</p>
   
   <div style="text-align:center">
   
   <select class="form-control"  name="CodS">

      <option value="Stage Code" title="Stage Code" ></option>
     
   <?php

   $query = "SELECT CodS FROM individual_classification";
      
   $result = mysqli_query($con,$query);

   if( !$result ) {
    print(get_alert_html('Query error'));
    die();
   }

   while ($row = mysqli_fetch_row($result)) {
     $option = $row[0];
     echo "<option value=$option>$option</option>";
   }
     ?>
     </select>
     </div>



     <p style="text-align:center;">Edition</p>
   
   <div style="text-align:center">
   
   <select class="form-control"  name="Edition">

      <option value="Edition" title="Edition"></option>
     
   <?php

   $query = "SELECT Edition FROM individual_classification";
      
   $result = mysqli_query($con,$query);

   if( !$result ) {
    print(get_alert_html('Query error'));
    die();
   }

   while ($row = mysqli_fetch_row($result)) {
     $option = $row[0];
     echo "<option value=$option>$option</option>";
   }
     ?>
     </select>
     </div>

    <p style="text-align:center;">Cyclist Position</p>
    <input type='text' style="display:block; margin : 0 auto;" maxlenth="15" name="Ranking">


    </br>
    <input class="btn btn-primary" type="submit" style="display:block; margin : 0 auto;" value="Send" />
</br>
<input class="btn" type="reset" style="display:block; margin : 0 auto;" value="Cancel" />


    </body>


    </head>



</html>