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
            exit();
        }
        else{
            echo $row["user"] . "<br>";
            echo $row["ID"] . "<br>";
            echo $row["money"] . "<br>";
            
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