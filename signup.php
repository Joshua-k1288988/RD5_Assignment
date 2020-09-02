<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>註冊</title>
</head>
<body>
 <br>
    <form class="container" method = "post" onsubmit="return check()">
        <div class="form-group row">
            <label for="user" class="col-4 col-form-label">使用者姓名</label> 
            <div class="col-8">
            <input id="user" name="user" type="text" class="form-control" pattern="\w{3,16}">
            </div>
        </div>
        <div class="form-group row">
            <label for="userID" class="col-4 col-form-label">帳號</label> 
            <div class="col-8">
            <input id="userID" name="userID" type="text" class="form-control" pattern="\w{4,16}">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-4 col-form-label">密碼</label> 
            <div class="col-8">
            <input id="password" name="password" type="password" class="form-control" pattern="[0-9a-zA-Z]{8,20}">
            </div>
        </div>
        <div class="form-group row">
            <label for="repassword" class="col-4 col-form-label">確認密碼</label> 
            <div class="col-8">
            <input id="repassword" name="repassword" type="password" aria-describedby="repasswordHelpBlock" class="form-control" pattern="[0-9a-zA-Z]{8,20}"> 
            <span id="repasswordHelpBlock" class="form-text text-muted">再重複輸入一次密碼</span>
            </div>
        </div> 
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="btnOK" type="submit" class="btn btn-primary">確認註冊</button>
            </div>
        </div>
    </form>

    <?php
        if(isset($_POST["btnOK"])){
            if($_POST["password"] != $_POST["repassword"]){
                echo "兩次密碼不一致";
                exit();
            }
            $user = $_POST["user"];
            $userID = $_POST["userID"];
            $password = $_POST["password"];
            $hash = password_hash($password , PASSWORD_DEFAULT );

            require("linksql.php");
            $sql = "INSERT INTO userdata (`user`, `ID`, `password`, `money`) VALUES
            ('$user', '$userID', '$hash' , 0);";
            $revalue = mysqli_query($link, $sql);
            // var_dump($revalue);
            if($revalue == false){
                echo "<script> alert('警告：註冊失敗，帳號重複');</script>";
            }
            else{
                $nowTime = time();
                $nowTime = date("Y年m月d日 H:i:s", $nowTime);
                $sql = "INSERT INTO userList (`ID`, `date`, `actionList`) VALUES
                ('$userID', '$nowTime', '成功建立帳戶');";
                $revalue = mysqli_query($link, $sql);
                mysqli_close($link);
                echo "<script> alert('註冊成功'); location.href ='index.php';</script>";
                exit();
            }
        }
    ?>
</body>
</html>