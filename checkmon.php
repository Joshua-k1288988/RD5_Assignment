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

    <title>餘額查詢</title>
</head>
<body>
<br>
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
            header("Location: worng.php");
            exit();
        }
        else{
            echo "<h3 class = 'text-center'>餘額查詢</h3>" . "<br>";
            echo "<h4 class = 'text-center'>使用者：  " . $row["user"] . "</h4><br>";
            echo "<h4 class = 'text-center'>帳號：    " . $row["ID"] . "</h4><br>";
            echo "<h4 class = 'text-center'>目前餘額：" . $row["money"] . "</h4><br>";
        }
    ?>
    <form method = "post">
    <div class="form-group row" >
        <div class="offset-5 col-6 center">
        <button name="home" type="submit" class="btn btn-info ">回上一頁</button>
        </div>
    </div>
    </form>
    <?php
        if(isset($_POST["home"])){
            header("Location: usepart.php");
            exit();
        }
    ?>
</body>
</html>