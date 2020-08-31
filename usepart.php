<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>操作</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6"><button type="button" class="btn btn-lg btn-primary btn-block">Button 1</button></div>
        <div class="col-sm-6"><button type="button" class="btn btn-lg btn-success btn-block">Button 2</button></div>
        </div>  
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6"><button type="button" class="btn btn-lg btn-primary btn-block">Button 1</button></div>
        <div class="col-sm-6"><button type="button" class="btn btn-lg btn-success btn-block">Button 2</button></div>
        </div>  
    </div>
    <?php
        @$userID = $_SESSION["ID"];
        require("linksql.php");
        $sql = "select user, d.ID, password, money ,date, actionList 
        FROM userdata d
        join userList l on l.ID = d.ID
        where d.ID = '$userID';";
        $revalue = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($revalue);
        // var_dump($row);
        if($row == NULL){
            echo "<p class='text-danger'>違法操作</p>";
        }
        else{
            echo $row["user"] . "<br>";
            echo $row["ID"] . "<br>";
            echo $row["password"] . "<br>";
            echo $row["money"] . "<br>";
            echo $row["date"] . "<br>";
            echo $row["actionList"] . "<br>";
        }
    ?>
</body>
</html>