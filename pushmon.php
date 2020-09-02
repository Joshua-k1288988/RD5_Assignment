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
    <title>存款</title>
</head>
<body>
<?php
if(@$_SESSION["ID"] == NULL){
    header("Location: worng.php");
    exit();
}
$userID = $_SESSION["ID"];

?>
    <div class = "text-center">
        <h3>請輸入存款金額</h3>
    </div>
    <form class="container" method = "post">
    <div class="form-group row">
        <label for="text" class="col-2 col-form-label text-right" >金額</label> 
        <div class="col-8">
        <input id="money" name="money" type="text" class="form-control" pattern = "\d{1,6}">
        </div>
    </div> 
    <div class="form-group row">
        <div class="offset-5 col-6 center">
        <button name="checkmon" type="submit" class="btn btn-primary ">確認</button>
        </div>
    </div>
    </form>
    <?php
        if(isset($_POST["checkmon"])){
            require("linksql.php");
            $sql = "select money
            FROM userdata 
            where ID = '$userID';";
            $revalue = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($revalue);

            $pushmoney = $_POST["money"];
            if($_POST["money"] == "") {
                echo "<h2 class='text-danger text-center'>請輸入金額</h2>";
                exit();
            }

            $count = (int)$row["money"] + (int)$_POST["money"];

            

            $_SESSION["action"] = "pushmoney";
            $_SESSION["count"] = $count;
            $_SESSION["money"] = $pushmoney;

            header("Location: recheckpass.php");
            exit();
        }
    ?>
</body>
</html>