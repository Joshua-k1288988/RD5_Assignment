<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <title>錯誤</title>
</head>
<body>
    <h2 class='text-danger text-center'>違法操作，請重新登入</h2>
    <form action="" method = "post">
    <div class="offset-5 col-6 center">
        <button name="home" type="submit" class="btn btn-primary ">回首頁</button>
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