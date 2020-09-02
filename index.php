<?php
    session_start();
    $_SESSION = array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<br>
    <form class="container" method = "post">
    <div class="form-group row" >
        <label for="text1" class="col-4 col-form-label text-center">帳號</label> 
        <div class="col-8">
        <div class="input-group">
            <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fa fa-user"></i>
            </div>
            </div> 
            <input id="text1" name="userID" type="text" class="form-control">
        </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-4 col-form-label text-center" for="text">密碼</label> 
        <div class="col-8">
        <div class="input-group">
            <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fa fa-lock"></i>
            </div>
            </div> 
            <input id="text" name="userPassword" type="password" class="form-control">
        </div>
        </div>
    </div> 
    <div class="form-group row">
        <div class="offset-4 col-8">
        <button name="login" type="submit" class="btn btn-primary">登入</button>
        <button name="newUser" type="submit" class="btn btn-outline-warning">註冊</button>
        </div>
    </div>
    </form>
    <?php
        // echo date("Y年m月d日 H:i:s e T");
        if(isset($_POST["login"])){
            if($_POST["userID"] == "" || $_POST["userPassword"] == ""){
                echo "<p class='text-danger text-center'>請輸入帳號和密碼</p>";
                header("index.php");
                exit();
            }
            $userID = $_POST["userID"];
            // echo $userID . "<br>";
            $password = $_POST["userPassword"];
            // echo $password . "<br>";
            require("linksql.php");
            $sql = "select user, ID, password
            FROM userdata 
            where ID = '$userID'";
            $revalue = mysqli_query($link, $sql);
            if($revalue == false){
                echo "<p class='text-danger text-center'>帳號或密碼錯誤</p>";
            }
            else{
                $row = mysqli_fetch_assoc($revalue); 
            
                // var_dump($row);
                
                if(password_verify($password, $row["password"])){
                    $_SESSION["ID"] = $row["ID"];
                    header("Location: usepart.php");
                    exit();
                }
                else{
                    echo "<script> alert('密碼錯誤！！'); exit();</script>";
                }
            }
        }

        if(isset($_POST["newUser"])){
            header("Location: signup.php");
            exit();
        }
    ?>
</body>
</html>