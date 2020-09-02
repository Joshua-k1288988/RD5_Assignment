<?php
    session_start();
    if(@$_SESSION["ID"] == NULL){
        header("Location: worng.php");
        exit();
    }
    $userID = $_SESSION["ID"];

    require("linksql.php");
    $sql = "select user, ID, password
    FROM userdata 
    where ID = '$userID'";
    $revalue = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>確認密碼</title>
</head>
<body>
    <br>
    <form class="container" method = "post">
        <div class="form-group row">
            <label for="password" class="col-4 col-form-label text-center">密碼</label> 
            <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fa fa-lock"></i>
                </div>
                </div> 
                <input id="password" name="password" placeholder="請輸入密碼" type="password" class="form-control">
            </div>
            </div>
        </div> 
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="btnOK" type="submit" class="btn btn-primary">確定</button>
            </div>
        </div>
    </form>
    <?php
        if(isset($_POST["btnOK"])){
            $row = mysqli_fetch_assoc($revalue); 
            $password = $_POST["password"];
            // var_dump($row);
                
            if(password_verify($password, $row["password"])){
                if($_SESSION["action"] == "takemoney"){

                    $nowTime = time();
                    $nowTime = date("Y年m月d日 H:i:s", $nowTime );
                    $count = $_SESSION["count"];
                    $takemoney = $_SESSION["money"];

                    $sql = "update userdata set
                    money = $count
                    where ID = '$userID';";
                    $revalue = mysqli_query($link, $sql);

                    $sql = "INSERT INTO `userList`(`ID`, `date`, `actionList`) VALUES
                    ('$userID', '$nowTime', '提款 $takemoney 元，餘額 $count 元');";
                    $revalue = mysqli_query($link, $sql);

                    mysqli_close($link);
                
                    $_SESSION["actionList"] = "提款 $takemoney 元，餘額 $count 元";
                    $_SESSION["date"] = $nowTime;
                    echo "<script> alert('交易成功'); location.href ='final.php';</script>";
                    // header("Location: final.php");
                    exit();
                }
                else if($_SESSION["action"] == "pushmoney"){
                    $nowTime = time();
                    $nowTime = date("Y年m月d日 H:i:s", $nowTime );
                    $pushmoney = $_SESSION["money"];
                    $count = $_SESSION["count"];


                    $sql = "update userdata set
                    money = $count
                    where ID = '$userID';";
                    $revalue = mysqli_query($link, $sql);

                    $sql = "INSERT INTO `userList`(`ID`, `date`, `actionList`) VALUES
                    ('$userID', '$nowTime', '存款 $pushmoney 元，餘額 $count 元');";
                    $revalue = mysqli_query($link, $sql);

                    mysqli_close($link);

                    $_SESSION["actionList"] = "存款 $pushmoney 元，餘額 $count 元";
                    $_SESSION["date"] = $nowTime;
                    echo "<script> alert('交易成功'); location.href ='final.php';</script>";
                    // header("Location: final.php");
                    exit();
                }
            }
            else{
                echo "<script> alert('密碼錯誤！！'); </script>";
                exit();
            }
        }
    
    ?>
</body>
</html>