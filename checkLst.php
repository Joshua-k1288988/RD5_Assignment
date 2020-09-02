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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>明細查詢</title>
</head>
<body>
<br>
<div class="container">
    <table class = "table table-striped">
        <thead class = "thead-dark">
            <tr>
                <th>使用者</th>
                <th>帳號</th>
                <th>時間</th>
                <th>動作</th>
            </tr>
        </thead>
        <tbody>
<?php
        @$userID = $_SESSION["ID"];
        require("linksql.php");
        $sql = "select user, d.ID, date, actionList 
        FROM userdata d
        join userList l on l.ID = d.ID
        where d.ID = '$userID';";
        $revalue = mysqli_query($link, $sql);
        if($revalue == false){
            header("Location: worng.php");
            exit();
        }
        // var_dump($revalue);
        while($row = mysqli_fetch_assoc($revalue)){
            echo "<tr>";
            echo "<td>" . $row["user"] . "</td>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["actionList"] . "</td>";
            echo "</tr>";
        }
    ?>
        </tbody>
    </table>
</div>
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