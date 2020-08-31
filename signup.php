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
            <input id="user" name="user" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="userID" class="col-4 col-form-label">帳號</label> 
            <div class="col-8">
            <input id="userID" name="userID" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-4 col-form-label">密碼</label> 
            <div class="col-8">
            <input id="password" name="password" type="password" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="repassword" class="col-4 col-form-label">確認密碼</label> 
            <div class="col-8">
            <input id="repassword" name="repassword" type="password" aria-describedby="repasswordHelpBlock" class="form-control"> 
            <span id="repasswordHelpBlock" class="form-text text-muted">再重複輸入一次密碼</span>
            </div>
        </div> 
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="btnOK" type="submit" class="btn btn-primary">確認註冊</button>
            </div>
        </div>
    </form>

    <script type="text/javascript"> 
        function check() { 
            var username=document.getElementById("user").value;
            var userID = document.getElementById("userID").value; 
            var password=document.getElementById("password").value; 
            var repassword=document.getElementById("repassword").value; 
            var regex=/^[/s] $/; 
            if(regex.test(username)||username.length==0){ 
            alert("使用者姓名格式不對"); 
            return false; 
            } 
            if(regex.test(userID)||userID.length==0){ 
            alert("使用者帳號格式不對"); 
            return false; 
            } 
            if(regex.test(password)||password.length==0){ 
            alert("密碼格式不對"); 
            return false;     
            } 
            if(password!=repassword){ 
            alert("兩次密碼不一致"); 
            return false; 
            } 
        } 
    </script> 
    <?php
        if(isset($_POST["btnOK"])){
            $user = $_POST["user"];
            $userID = $_POST["userID"];
            $password = $_POST["password"];

            require("linksql.php");
            $sql = "INSERT INTO userdata (`user`, `ID`, `password`, `money`) VALUES
            ('$user', '$userID', '$password' , 0);";
            $revalue = mysqli_query($link, $sql);
            // var_dump($revalue);
            if($revalue == false){
                echo "<script> alert('警告：註冊失敗');</script>";
            }
            else{
                $nowTime = date("Y年m月d日 H:i:s");
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