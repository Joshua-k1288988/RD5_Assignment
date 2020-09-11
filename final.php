<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>交易明細</title>
</head>
<body>
    <div class = "text-center">
        <h3>交易明細</h3>
    </div>
    <?php
        @$userID = $_SESSION["ID"];
        require("linksql.php");
        $sql = "select user, d.ID, money ,date, actionList 
        FROM userdata d
        join userList l on l.ID = d.ID
        where d.ID = '$userID';";
        $revalue = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($revalue);
        // var_dump($row);
        if($row == NULL){
            echo "<h2 class='text-danger text-center'>違法操作，請重新登入</h2>";
            // exit();
        }
        else{
            echo "<table class = 'table table-striped container'>
            <tbody>";
            echo "<tr><td><h4 class = 'text-center'>使用者：</h4></td> <td><h4>" . $row["user"] . "</h4></td></tr><br>";
            echo "<tr><td><h4 class = 'text-center'>帳號：</h4></td> <td><h4>" . $row["ID"] . "</h4></td></tr><br>";
            echo "<tr><td><h4 class = 'text-center'>目前餘額：</h4></td> <td><h4>$" . $row["money"] . "</h4></td></tr><br>";
            echo "<tr><td><h4 class = 'text-center'>交易日期：</h4></td> <td><h4>" . $_SESSION["date"] . "</h4></td></tr><br>";
            echo "<tr><td><h4 class = 'text-center'>交易明細：</h4></td> <td><h4>" . $_SESSION["actionList"] . "</h4></td></tr><br>";
            echo "</tbody>
            </table>";
            $_SESSION = array();
            
        }
    ?>
    <form method = "post">
    <div class="form-group row" >
        <div class="offset-5 col-6 center">
        <button name="home" type="submit" class="btn btn-outline-primary ">回首頁</button>
        </div>
    </div>
    </form>
    <?php
        if(isset($_POST["home"])){
            header("Location: index.php");
            exit();
        }
    ?>
</body>
</html>