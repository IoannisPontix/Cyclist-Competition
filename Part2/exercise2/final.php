<html>
    <head>
        <title>Final Result</title>
        
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	      <link rel="stylesheet" href="./bootstrap.min.css">
	      <link rel="stylesheet" href="./style.css">
        <body>




<?php

function get_alert_html($error){
	return '<div class="alert alert-danger" role="alert">'. $error. '</div>';
}

function get_success($success){
  return '<div class="alert alert-success" role="alert">'. $success. '</div>';
}

// VALIDATE FORM PARAMETERS

if( !isset($_REQUEST["CodC"]) or 
		!isset($_REQUEST["CodS"]) or 
        !isset($_REQUEST["Edition"]) or
        !isset($_REQUEST["Ranking"]) 
) {
    $error_message = "Error not all data have been inserted...";
    print(get_alert_html($error_message));
    die();
}

if(!is_numeric($_REQUEST["Ranking"])) {
    $error_message = "Ranking should only be a number!";
    print(get_alert_html($error_message));
    die();
}

if(($_REQUEST["Ranking"])<=0) {
    $error_message = "Ranking cannot take zero , or negative values!!";
    print(get_alert_html($error_message));
    die();
}


      //GET VALUES

     $CodC= $_REQUEST["CodC"];
     $CodS= $_REQUEST["CodS"];
     $Edition = $_REQUEST["Edition"];
     $Ranking = $_REQUEST["Ranking"];
     //AND TO CHANGE COLOR THE BOXES
     
     // DATABASE CONNECTION --- TO COMPARE RANKING WITH RANKING ENTERED BY THE USER
 //AND STORE INTO DB




$con = mysqli_connect('localhost', 'root', '', 'exercise2');
if(mysqli_connect_errno())
{
    $error_message = "Connection to mysql server could not be established.";
        print(get_alert_html($error_message));
        die();
}
$resultArr = array();//to store results
//to execute query
$executingFetchQuery = $con->query("SELECT `Ranking` FROM individual_classification WHERE 1");
if($executingFetchQuery)
{
   while($arr = $executingFetchQuery->fetch_assoc())
   {
        $resultArr[] = $arr['Ranking'];//storing values into an array
   }
}

/* // ARRAY CHECKING!!!!!!!!
echo "<pre>"; 
print_r($resultArr);//print the rows returned by query, containing specified columns
echo "</pre>"; 
*/

//DONE


//CHECK INPUT POSITION
     $arr_length = count($resultArr);
     for($i=0;$i<$arr_length;$i++){
        if($resultArr[$i] == $Ranking) {
            $error_message = "Position already exists! New data cant be stored in database.";
            print(get_alert_html($error_message));
            die();
        }
     }



     //START TRANSACTION //

  $executingFetchQuery = "INSERT INTO individual_classification (CodC,CodS,Edition,Ranking)
     VALUES ('$CodC','$CodS','$Edition','$Ranking')";
     
     
     if ($con->query($executingFetchQuery) === TRUE) {
        print(get_success('Record created successfully and is stored in database!'));
     } else {
        echo "Error: " . $executingFetchQuery . "<br>" . $con->error;
        $con->close();
     }
        


?>

    </body>
    </head>
    </html>