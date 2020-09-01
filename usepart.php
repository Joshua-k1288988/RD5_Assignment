<?php
    session_start();
    @$userID = $_SESSION["ID"];
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

    <?php
        require("linksql.php");
        $sql = "select user, d.ID, password, money ,date, actionList 
        FROM userdata d
        join userList l on l.ID = d.ID
        where d.ID = '$userID';";
        $revalue = mysqli_query($link, $sql);
        mysqli_close($link);
        $row = mysqli_fetch_assoc($revalue);
        // var_dump($row);

        if($row == NULL){
            echo "<h2 class='text-danger text-center'>違法操作，請重新登入</h2>";
            exit();
        }
        else{
            echo "<h4 class='text-primary text-center'>你好！" . $row["user"] . "</h4><br>";
            echo "<h4 class='text-primary text-center'>目前餘額：" . $row["money"] . "</h4><br>";
        }
    ?>
    <div class = "text-center">
        <h1>請選擇服務項目</h1>
    </div>
    <form method = "post">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><button type="submit" name = "takemoney" class="btn btn-lg btn-primary btn-block">提款</button></div>
                <div class="col-sm-6"><button type="submit" name = "pushmoney" class="btn btn-lg btn-success btn-block">存款</button></div>
            </div>  
        </div>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><button type="submit" name = "checkmoney" class="btn btn-lg btn-warning btn-block">餘額查詢</button></div>
                <div class="col-sm-6"><button type="submit" name = "checkList" class="btn btn-lg btn-secondary btn-block">查看明細</button></div>
            </div>  
        </div>
    </form>
    <br><br>
    <?php 
        if(isset($_POST["takemoney"])){
            // include("test.php");
            header("Location: takemon.php");
            exit();
        }
        if(isset($_POST["pushmoney"])){
            header("Location: pushmon.php");
            exit();
        }
        if(isset($_POST["checkmoney"])){
            header("Location: checkmon.php");
            exit();
        }
        if(isset($_POST["checkList"])){
            header("Location: checkLst.php");
            exit();
        }
    ?>
</body>
</html>