<html>
<head>
    <title>Ranking</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Cyclist position in stage</a>
    </nav>
    <div class="container">
        <div class="custom-template ">
                     

            <form action="process.php" method="GET">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="CodC">Cyclist Code</label>
                    <div class="col-sm-10">
                    <select class="form-control"  name="CodC">
                    <option value="Select a code" title="Select a code"></option>
                    <?php

                $con = mysqli_connect('localhost','root','','exercise1');
                if (mysqli_connect_errno()) {
                    die ('connection to database failed: ' . mysqli_connect_errno());
                }
                
                $query = "SELECT CodC FROM cyclist";

                $result = mysqli_query($con,$query);

                if( !$result ){
                  die('Query error: ' . mysqli_error($con));
                }
                while ($row = mysqli_fetch_row($result)) {
                  $option = $row[0];
                  echo "<option value=$option>$option</option>";
                }


                ?>
                 </select>

                    </div>
                </div>
                <div class="form-group row" >
            </br>
                    <label class="col-sm-2 col-form-label" for="CodS">Stage Code</label>
                    <div class="col-sm-10">
                        <input id="CodS" class="form-control" type="text" name="CodS">
                    </div>
                </div>
                
                
                <input class="btn btn-primary" type="submit" value="Send" />
                <input class="btn" type="reset" value="Cancel" />
            </form>
        </div>
    </div>   
</div>
</body>
</html>


